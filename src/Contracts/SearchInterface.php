<?php declare(strict_types=1);
/**
 * Author: ansarsheik
 *
 * Email: webexr@gmail.com
 * Date: Mar 2020
 */

namespace App\Contracts;

use App\Entity\Users;

interface SearchInterface
{
    public function searchUsers(Users $user): ?array;
}