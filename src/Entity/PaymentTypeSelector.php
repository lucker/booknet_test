<?php
namespace App\Entity;

use App\Repository\PaymentMethodsRepository;

class PaymentTypeSelector
{
    private array $selectedPaymentMethods = [];

    public function __construct(
        $productType,
        $amount,
        $lang,
        $countryCode,
        $userOs,
        PaymentMethodsRepository $paymentMethodsRepository
    ) {
        $productTypeEntities = $paymentMethodsRepository->findByCustomCriteria(
            $productType,
            $amount,
            $lang,
            $countryCode,
            $userOs
        );

        foreach ($productTypeEntities as $productTypeEntity) {
            $className = $productTypeEntity['name'] . 'Method';
            $nameSpace = "App\Entity\PaymentMethods\\";
            $class = $nameSpace .$className;
            if (class_exists($class)) {
                $entity = new $class;
                $entity->setName($productTypeEntity['name']);
                $entity->setCommission($productTypeEntity['comission']);
                $entity->setImageUrl($productTypeEntity['image_url']);
                $entity->setPayUrl($productTypeEntity['pay_url']);
                $this->selectedPaymentMethods[] = $entity;
            }
        }
    }

    public function getButtons() : array
    {
        return $this->selectedPaymentMethods;
    }
}
