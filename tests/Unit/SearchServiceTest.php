<?php declare(strict_types=1);

/**
 * Author: ansarsheik
 *
 * Email: webexr@gmail.com
 * Date: Mar 2020
 */
namespace App\Tests\Unit;

use App\Entity\Users;
use App\Services\SearchService;
use PHPUnit\Framework\TestCase;

class SearchServiceTest extends TestCase
{
    private CONST CLASSNAME = '\App\Services\SearchService';

    private $userMock;

    public function setUp()
    {
        $this->userMock = $this->getMockBuilder(Users::class)
            ->disableOriginalConstructor()->getMock();
    }

    public function testClassExists()
    {
        $this->assertTrue(class_exists(self::CLASSNAME));
    }

    public function testCheckUserIsInstanceOf()
    {
        $this->assertInstanceOf('\App\Entity\Users', $this->userMock);
    }

    public function testSearchService()
    {
        $this->searchService = $this->createSearchServiceMock();

        $this->searchService->method('searchUsers')->willReturn([]);

        $this->assertIsArray($this->searchService->searchUsers($this->userMock));
    }

    private function createSearchServiceMock()
    {
        return $this->getMockBuilder(SearchService::class)->disableOriginalConstructor()
            ->setMethods(
                [
                    'searchUsers',
                ])
            ->getMock();
    }
}