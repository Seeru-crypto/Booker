<?php

require_once __DIR__ . '/vendor/php-webdriver/autoload.php';
require_once __DIR__ . '/common.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverSelect;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Exception\UnexpectedTagNameException;
use Facebook\WebDriver\Chrome\ChromeOptions;

const SELENIUM_SERVER_URL = 'http://localhost:4444/';

const MAX_WAIT_TIME = 5;
const POLL_FREQUENCY = 500;

class SeleniumTests extends HwTests {
    private $driver;

    protected function closeBrowser() {
        $this->driver->quit();
    }

    protected function getInChrome($url) {
        $this->driver = $this->getDriver();

        $this->driver->get($url);
    }

    public function assertLinkById($id, $expected = true, $message = '%s') {
        $this->getElement(WebDriverBy::id($id));
    }

    public function assertFieldByName($name, $expected = true, $message = '%s') {
        $this->getElement(WebDriverBy::name($name));
    }

    public function clickLinkById($id) {
        $this->clickAndWaitUrlChange(WebDriverBy::id($id));
    }

    public function clickLinkByText($text) {
        $this->clickAndWaitUrlChange(WebDriverBy::linkText($text));
    }

    public function clickByName($name, $additional = false) {
        $this->clickAndWaitUrlChange(WebDriverBy::name($name));
    }

    public function setFieldByName($name, $value, $position=false) {
        $this->assertFieldByName($name);

        $this->setValueBySelector(WebDriverBy::name($name), $value);
    }

    public function selectByName($name, $label) {
        $originalElement = $this->driver->findElement(WebDriverBy::name($name));

        try {
            $select = new WebDriverSelect($originalElement);
            $select->selectByVisibleText($label);
        } catch (NoSuchElementException $e) {
            throw new AssertionError('Select does not have option with label: ' . $label);
        } catch (UnexpectedTagNameException $e) {
            throw new AssertionError('unexpected tag with name: ' . $name);
        }
    }

    public function assertSingleMatch($textToMatch) {
        $matchCount = 0;

        $this->driver->wait(MAX_WAIT_TIME, POLL_FREQUENCY)->until(
            function () use ($textToMatch, $matchCount) {
                $text = $this->driver->getPageSource();

                $matchCount = substr_count($text, $textToMatch);

                return $matchCount === 1;
            },
            sprintf(
                "Expecting to find text '%s' once but found it %s times",
                $textToMatch, $matchCount)
        );
    }

    public function assertNoText($textToMatch, $message = '%s') {
        $text = $this->driver->getPageSource();

        $matchCount = substr_count($text, $textToMatch);

        if ($matchCount !== 0) {
            $this->fail(sprintf(
                "Expecting not to find text '%s' but found it",
                $textToMatch));
        }
    }

    private function setValueBySelector($selector, $value) {

        $this->driver->wait(MAX_WAIT_TIME, POLL_FREQUENCY)->until(
            function () use ($selector, $value) {
                $input = $this->driver->findElement($selector);

                $input->clear()->sendKeys($value);

                $readValue = $input->getAttribute('value');

                return $readValue === $value;
            },
            sprintf("Could not set value to element %s = '%s'",
                $selector->getMechanism(), $selector->getValue())
        );
    }

    private function clickAndWaitUrlChange($selector) {
        $element = $this->getElement($selector);

        sleep(1); // sometimes the element is found but if clicked
                  // too soon the click fails.

        $previousUrl = $this->driver->getCurrentURL();

        $element->click();

        $this->driver->wait(MAX_WAIT_TIME, POLL_FREQUENCY)->until(
            function () use ($previousUrl) {
                $tmpUrl = $this->driver->getCurrentURL();

                return $previousUrl !== $tmpUrl;
            },
            sprintf("Url did not change from %s", $previousUrl)
        );
    }

    private function getElement($selector) {
        $message = sprintf("Did not find element %s = '%s'",
            $selector->getMechanism(), $selector->getValue());

        $this->driver->wait(MAX_WAIT_TIME, POLL_FREQUENCY)->until(
            WebDriverExpectedCondition::presenceOfElementLocated($selector), $message
        );

        return $this->driver->findElement($selector);
    }

    private function getDriver() {
        $options = new ChromeOptions();
        $options->addArguments(
            ['headless', 'no-sandbox', 'disable-gpu']);

        $capabilities = DesiredCapabilities::chrome();
        $capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

        return RemoteWebDriver::create(SELENIUM_SERVER_URL, $capabilities);
    }

}
