<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\FindsRepository;
use Doctrine\Common\Collections\Collection;
use Jsor\Doctrine\PostGIS\Types\PostGISType;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: FindsRepository::class)]
class Finds
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 1024)]
    private ?string $description = null;

    //#[ORM\Column(length: 255, nullable: true)]
    #[ORM\Column(
        type: PostGISType::GEOMETRY, 
        options: ['geometry_type' => 'POINT'],
    )]
    private ?string $gps = null;

    #[ORM\ManyToOne(targetEntity: Locations::class, cascade: ['persist', 'remove'])]
    private ?Locations $location = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $founded = null;

    /**
     * @var Collection<int, Categories>
     */
    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'finds')]
    private Collection $categories;

    /**
     * @var Collection<int, Datings>
     */
    #[ORM\ManyToMany(targetEntity: Datings::class, inversedBy: 'finds')]
    private Collection $datings;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->datings = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getGps(): ?string
    {
        return $this->gps;
    }

    public function setGps(?string $gps): static
    {
        $this->gps = $gps;

        return $this;
    }

    public function getLocation(): ?Locations
    {
        return $this->location;
    }

    public function setLocation(?Locations $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getFounded(): ?\DateTimeInterface
    {
        return $this->founded;
    }

    public function setFounded(\DateTimeInterface $founded): static
    {
        $this->founded = $founded;

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): static
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
        }

        return $this;
    }

    public function removeCategory(Categories $category): static
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, Datings>
     */
    public function getDatings(): Collection
    {
        return $this->datings;
    }

    public function addDating(Datings $dating): static
    {
        if (!$this->datings->contains($dating)) {
            $this->datings->add($dating);
        }

        return $this;
    }

    public function removeDating(Datings $dating): static
    {
        $this->datings->removeElement($dating);

        return $this;
    }
}
