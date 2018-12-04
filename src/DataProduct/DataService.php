<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 03/12/2018
 * Time: 13:50
 */

namespace App\DataProduct;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;

class DataService
{

    protected $em;
    protected $container;


    public function __construct(EntityManagerInterface $em, ContainerInterface $container)
    {
        $this->em = $em;
        $this->container = $container;
    }

    public function returnData(string $query, Request $request)
    {
        $em = $this->em;
        $container = $this->container;
        $query = $em->createQuery($query);

        $paginator = $container->get('knp_paginator');
        $products = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 3)/*page number*/
        );

        return ($products);
    }

}