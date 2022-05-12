<?php

namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;

class CustomerSearch
{

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Customer")
     */
    private $customer;

    public function getCustomer(): ?string
    {
        return $this->customer;
    }

    public function setCustomer(?string $customer): self
    {
        $this->customer = $customer;

        return $this;
    }
}
