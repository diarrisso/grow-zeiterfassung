<?php

namespace App\Entity;


use App\Repository\TrackingRepository;
use DateInterval;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**

 * @ORM\Entity(repositoryClass="App\Repository\TrackingRepository", repositoryClass=TrackingRepository::class)
 */
class Tracking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     * * @Assert\NotBlank
     * @var DateTime
     */
    private $start;

    /**
     * @ORM\Column(type="time")
     * @var DateTime
     */
    private  $end;

/**
* @ORM\Column(type="datetime", nullable=true)
*/
    private  $sum;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * * @Assert\Length(
     *      min = 15,
     *      max = 50,
     *      minMessage = "Ihr Kommentar muss mindestens 15 Zeichen lang sein",
     *      maxMessage = "Ihr Vorname darf nicht länger sein als 50 Zeichen"
     * )
     */
    private ?string $internalCommentary = null;



    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Tasks::class, inversedBy="trackings")
     */
    private $task;


    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="project")
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="trackings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="dateinterval", nullable=true)
     * @var \DateInterval
     */
    private $total;




    public function __construct()
    {
        $this->createdAt= new \DateTimeImmutable();

    }

    public function  __toString()
    {
        $result = $this->createdAt->format('d/m/Y') . "-". $this->getEnd()->format('H:i:s') . "-" . $this->start->format('H:i:s');
        return $result;

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getInternalCommentary():? string
    {
        return $this->internalCommentary;
    }

    public function setInternalCommentary(?string $internalCommentary): self
    {
        $this->internalCommentary = $internalCommentary;

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

    public function getTask(): ?Tasks
    {
        return $this->task;
    }

    public function setTask(?Tasks $task): self
    {
        $this->task = $task;

        return $this;
    }

    public function getProject(): ?Project
    {
        return $this->project;
    }

    public function setProject(?Project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     * @return $this
     */
    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSum()
    {
        return $this->sum;
    }

    /**
     * @param mixed $sum
     */
    public function setSum($sum): void
    {
        $this->sum = $sum;
    }



    /**
     * @return  \DateInterval
     */
    public function getTotal(): ?\DateInterval
    {

        return $this->total;
    }

    /**
     * @param  \DateInterval $total
     */
    public function setTotal(?\DateInterval $total): void
    {
        $this->total = $total;
    }





    /**
     * @return string
     * @throws \Exception
     */
    public  function calculer (): string
    {
        $time1 = new DateTime($this->getEnd());
        $time2 = new DateTime($this->getStart());
        return $time1->diff($time2)->format('H:i');
    }


    public function getdiiftracking()
    {
        $startDate = $this->getStart();
        $endDate = $this->getEnd();
        $difference = $endDate->diff($startDate)->format('H:i');;

        return $difference;
    }


    public function internalDatetracking()
    {
        $time1 = $this->getStart();
        $time2 = $this->getEnd();
        $interval = $time1->diff($time2);
          return $interval->format('%H:%i:%s');

    }






}
