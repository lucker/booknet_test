<?php
namespace App\Controller;

use App\Repository\PaymentMethodsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\PaymentTypeSelector;

class PaymentController extends AbstractController
{
    /**
     * @Route("/", name="payment")
     */
    public function index(PaymentMethodsRepository $paymentMethodsRepository): JsonResponse
    {
        // Входные параметры, которые откуда-то приходят, неважно откуда
        $productType        = 'book';       // book | reward | walletRefill (пополнение внутреннего кошелька)
        $amount             = 85.10;        // any float > 0
        $lang               = 'en';         // only en | es | uk
        $countryCode        = 'IN';         // any country code in ISO-3166 format
        $userOs             = 'android';    // android | ios | windows

        $paymentTypeSelector = new PaymentTypeSelector(
            $productType,
            $amount,
            $lang,
            $countryCode,
            $userOs,
            $paymentMethodsRepository
        );
        $paymentButtons = $paymentTypeSelector->getButtons();

        $answer = [];
        foreach ($paymentButtons as $key =>$btn) {
            $answer[$key]['name'] = $btn->getName();
            $answer[$key]['commission'] = $btn->getCommission();
            $answer[$key]['imageUrl'] =  $btn->getImageUrl();
            $answer[$key]['payUrl'] = $btn->getPayUrl();
        }

        return new JsonResponse($answer);
    }
}
