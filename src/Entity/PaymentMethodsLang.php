<?php

namespace App\Entity;

use App\Repository\PaymentMethodsLangRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentMethodsLangRepository::class)]
class PaymentMethodsLang
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'paymentMethodsLang')]
    #[ORM\JoinColumn(nullable: false)]
    private ?PaymentMethods $paymentMethod = null;

    #[ORM\Column(length: 255)]
    private ?string $lang = null;


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

    public function getLang(): ?string
    {
        return $this->lang;
    }

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }
}
