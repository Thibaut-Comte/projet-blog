<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 28/11/2018
 * Time: 10:00
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class adminController extends AbstractController
{

    /**
     * @Route()
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function index()
    {

        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isGranted('ROLE_ADMIN')){

        }

        return $this->render('admin/index.html.twig');
    }

}