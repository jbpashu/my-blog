<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests\AppBundle\Controller;

use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Functional test for the controllers defined inside BlogController.
 *
 * See https://symfony.com/doc/current/book/testing.html#functional-tests
 *
 * Execute the application tests using this command (requires PHPUnit to be installed):
 *
 *     $ cd your-symfony-project/
 *     $ ./vendor/bin/phpunit
 */
class BlogAPIControllerTest extends WebTestCase {

    protected $client;

    protected function setUp() {
        $this->client = static::createClient();
    }

    public function testBlogListAction() {
        $this->client->request('GET', 'en/api/blogs/list.json');

        // Assert that the "Content-Type" header is "application/json"
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, Response::HTTP_OK);
    }

    public function testPostAction() {
        $this->client->request('GET', 'en/api/blogs/posts/3/info.json');

        // Assert that the "Content-Type" header is "application/json"
        $response = $this->client->getResponse();
        $this->assertJsonResponse($response, Response::HTTP_OK);
    }

    protected function assertJsonResponse($response, $statusCode = Response::HTTP_OK) {
        $this->assertEquals($statusCode, $response->getStatusCode(), $response->getContent());
        $this->assertTrue($response->headers->contains('Content-Type', 'application/json'), $response->headers);
    }

}
