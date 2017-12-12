<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class DefaultControllerTest
 * @package Tests\AppBundle\Controller
 */
class DefaultControllerTest extends WebTestCase
{
    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
        $this->client->followRedirects();
    }

    public function testThatIndexShouldRedirectToLoginPage()
    {
        // Disable followRedirects
        $this->client->followRedirects(false);

        /**
         * @var \Symfony\Component\DomCrawler\Crawler $crawler
         * @var RedirectResponse $response
         */
        $crawler = $this->client->request('GET', '/');

        $response = $this->client->getResponse();
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertContains('/login', $crawler->filter('body a')->text());

        // Now, follow the redirect and test if we have a login form
        $this->client->followRedirects(true);

        $crawler = $this->client->request('GET', '/');
        $this->assertContains('user.login.title', $crawler->filter('body form h2')->text());
        $this->assertContains('user.login.username', $crawler->filter('body form label[for="login"]')->text());
        $this->assertContains('user.login.password', $crawler->filter('body form label[for="password"]')->text());
    }

}
