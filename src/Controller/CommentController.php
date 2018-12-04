<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 30/11/2018
 * Time: 13:28
 */

namespace App\Controller;


use App\Entity\Comment;
use App\Form\CommentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comment")
 */
class CommentController extends AbstractController
{
    /**
     * @Route("/{id}/delete"), requirements={"id" : "\d+"}
     */
    public function delete(Comment $comment, Request $request)
    {
        $token = $request->query->get('token');

        if(!$this->isCsrfTokenValid('delete_comment', $token))
        {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        $this->addFlash('success', 'Commentaire supprimé avec succès.');

        return $this->redirectToRoute('app_product_read', array(
            'id' => $comment->getProduct()->getId()
        ));

    }

    /**
     * @Route("/{id}/update"), requirements={"id":"\d+"}
     */
    public function update(Comment $comment, Request $request)
    {
        $form = $this->createForm(CommentType::class, $comment);

        $comments = $this->getDoctrine()->getManager()->getRepository(Comment::class)->findBy(
            ['product' => $comment->getProduct()]
        );

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Commentaire modifié.');

            $this->redirectToRoute('app_product_read', array(
                'id' => $comment->getProduct()->getId()
            ));
        }

        return $this->render('products/view.html.twig', array(
            'comments' => $comments,
            'comment' => $form->createView(),
            'product' => $comment->getProduct()
        ));
    }


}