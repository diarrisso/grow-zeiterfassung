<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Project;
use App\Entity\Customer;
use App\Entity\Tasks;
use App\Repository\EvaluSearchTimeRepository;

/**
 * @ORM\Entity(repositoryClass=EvaluSearchTimeRepository::class)
 */
class EvaluSearchTime
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $project;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $customer;
    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tasks;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $users;



    public function __construct()
    {
        $this->createdAt= new \DateTimeImmutable();

    }





    public function __toString()
    {
        return $this->getCustomer() . '-' . $this->createdAt();
    }


    /*public function  __toString()
    {
        $result = $this->createdAt->format('d/m/Y') . "-". $this->getEnd()->format('H:i:s') . "-" . $this->start->format('H:i:s');
        return $result;


    }*/

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProject(): ?string
    {
        return $this->project;
    }

    public function setProject(?string $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(?string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }




    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
       $this->createdAt = $createdAt;

        return $this;
    }

    public function getTasks(): ?string
    {
        return $this->tasks;
    }

    public function setTasks(?string $tasks): self
    {
        $this->Tasks = $tasks;

        return $this;
    }

    public function getUsers(): ?string
    {
        return $this->users;
    }

    public function setUsers(?string $users): self
    {
        $this->users = $users;

        return $this;
    }
}
