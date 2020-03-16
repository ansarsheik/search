<?php declare(strict_types=1);
/**
 * Author: ansarsheik
 *
 * Email: webexr@gmail.com
 * Date: Mar 2020
 */

namespace App\Services;

use App\Entity\Users;
use App\Exceptions\UserNotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use App\Contracts\SearchInterface;

/**
 * Class SearchService
 * @package App\Services
 */
class SearchService extends AbstractService implements SearchInterface
{
    /**
     * @param \App\Entity\Users $user
     * @return array|null
     * @throws \Exception
     */
    public function searchUsers(Users $user): ?array
    {
        try {
            $users = $this->searchUsersByLastName($user);

            if (!$users) {
                throw new UserNotFoundException(
                    'User Not Found',
                    404
                );
            }

        } catch (\Exception $e) {
            throw new \Exception(
                $e->getMessage(),
                $e->getCode()
            );
        }

        return [
            $users
        ];
    }

    /**
     * @param \App\Entity\Users $Users
     * @return mixed
     */
    private function searchUsersByLastName(Users $Users): ?array
    {
        return $this->getEntityManager()
            ->getRepository(Users::class)
            ->getUsersByName($Users);
    }
}