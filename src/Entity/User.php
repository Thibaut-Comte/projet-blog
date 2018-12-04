<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContext;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="project_user")
 */
class User implements UserInterface
{
    use idTrait;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max="255")
     */
    private $password;

    /**
     * @var string|null
     * @Assert\Type("string")
     * @Assert\Length(min=5)
     */
    private $rawPassword;

    /**
     * @Assert\Callback()
     */
    public function assertIsValid(ExecutionContext $context)
    {
        if (null === $this->getId() && null === $this->getRawPassword()) {
            $context
                ->buildViolation('Vous devez définir un mot de passe')
                ->atPath('rawPassword')
                ->addViolation()
            ;
        }
    }

    /**
     * @return null|string
     */
    public function getRawPassword(): ?string
    {
        return $this->rawPassword;
    }

    /**
     * @param null|string $rawPassword
     */
    public function setRawPassword(?string $rawPassword): void
    {
        $this->rawPassword = $rawPassword;
    }

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="author")
     * @ORM\JoinColumn(nullable=true)
     */
    private $products;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\File(
     *     maxSize="4M",
     *     mimeTypes={"image/jpg", "image/png", "image/jpeg"}
     * )
     */
    private $image;

    public function __construct()
    {
        $this->role = "ROLE_USER";
        $this->products = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function setUsername(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole(string $role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * @param mixed $products
     */
    public function setProducts($products): void
    {
        $this->products = $products;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     */
    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    public function addProduct(Product $product)
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
            $product->setImage($this);
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        if ($this->products->contains($product)) {
            $this->products->removeElement($product);
            // set the owning side to null (unless already changed)
            if ($product->getImage() === $this) {
                $product->setImage(null);
            }
        }

        return $this;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

        return $this;
    }

    public function getRoles()
    {
        return array(
            $this->role === "ROLE_ADMIN" ? 'ROLE_ADMIN' : 'ROLE_USER'
        );
    }

    public function getSalt()
    {
        return null;
    }

    public function eraseCredentials()
    {
        $this->rawPassword = null;
    }
}
