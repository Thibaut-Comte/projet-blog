<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/base")
 */
class BaseController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('base/index.html.twig', array(

        ));
    }
}
