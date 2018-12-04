<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    use idTrait;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=500)
     * @Assert\Length(max="500")
     * @Assert\Length(min="25")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $description;

    /**
     * @ORM\Column(type="float")
     * @Assert\Type(type="float")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categorie", inversedBy="products")
     */
    private $categories;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Type(type="datetime")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $date;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="products")
     */
    private $author;


    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\File(
     *     maxSize="4M",
     *     mimeTypes={"image/jpg", "image/png", "image/jpeg"}
     * )
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="product")
     * @ORM\JoinColumn(nullable=true)
     */
    private $comments;

    public function __construct()
    {
        $this->date = new \DateTime();
        $this->categories = new ArrayCollection();
        $this->comments = new ArrayCollection();
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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categorie $category)
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categorie $category)
    {
        if ($this->categories->contains($category)) {
            $this->categories->removeElement($category);
        }

        return $this;
    }


    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $datee
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function addComment(Comment $comment)
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
        }

        return $this;
    }

    public function removeComment(Comment $comment)
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
        }

        return $this;
    }

}
