<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

trait idTrait
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
}