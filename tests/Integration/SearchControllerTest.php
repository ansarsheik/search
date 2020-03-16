<?php declare(strict_types=1);

/**
 * Author: ansarsheik
 *
 * Email: webexr@gmail.com
 * Date: Mar 2020
 */
namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SearchControllerTest extends WebTestCase
{
    public function testSearchUsersAPISuccess()
    {
        $url = 'http://vt-web-server/api/search';

        $client = self::createClient();
        $client->request('GET', $url, [
            'lastname'  => 'cameron'
        ]);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isSuccessful());

        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('data', $response);
    }

    public function testSearchUsersAPIShouldFail()
    {
        $url = 'http://vt-web-server/api/search';

        $client = self::createClient();
        $client->request('GET', $url, [
            'lastname'  => 'noname'
        ]);

        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        $this->assertFalse($client->getResponse()->isSuccessful());

        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('data', $response);
    }

    public function testSearchUsersAPIWithoutParams()
    {
        $url = 'http://vt-web-server/api/search';

        $client = self::createClient();
        $client->request('GET', $url, [

        ]);

        $this->assertEquals(400, $client->getResponse()->getStatusCode());
        $this->assertFalse($client->getResponse()->isSuccessful());

        $response = json_decode($client->getResponse()->getContent(), true);
        $this->assertContains('Last name required', $response['message']);
    }
}