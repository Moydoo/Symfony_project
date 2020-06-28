<?php
/**
 * Event entity.
 */

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EventRepository::class)
 * @ORM\Table(name="events")
 */
class Event
{
    /**
     * Primary key.
     *
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Date.
     *
     * @var DateTimeInterface
     *
     * @ORM\Column(type="datetime")
     *
     * @Assert\DateTime
     */
    private $date;

    /**
     * Place.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="3"
     * )
     */
    private $place;

    /**
     * Title.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="3"
     * )
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="events", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * getter for Id.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Date.
     *
     * @return DateTimeInterface|null
     */
    public function getDate(): ?DateTimeInterface
    {
        return $this->date;
    }

    /**
     * Setter for Date.
     *
     * @param DateTimeInterface $date Date
     *
     * @return $this
     */
    public function setDate(DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Getter for Place.
     *
     * @return string|null
     */
    public function getPlace(): ?string
    {
        return $this->place;
    }

    /**
     * Setter for Place.
     *
     * @param string $place Place
     *
     * @return $this
     */
    public function setPlace(string $place): self
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Getter for Title.
     *
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * Setter for Title.
     * @param string $title Title
     *
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     *
     * @return $this
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
