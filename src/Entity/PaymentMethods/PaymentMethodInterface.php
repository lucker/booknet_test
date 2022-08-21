<?php
namespace App\Entity\PaymentMethods;

interface PaymentMethodInterface
{
    public function getName();
    public function getCommission();
    public function getImageUrl();
    public function getPayUrl();
}
