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
        $tab = array(1, 2, 3);
        return $this->render('base/index.html.twig', array(
            'tab' => $tab
        ));
    }
}
