<?php declare(strict_types=1);
/**
 * Author: ansarsheik
 *
 * Email: webexr@gmail.com
 * Date: Mar 2020
 */
namespace App\Controller;

use App\Contracts\SearchInterface;
use App\Entity\Users;
use App\Exceptions\ValidationException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SearchController
 * @package App\Controller
 */
class SearchController extends AbstractController
{
    /**
     * @var \App\Contracts\SearchInterface
     */
    private $searchService;

    /**
     * SearchController constructor.
     * @param \App\Contracts\SearchInterface $searchService
     */
    public function __construct(SearchInterface $searchService)
    {
        $this->searchService = $searchService;
    }

    /**
     * @Route("/api/search", name="search", methods="GET")
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function searchTerm(Request $request): JsonResponse
    {
        try {
            $lastName = $request->query->get('lastname');
            $isUnique = $request->query->get('dupes') === "true" ? true : false;

            $this->validateLastName($lastName);

            $users = (new Users())->setLastname($lastName)->setUnique($isUnique);
            $userResults = $this->searchService->searchUsers($users);

            $success    = true;
            $message    = 'Users Found';
            $statusCode = 200;
        } catch (\Exception $e) {
              $message      = $e->getMessage() ?? 'Error Finding Users';
              $statusCode   =$e->getCode();
        }

        $data = [
            'success'   => $success ?? false,
            'message'   => $message,
            'data'      => $userResults ?? []
        ];

        return new JsonResponse(
                $data,
            $statusCode ?? 400
        );
    }

    /**
     * @param string|null $lastName
     * @throws \App\Exceptions\ValidationException
     */
    private function validateLastName(?string $lastName)
    {
        try {
            if (!$lastName) {
                throw new \Exception(
                  'Last name required',
                  400
                );
            }
        } catch (\Exception $e) {
            throw new ValidationException(
                $e->getMessage(),
                $e->getCode()
            );
        }
    }
}