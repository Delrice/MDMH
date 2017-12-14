<?php

use Behat\Behat\Context\Context;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Definition\Call\Given;
use Behat\Behat\Definition\Call\When;
use Behat\Behat\Definition\Call\Then;

/**
 * Defines application features from the specific context.
 */
class AuthenticationContext extends MinkContext implements Context
{
    use \Behat\Symfony2Extension\Context\KernelDictionary;

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
     * @return \Behat\Mink\Element\DocumentElement
     */
    private function getPage()
    {
        return $this->getSession()->getPage();
    }








}
