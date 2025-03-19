<?php

namespace App\Entity;

use App\Repository\CategoriesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriesRepository::class)]
class Categories
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\OneToOne(targetEntity: self::class, inversedBy: 'categories', cascade: ['persist', 'remove'])]
    private ?self $parent = null;

    #[ORM\OneToOne(targetEntity: self::class, mappedBy: 'parent', cascade: ['persist', 'remove'])]
    private ?self $categories = null;

    /**
     * @var Collection<int, Finds>
     */
    #[ORM\ManyToMany(targetEntity: Finds::class, mappedBy: 'categories')]
    private Collection $finds;

    public function __construct()
    {
        $this->finds = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    public function getCategories(): ?self
    {
        return $this->categories;
    }

    public function setCategories(?self $categories): static
    {
        // unset the owning side of the relation if necessary
        if (null === $categories && null !== $this->categories) {
            $this->categories->setParent(null);
        }

        // set the owning side of the relation if necessary
        if (null !== $categories && $categories->getParent() !== $this) {
            $categories->setParent($this);
        }

        $this->categories = $categories;

        return $this;
    }

    /**
     * @return Collection<int, Finds>
     */
    public function getFinds(): Collection
    {
        return $this->finds;
    }

    public function addFind(Finds $find): static
    {
        if (!$this->finds->contains($find)) {
            $this->finds->add($find);
            $find->addCategory($this);
        }

        return $this;
    }

    public function removeFind(Finds $find): static
    {
        if ($this->finds->removeElement($find)) {
            $find->removeCategory($this);
        }

        return $this;
    }
}
