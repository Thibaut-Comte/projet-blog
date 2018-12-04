<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 30/11/2018
 * Time: 15:09
 */

namespace App\Controller;


use App\Entity\Categorie;
use App\Entity\Product;
use App\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorie")
 */
class CategorieController extends AbstractController
{

    /**
     * @Route("/")
     */
    public function index()
    {
       $categories = $this->getDoctrine()->getManager()->getRepository(Categorie::class)->findAll();

       return $this->render('/categorie/index.html.twig', array(
           'categories' => $categories
       ));
    }

    /**
     * @Route("/add")
     */
    public function add(Request $request)
    {
        $categorie = new Categorie();

        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($categorie);
            $em->flush();

            $this->addFlash('success', "Catégorie créée");

            return $this->redirectToRoute('app_categorie_index');
        }

        return $this->render('categorie/add.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("/{id}/update"), requirements={"id":"\d+"}
     */
    public function update(Request $request, Categorie $categorie)
    {

        $form = $this->createForm(CategorieType::class, $categorie);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())

        {
            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', "Catégorie modifiée");

            return $this->redirectToRoute('app_categorie_index');
        }

        return $this->render('categorie/add.html.twig', array(
            'form' => $form->createView()
        ));

    }

    /**
     * @Route("/{id}/delete"), requirements={"id":"\d+"}
     */
    public function delete(Request $request, Categorie $categorie)
    {
        $token = $request->query->get('token');

        if(!$this->isCsrfTokenValid('delete', $token))
        {
            return $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();

        $products = $categorie->getproducts();

        foreach ($products as $product)
        {
            $product->removeCategory($categorie);
        }

        $em->remove($categorie);
        $em->flush();

        $this->addFlash('success', "Catégorie supprimée");

        return $this->redirectToRoute('app_categorie_index');

    }

}