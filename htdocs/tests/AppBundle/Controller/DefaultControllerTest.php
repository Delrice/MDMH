<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testThatPHPUnitIsRunning()
    {
        $this->assertTrue(true);
    }

    public function testIndexAccessibleByAnonymous()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertContains('form.login.title', $crawler->filter('form.form-signin')->text());
    }
}
