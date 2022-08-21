<?php

namespace App\Repository;

use App\Entity\PaymentMethods;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\QueryString;

/**
 * @extends ServiceEntityRepository<PaymentMethods>
 *
 * @method PaymentMethods|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentMethods|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentMethods[]    findAll()
 * @method PaymentMethods[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentMethodsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentMethods::class);
    }

    public function add(PaymentMethods $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(PaymentMethods $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByCustomCriteria(
        $productType,
        $amount,
        $lang,
        $countryCode,
        $userOs
    )
    {
        $conn = $this->getEntityManager()->getConnection();

        $langSql = " AND
          CASE WHEN p.lang_select_type = '". PaymentMethods::SELECT_TYPE_IN ."' THEN
                  :lang IN (SELECT lang FROM payment_methods_lang pl WHERE pl.payment_method_id = p.id)
          ELSE
                  :lang  NOT IN (SELECT lang FROM payment_methods_lang pl WHERE pl.payment_method_id = p.id)
          END
          ";

        $sql = 'SELECT p.id, p.name, p.comission, p.image_url, p.pay_url
            FROM payment_methods p
            WHERE p.amount <= :amount
            AND p.product_type = :product_type ' .
           $langSql
        . '    AND :country_code IN (SELECT country_code FROM payment_methods_country_code pcc WHERE pcc.payment_method_id = p.id)
            AND :user_os IN (SELECT user_os FROM payment_methods_user_os puc WHERE puc.payment_method_id = p.id)
            AND p.active = true
            ORDER BY p.priority ASC
        ';
        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery([
            'amount' => $amount,
            'product_type' => $productType,
            'lang' => $lang,
            'country_code' => $countryCode,
            'user_os' => $userOs
        ]);

        return $resultSet->fetchAllAssociative();
    }
}
