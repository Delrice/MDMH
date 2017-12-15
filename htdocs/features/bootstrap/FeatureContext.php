<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Definition\Call\Given;
use Behat\Behat\Definition\Call\When;
use Behat\Behat\Definition\Call\Then;
use Doctrine\Common\DataFixtures\Purger\MongoDBPurger;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Doctrine\Common\DataFixtures\Executor\MongoDBExecutor;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context
{
    use \Behat\Symfony2Extension\Context\KernelDictionary;

    /**
     * @BeforeScenario @fixtures
     */
    public function clearData()
    {
        $purger = new MongoDBPurger($this->getContainer()->get('doctrine_mongodb')->getManager());
        $purger->purge();
    }

    /**
     * @BeforeScenario @fixtures
     */
    public function loadFixtures()
    {
        $loader = new ContainerAwareLoader($this->getContainer());
        $loader->loadFromDirectory(__DIR__.'/../../src/AppBundle/DataFixtures');
        $executor = new MongoDBExecutor($this->getDocumentManager());
        $executor->execute($loader->getFixtures(), true);
    }

    /**************************************************/
    /***************** AUTHENTICATION *****************/
    /**************************************************/

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

    /**************************************************/
    /********************** USERS *********************/
    /**************************************************/

    /**
     * @Given /^I am authenticated as "([^"]*)"$/
     */
    public function iAmAuthenticatedAs($username)
    {
        $this->visitPath('/login');
        $this->getPage()->fillField('login', $username);
        $this->getPage()->fillField('password', $username);
        $this->getPage()->pressButton('user.login.sign-in');
    }

















    /**************************************************/
    /******************** PRIVATE *********************/
    /**************************************************/

    /**
     * @return \Behat\Mink\Element\DocumentElement
     */
    private function getPage()
    {
        return $this->getSession()->getPage();
    }

    /**
     * @return \Doctrine\ODM\MongoDB\DocumentManager
     */
    private function getDocumentManager()
    {
        return $this->getContainer()->get('doctrine.odm.mongodb.document_manager');
    }
}
