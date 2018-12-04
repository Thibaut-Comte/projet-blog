<?php
/**
 * Created by PhpStorm.
 * User: Thibaut
 * Date: 12/11/2018
 * Time: 13:13
 */

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(
     *     min = "3"
     *     )
     */
    private $lastName;

    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(
     *     min = "3"
     *     )
     */
    private $firstName;

    /**
     * @Assert\NotBlank()
     * @Assert\Email(checkHost=true, checkMX=true)
     */
    private $email;
    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     */
    private $subject;
    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(
     *     min="50"
     * )
     */
    private $message;

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }



}