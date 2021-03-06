<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\User;
use App\Form\UserType;
use App\Upload\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/login/redirect", methods={"GET"})
     */
    public function afterLogin(): RedirectResponse
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin_index');
        } elseif ($this->isGranted('ROLE_USER')) {
            return $this->redirectToRoute('app_product_index');
        }
    }

    /**
     * @Route("/signup", methods={"GET","POST"})
     */
    public function signup(FileUploader $fileUploader, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        if ($this->isGranted('IS_AUTHENTICATED_FULLY')) {
            $this->redirectToRoute('app_security_afterlogin');
        }

        $user = new User();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $encoded = $encoder->encodePassword($user, $user->getRawPassword());
            $user->setPassword($encoded);

            if ($user->getRawImage()) {
                $file = $user->getRawImage();
                $fileName = $fileUploader->upload($file);
                $user->setImage($fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Bienvenue, vous pouvez désormais vous connecter.');
            return $this->redirectToRoute('app_security_login');
        }

        return $this->render('security/signup.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/account")
     */
    public function account(FileUploader $fileUploader, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user, array(
            'required_password' => false
        ));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                if ($user->getRawPassword()) {
                    $encoded = $encoder->encodePassword($user, $user->getRawPassword());
                    $user->setPassword($encoded);
                }

                if ($user->getRawImage()) {
                    if ($user->getImage())
                    {
                        $fileUploader->removeFile($user->getImage());
                    }
                    $file = $user->getRawImage();
                    $fileName = $fileUploader->upload($file);
                    $user->setImage($fileName);
                    $user->setRawImage(null);
                }

                $this->getDoctrine()->getManager()->flush();
                $this->addFlash('success', 'Votre compte a bien été modifié.');

            } catch (\Exception $e) {
                $this->addFlash('danger', "Une erreur est survenue");
            }

            return $this->redirectToRoute('app_security_account', array(
                'id' => $user->getId(),
            ));
        }

        return $this->render('security/account.html.twig', [
            'form' => $form->createView(), 'user' => $user
        ]);
    }

    /**
     * @Route("/{id}/delete"), requirements={"id":"\d+"}
     */
    public function delete(Request $request, User $user, FileUploader $fileUploader, TokenStorageInterface $tokenInterface)
    {
        $token = $request->query->get('token');

        if (!$this->isCsrfTokenValid('delete_user', $token)) {
            return $this->createAccessDeniedException();
        }


        $em = $this->getDoctrine()->getManager();

        $comments = $user->getComments();

        if ($user->getImage()) {
            $fileUploader->removeFile($user->getImage());
        }

        foreach ($comments as $comment) {

            $em->remove($comment);

        }

        foreach ($user->getProducts() as $product) {
            foreach ($product->getComments() as $comment) {
                $em->remove($comment);
            }
            $em->remove($product);
        }

        //Bug pour redirection
//        $em->remove($user);

        $user->setIsDelete(true);
        $em->flush();

        $this->addFlash('success', 'Votre compte à bien été supprimer.');
//        $request->getSession()->invalidate();
//        $tokenInterface->setToken('test', null);


        return $this->redirectToRoute('app_logout');
    }

    /**
     * @Route("/{id}/user"), requirements={"id":"\d+"}
     */
    public function profile(User $user)
    {
        return $this->render("/security/profile.html.twig", array(
            'user' => $user,
            'pag' => 0
        ));
    }

    /**
     * @Route("/")
     */
    public function racine()
    {
        return $this->redirectToRoute('app_product_index');
    }
}