<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository", repositoryClass=ContactRepository::class)
 * @ORM\Table(name="contacts")
 */
class Contact
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
     * Name.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=64)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="2"
     * )
     * @Assert\Regex("/^[a-zA-Z]+$/")
     */
    private $name;

    /**
     * Surname.
     *
     * @var string
     *
     *
     * @ORM\Column(type="string", length=64)
     *
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Assert\Length(
     *     min="2"
     * )
     * @Assert\Regex("/^[a-zA-Z]+$/")
     */
    private $surname;

    /**
     * Address.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $address;

    /**
     * Phone.
     *
     * @var string
     *
     * @ORM\Column(type="string", length=32, nullable=true)
     *
     */
    private $phone;

    /**
     * Getter for Id.
     *
     * @return int|null Result
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Getter for Name.
     *
     * @return string|null Name
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Setter for Name.
     *
     * @param string $name Name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Getter for Surname.
     *
     * @return string|null Surname
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * Setter for Surname.
     *
     * @param string $surname Surname
     */
    public function setSurname(string $surname): self
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Getter for Address.
     *
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * Setter for Address.
     *
     * @param string|null $address Address
     *
     */
    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Getter for Phone.
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * Setter for Phone.
     *
     * @param string|null $phone Phone
     */
    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }
}
