<?php

namespace App\Entity;

use App\Repository\PaymentMethodsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentMethodsRepository::class)]
class PaymentMethods
{
    const SELECT_TYPE_IN = 'IN';
    const SELECT_TYPE_NOT_IN = 'NOT IN';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $comission = null;

    #[ORM\Column(length: 255)]
    private ?string $productType = null;

    #[ORM\Column]
    private ?float $amount = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $imageUrl = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $payUrl = null;

    #[ORM\Column]
    private ?int $paymentSystemId = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\OneToMany(mappedBy: 'paymentMethodId', targetEntity: PaymentMethodsLang::class)]
    private Collection $paymentMethodsLang;

    #[ORM\Column]
    private ?int $priority = null;

    #[ORM\Column(length: 255)]
    private ?string $lang_select_type = null;

    public function __construct()
    {
        $this->paymentMethodsLang = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getComission(): ?string
    {
        return $this->comission;
    }

    public function setComission(string $comission): self
    {
        $this->comission = $comission;

        return $this;
    }

    public function getProductType(): ?string
    {
        return $this->productType;
    }

    public function setProductType(string $productType): self
    {
        $this->productType = $productType;

        return $this;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(?string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    public function getPayUrl(): ?string
    {
        return $this->payUrl;
    }

    public function setPayUrl(?string $payUrl): self
    {
        $this->payUrl = $payUrl;

        return $this;
    }

    public function getPaymentSystemId(): ?int
    {
        return $this->paymentSystemId;
    }

    public function setPaymentSystemId(int $paymentSystemId): self
    {
        $this->paymentSystemId = $paymentSystemId;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, PaymentMethodsLang>
     */
    public function getPaymentMethodsLang(): Collection
    {
        return $this->paymentMethodsLang;
    }

    public function addPaymentMethodsLang(PaymentMethodsLang $paymentMethodsLang): self
    {
        if (!$this->paymentMethodsLang->contains($paymentMethodsLang)) {
            $this->paymentMethodsLang->add($paymentMethodsLang);
            $paymentMethodsLang->setPaymentMethodId($this);
        }

        return $this;
    }

    public function removePaymentMethodsLang(PaymentMethodsLang $paymentMethodsLang): self
    {
        if ($this->paymentMethodsLang->removeElement($paymentMethodsLang)) {
            // set the owning side to null (unless already changed)
            if ($paymentMethodsLang->getPaymentMethodId() === $this) {
                $paymentMethodsLang->setPaymentMethodId(null);
            }
        }

        return $this;
    }

    public function getPriority(): ?int
    {
        return $this->priority;
    }

    public function setPriority(int $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getLangSelectType(): ?string
    {
        return $this->lang_select_type;
    }

    public function setLangSelectType(string $lang_select_type): self
    {
        $this->lang_select_type = $lang_select_type;

        return $this;
    }
}
