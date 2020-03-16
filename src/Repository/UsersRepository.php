<?php

namespace App\Repository;

use App\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Users|null find($id, $lockMode = null, $lockVersion = null)
 * @method Users|null findOneBy(array $criteria, array $orderBy = null)
 * @method Users[]    findAll()
 * @method Users[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    /**
     * @param \App\Entity\Users $users
     * @return array|null
     */
    public function getUsersByName(Users $users): ?array
    {
        $query =  $this->createQueryBuilder('s')
            ->select('s.firstname,s.lastname')
            ->andWhere('s.lastname like :lastname')
            ->setParameter('lastname', $users->getLastname().'%')
        ;

        if ($users->isUnique()) {
            $query->groupBy('s.firstname,s.lastname');
        }

        return $query->orderBy('s.firstname, s.lastname','asc')
            ->getQuery()->getArrayResult();
    }
}
