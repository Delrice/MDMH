<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Definition\Call\Given;
use Behat\Behat\Definition\Call\When;
use Behat\Behat\Definition\Call\Then;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    use \Behat\Symfony2Extension\Context\KernelDictionary;

    /**
     * @Given I do not follow redirects
     */
    public function iDoNotFollowRedirects()
    {
        $this->getSession()->getDriver()->getClient()->followRedirects(false);
    }

    /**
     * @Then I should be redirected
     */
    public function iShouldBeRedirected()
    {
        $this->assertResponseStatus(302);
        $client = $this->getSession()->getDriver()->getClient();
        $client->followRedirects(true);
        $client->followRedirect(true);
    }

    /**
     * @BeforeScenario
     */
    public function clearData()
    {
//        $purger = new OR($this->getContainer()->get('doctrine')->getManager());
//        $purger->purge();
    }

    /**
     * @BeforeScenario @fixtures
     */
    public function loadFixtures()
    {
//        $loader = new ContainerAwareLoader($this->getContainer());
//        $loader->loadFromDirectory(__DIR__.'/../../src/AppBundle/DataFixtures');
//        $executor = new ORMExecutor($this->getEntityManager());
//        $executor->execute($loader->getFixtures(), true);
    }


    /**
     * @Given there are :count users
     */
    public function thereAreUsers($count)
    {
        throw new PendingException();
    }

}
