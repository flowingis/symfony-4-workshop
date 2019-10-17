<?php

namespace App\Repository;

use App\Entity\Account;
use App\Entity\TimeSpent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TimeSpent|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimeSpent|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimeSpent[]    findAll()
 * @method TimeSpent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeSpentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TimeSpent::class);
    }

    public function countHours(Account $user, \DateTime $day): int
    {
        $tot = $this->createQueryBuilder('t')
            ->select('SUM(t.ore)')
            ->where('t.data = :data')
            ->andWhere('t.utente = :utente')
            ->setParameter('data', $day)
            ->setParameter('utente', $user->getId())
            ->getQuery()
            ->getSingleScalarResult();

        return $tot ?? 0;
    }

    public function save(TimeSpent $timeSpent): void
    {
        $this->_em->persist($timeSpent);
        $this->_em->flush();
    }

    // /**
    //  * @return TimeSpent[] Returns an array of TimeSpent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TimeSpent
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
