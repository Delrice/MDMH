<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Definition\Call\Given;
use Behat\Behat\Definition\Call\When;
use Behat\Behat\Definition\Call\Then;
use Doctrine\Common\DataFixtures\Purger\MongoDBPurger;
use Symfony\Bridge\Doctrine\DataFixtures\ContainerAwareLoader;
use Doctrine\Common\DataFixtures\Executor\MongoDBExecutor;
use AppBundle\Document\User;
use AppBundle\Document\Restaurant;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends RawMinkContext implements Context
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
     * @BeforeScenario @fixtures-users
     */
    public function usersFixtures()
    {
        $this->loadFixture('UserFixtures');
    }

    /**
     * @BeforeScenario @fixtures-restaurants
     */
    public function restaurantsFixtures()
    {
        $this->loadFixture('RestaurantFixtures');
    }

    /**
     * @BeforeScenario @fixtures-dailysales
     */
    public function dailySalesFixtures()
    {
        $this->loadFixture('DailySalesFixtures');
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

    /**
     * @Then I should see some :name elements
     */
    public function iShouldSeeSomeElements($name)
    {
        $this->getPage()->has('css', $name);
    }

    /**
     * @Given There is :count user in database
     */
    public function thereIsUserInDatabase($count)
    {
        if ($count == 1) {
            $user = new User();
            $user->setUsername('editme');
            $user->setPassword('editme');
            $user->setEmail('editme@hmd.fr');
            $user->setAccessRole('ROLE_USERS');
            $this->getDocumentManager()->persist($user);
            $this->getDocumentManager()->flush();
        }else{
            throw new PendingException();
        }
    }

    /**************************************************/
    /******************* RESTAURANTS ******************/
    /**************************************************/

    /**
     * @Given There is :count restaurant in database
     */
    public function thereIsRestaurantInDatabase($count)
    {
        if ($count == 1) {
            $restaurant = new Restaurant();
            $restaurant->setName('editme');
            $restaurant->setIdentifier('FAKEIDENTIFIER');
            $this->getDocumentManager()->persist($restaurant);
            $this->getDocumentManager()->flush();
        }else{
            throw new PendingException();
        }
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

    public function loadFixture($filename=null)
    {
        $loader = new ContainerAwareLoader($this->getContainer());
        if (null == $filename)
            $loader->loadFromDirectory(__DIR__."/../DataFixtures/MongoDB");
        else
            $loader->loadFromFile(__DIR__."/../DataFixtures/MongoDB/$filename.php");
        $executor = new MongoDBExecutor($this->getDocumentManager());
        $executor->execute($loader->getFixtures(), true);
    }

    private function assertResponseStatus($code)
    {
        $this->assertSession()->statusCodeEquals($code);
    }
}
