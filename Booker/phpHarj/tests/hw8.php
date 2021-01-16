<?php

require_once 'common-selenium.php';

const BASE_URL = 'http://localhost:8080';

class Hw8Tests extends SeleniumTests {

    function baseUrlResponds() {
        $this->getInChrome(BASE_URL);

        $this->closeBrowser();
    }

    function startPageHasMenuWithCorrectLinks() {
        $this->getInChrome(BASE_URL);

        $this->assertLinkById('book-list-link');
        $this->assertLinkById('book-form-link');
        $this->assertLinkById('author-list-link');
        $this->assertLinkById('author-form-link');

        $this->closeBrowser();
    }

    function canSaveBooks() {

        $this->getInChrome(BASE_URL);

        $this->clickLinkById('book-form-link');

        $book = getSampleBook();

        $this->setFieldByName('title', $book->title);

        $this->clickByName('submitButton');

        $this->assertSingleMatch($book->title);

        $this->closeBrowser();
    }

    function canUpdateBooks() {

        $this->getInChrome(BASE_URL);

        $this->clickLinkById('book-form-link');

        $title = getSampleBook()->title;
        $newTitle = getSampleBook()->title;

        $this->setFieldByName('title', $title);

        $this->clickByName('submitButton');

        $this->clickLinkByText($title);

        $this->setFieldByName('title', $newTitle);

        $this->clickByName('submitButton');

        $this->assertSingleMatch($newTitle);
        $this->assertNoText($title);

        $this->closeBrowser();
    }

    function canDeleteInsertedBooks() {

        $this->getInChrome(BASE_URL);

        $this->clickLinkById('book-form-link');

        $book = getSampleBook();

        $this->setFieldByName('title', $book->title);

        $this->clickByName('submitButton');

        $this->clickLinkByText($book->title);

        $this->clickByName('deleteButton');

        $this->assertNoText($book->title);

        $this->closeBrowser();
    }
}

(new Hw8Tests())->run(new PointsReporter(5, [5 => 5]));
