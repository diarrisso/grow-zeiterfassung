<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**

 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 */
class Project
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $projectName;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contactPerson;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $competenceEmploye;

    /**
     * @ORM\Column(type="integer")
     */
    private $orderNumber;

    /**
     * @ORM\Column(type="date")
     */
    private $orderDate;

    /**
     * @ORM\Column(type="date")
     */
    private $deliveryDate;

    /**
     * @ORM\Column(type="integer")
     */
    private $documentID;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Tracking::class, mappedBy="projects")
     */
    private $projects;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Designation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $should_hours;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Actual_hours;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Location;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Rest_hours;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="projects")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer;

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }



    public function __construct()
    {

        $this->createdAt = new \DateTimeImmutable();
        $this->projects = new ArrayCollection();

    }

    public function __toString()
    {
        return $this->getId().'-'.$this->getProjectName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectName(): ?string
    {
        return $this->projectName;
    }

    public function setProjectName(string $projectName): self
    {
        $this->projectName = $projectName;

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

    public function getContactPerson(): ?string
    {
        return $this->contactPerson;
    }

    public function setContactPerson(string $contactPerson): self
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    public function getCompetenceEmploye(): ?string
    {
        return $this->competenceEmploye;
    }

    public function setCompetenceEmploye(string $competenceEmploye): self
    {
        $this->competenceEmploye = $competenceEmploye;

        return $this;
    }

    public function getOrderNumber(): ?int
    {
        return $this->orderNumber;
    }

    public function setOrderNumber(int $orderNumber): self
    {
        $this->orderNumber = $orderNumber;

        return $this;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): self
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getDeliveryDate(): ?\DateTimeInterface
    {
        return $this->deliveryDate;
    }

    public function setDeliveryDate(\DateTimeInterface $deliveryDate): self
    {
        $this->deliveryDate = $deliveryDate;

        return $this;
    }

    public function getDocumentID(): ?int
    {
        return $this->documentID;
    }

    public function setDocumentID(int $documentID): self
    {
        $this->documentID = $documentID;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection|Tracking[]
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Tracking $project): self
    {
        if (!$this->projects->contains($project)) {
            $this->projects[] = $project;
            $project->setProjects($this);
        }

        return $this;
    }

    public function removeProject(Tracking $project): self
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getProjects() === $this) {
                $project->setProjects(null);
            }
        }

        return $this;
    }

    public function getDesignation(): ?string
    {
        return $this->Designation;
    }

    public function setDesignation(?string $Designation): self
    {
        $this->Designation = $Designation;

        return $this;
    }

    public function getShouldHours(): ?int
    {
        return $this->should_hours;
    }

    public function setShouldHours(?int $should_hours): self
    {
        $this->should_hours = $should_hours;

        return $this;
    }

    public function getActualHours(): ?int
    {
        return $this->Actual_hours;
    }

    public function setActualHours(?int $Actual_hours): self
    {
        $this->Actual_hours = $Actual_hours;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->Location;
    }

    public function setLocation(?string $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getRestHours(): ?int
    {
        return $this->Rest_hours;
    }

    public function setRestHours(?int $Rest_hours): self
    {
        $this->Rest_hours = $Rest_hours;

        return $this;
    }

}
