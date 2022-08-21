<?php

namespace App\Entity\PaymentMethods;

class ApplePayMethod
{
    private $name;
    private $commission;
    private $imageUrl;
    private $payUrl;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCommission(float $commission)
    {
        $this->commission = $commission;
    }

    public function getCommission()
    {
        return $this->commission;
    }

    public function setImageUrl(string $imageUrl)
    {
        $this->imageUrl = $imageUrl;
    }

    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    public function setPayUrl(string $payUrl)
    {
        $this->payUrl = $payUrl;
    }

    public function getPayUrl()
    {
        return $this->payUrl;
    }
}
