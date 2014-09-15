<?php
namespace Application\Features\Context;


use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException,
    Behat\MinkExtension\Context\MinkContext;

use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use MvLabs\Zf2Extension\Context\Zf2AwareContextInterface;

use Zend\Mvc\Application;
//
// Require 3rd-party libraries here:
//
// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
* Feature context.
*/
class FeatureContext extends MinkContext
implements Zf2AwareContextInterface
{
    private $zf2MvcApplication;
    private $parameters;

    /**
    * Initializes context with parameters from behat.yml.
    *
    * @param array $parameters
    */
    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    /**
    * Sets Zend\Mvc\Application instance.
    * This method will be automatically called by Zf2Extension ContextInitializer.
    *
    * @param Zend\Mvc\Application $zf2MvcApplication
    */
    public function setZf2App(Application $zf2MvcApplication)
    {
        $this->zf2MvcApplication = $zf2MvcApplication;
    }

    //
    // Place your definition and hook methods here:
    //
    // /**
    // * @Given /^I have done something with "([^"]*)"$/
    // */
    // public function iHaveDoneSomethingWith($argument)
    // {
    //  $serviceManager = $this->zf2MvcApplication->getServiceManager();
    //  $serviceManager->get('service.example')->doSomethingWith($argument);
    // }
//

    /**
     * @Then /^I should see the "([^"]*)" page$/
     */
    public function iShouldSeeThePage($pageTitle)
    {
        // Siamo sul sito giusto?
        $this->assertPageContainsText('Hubme.in');
        
        // Asserire che lo status code ci vada bene
        $this->assertResponseStatus(200);
        
        // Asserire che la pagina invocata sia quella corretta
        $this->assertPageAddress('/'.  strtolower($pageTitle));
        
        // Asserire che il titolo sia quello giusto
        $this->assertElementContains('h2 strong', $pageTitle);
    }
}
