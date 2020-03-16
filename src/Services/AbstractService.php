<?php declare(strict_types=1);
/**
 * Author: ansarsheik
 *
 * Email: webexr@gmail.com
 * Date: Mar 2020
 */

namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

class AbstractService
{
    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    protected function getEntityManager(): EntityManagerInterface
    {
       return $this->entityManager;
    }
}