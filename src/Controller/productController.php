<?php

namespace App\Controller;

use App\DataProduct\DataService;
use App\Entity\Categorie;
use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\User;
use App\Form\CommentType;
use App\Form\ProductType;
use App\Upload\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product")
 */
class productController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index(DataService $data, Request $request)
    {

        $query = "SELECT product FROM App\Entity\Product product ORDER BY product.date DESC";
        $products = $data->returnData($query, $request);


        $em = $this->getDoctrine()->getManager();

        $repoCat = $em->getRepository(Categorie::class);

        $categories = $repoCat->findBy(
            [],
            ['name' => 'ASC']
        );

        return $this->render('products/index.html.twig', array(
            'products' => $products,
            'categories' => $categories
        ));
    }

    /**
     * @Route("/add")
     */
    public function add(Request $request, FileUploader $fileUploader)
    {

        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            try {

                if ($product->getImage()) {
                    $file = $product->getImage();
                    $fileName = $fileUploader->upload($file);
                    $product->setImage($fileName);
                }

                $em = $this->getDoctrine()->getManager();

                $product->setAuthor($this->getUser());

                $em->persist($product);
                $em->flush();

                $this->addFlash('success', "Votre produit est désormais en ligne !");


            } catch (\Exception $e) {
                $this->addFlash('error', "Une erreur est survenue");
            }
            $em = $this->getDoctrine()->getManager();

            $em->persist($product);
            $em->flush();

            $this->addFlash('success', "Votre produit est désormais en ligne !");

            return $this->redirectToRoute('app_product_index');
        }

        return $this->render('products/add.html.twig', array(
            'form' => $form->createView()
        ));


    }

    /**
     * @Route("/{id}/read") requirements={"id":"\d+"}
     */
    public function read(Product $product, Request $request)
    {
        $comment = new Comment();

        if ($product->getComments()) {
            $comments = $product->getComments();
        }

        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $comment->setUser($user);
            $comment->setProduct($product);

            if ($comment) {
                $product->addComment($comment);
            }

            $user->addComment($comment);

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', "Commentaire ajouté");

            $this->redirectToRoute('app_product_read', array(
                'id' => $product->getId()
            ));
        }

        return $this->render('/products/view.html.twig', array(
            'product' => $product,
            'comments' => $comments,
            'comment' => $form->createView()
        ));
    }

    /**
     * @Route("/{id}/update") requirements={"id":"\d+"}
     */
    public function update(Product $product, Request $request, FileUploader $fileUploader)
    {

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($product->getImage()) {
                $file = $product->getImage();
                $fileName = $fileUploader->upload($file);
                $product->setImage($fileName);
            }

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Produit modifié avec succès');

            return $this->redirectToRoute('app_product_read', array(
                'id' => $product->getId()
            ));
        }

        return $this->render('products/add.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("/{id}/delete"), requirements={"id":"\d+"}
     */
    public function delete(Request $request, Product $product, FileUploader $fileUploader)
    {

        $token = $request->query->get('token');

        if (!$this->isCsrfTokenValid('delete_product', $token)) {
            return $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository(Comment::class)->findBy(
            ['product' => $product]
        );

        if ($product->getImage()) {
            $fileUploader->removeFile($product->getImage());
        }

        foreach ($comments as $comment) {
            $em->remove($comment);
        }
        $em->remove($product);
        $em->flush();

        $this->addFlash('success', 'Produit supprimé avec succès.');

        return $this->redirectToRoute('app_product_index');
    }

    /**
     * @Route("/{id}/category"), requirements={"id":"\d+"}
     */
    public function bycat(DataService $data, Request $request, Categorie $category)
    {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository(Categorie::class);

        $categories = $repo->findBy(
            [],
            ['name' => 'ASC']
        );

        $products = $category->getproducts();


        return $this->render('/products/index.html.twig', array(
            'products' => $products,
            'categories' => $categories,
            'pag' => 0
        ));
    }
}
