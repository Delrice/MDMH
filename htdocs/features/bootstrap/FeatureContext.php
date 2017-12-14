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
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

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
}
