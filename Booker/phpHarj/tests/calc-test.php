<?php

require_once 'common.php';

const BASE_URL = 'http://localhost:8080/';

class CalcTests extends HwTests {

    function baseUrlResponds() {
        $this->get(BASE_URL);
        $this->assertResponse([200]);
    }

    function landingPageHasMenuWithCorrectLinks() {
        $this->get(BASE_URL);
        //prindib välja lehekülje sisu
            //print $this->getBrowser ()->getContent();
        $this->assertLinkById('c2f');
        $this->assertLinkById('f2c');
    }

    function f2cPageHasMenuWithCorrectLinks() {
        $this->get(BASE_URL);

        $this->clickLinkById('f2c');

        $this->assertLinkById('c2f');
        $this->assertLinkById('f2c');
    }

    function calculatesCelsiusToFahrenheit() {
        $this->get(BASE_URL);

        $this->setFieldByName('temperature', 20);

        $this->clickSubmitById('calculateButton');

        $this->assertText('is 68 decrees');
    }

    function calculatesFahrenheitToCelsius() {
        $this->get(BASE_URL);

        $this->clickLinkById('f2c');

        $this->setFieldByName('temperature', 68);

        $this->clickSubmitById('calculateButton');

        $this->assertText('is 20 decrees');
    }

}

(new CalcTests())->run(new TextReporter());
