<?php

namespace App\Entity;

use App\Repository\DatingsRepository;
use Collator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DatingsRepository::class)]
class Datings
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'datings', cascade: ['persist', 'remove'])]
    private ?self $parent = null;

    /**
     * @var Collection<int, Datings>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent', cascade: ['persist', 'remove'])]
    private Collection $datings;

    /**
     * @var Collection<int, Finds>
     */
    #[ORM\ManyToMany(targetEntity: Finds::class, mappedBy: 'datings')]
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

    /**
     * @return Collection<int, Datings>
     */
    public function getDatings(): Collection
    {
        return $this->datings;
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
            $find->addDating($this);
        }

        return $this;
    }

    public function removeFind(Finds $find): static
    {
        if ($this->finds->removeElement($find)) {
            $find->removeDating($this);
        }

        return $this;
    }
}
