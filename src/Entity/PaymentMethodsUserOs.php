<?php

namespace App\Entity;

use App\Repository\PaymentMethodsUserOsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentMethodsUserOsRepository::class)]
class PaymentMethodsUserOs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?PaymentMethods $paymentMethod = null;

    #[ORM\Column(length: 255)]
    private ?string $userOs = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPaymentMethod(): ?PaymentMethods
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(?PaymentMethods $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getUserOs(): ?string
    {
        return $this->userOs;
    }

    public function setUserOs(string $userOs): self
    {
        $this->userOs = $userOs;

        return $this;
    }
}
