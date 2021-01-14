<?php

require_once 'common.php';

const BASE_URL = 'http://localhost:8080/';

class Hw3Tests extends HwTests {

    function baseUrlResponds() {
        $this->get(BASE_URL);
        $this->assertResponse([200]);
    }

    function startPageHasMenuWithCorrectLinks() {
        $this->get(BASE_URL);

        $this->assertLinkById('book-list-link');
        $this->assertLinkById('book-form-link');
        $this->assertLinkById('author-list-link');
        $this->assertLinkById('author-form-link');

    }

    function bookFormPageHasCorrectElements() {
        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $this->assertField('title');
        $this->assertField('grade');
        $this->assertField('isRead');

        $this->assertField('submitButton');
    }

    function authorFormPageHasCorrectElements() {
        $this->get(BASE_URL);

        $this->clickLinkById('author-form-link');

        $this->assertField('firstName');
        $this->assertField('lastName');
        $this->assertField('grade');

        $this->assertField('submitButton');
    }

    function submittingBookFormAddsBookToList() {

        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $book = getSampleBook();

        $this->setFieldByName('title', $book->title);
        $this->setFieldByName('grade', $book->grade);
        $this->setFieldByName('isRead', $book->isRead);

        $this->clickByName('submitButton');

        $this->assertText($book->title);
    }

    function submittingAuthorFormAddsAuthorToList() {

        $this->get(BASE_URL);

        $this->clickLinkById('author-form-link');

        $author = getSampleAuthor();

        $this->setFieldByName('firstName', $author->firstName);
        $this->setFieldByName('lastName', $author->lastName);
        $this->setFieldByName('grade', $author->grade);

        $this->clickByName('submitButton');

        $this->assertText($author->firstName);
        $this->assertText($author->lastName);
    }

    function canHandleDifferentSymbolsInBookTitles() {

        $this->get(BASE_URL);
        $this->clickLinkById('book-form-link');

        $title = "!.,:;\n" . getSampleBook()->title;

        $this->setFieldByName('title', $title);

        $this->clickByName('submitButton');

        $this->assertSourceContains($title);
    }

    function canHandleDifferentSymbolsInAuthorNames() {

        $this->get(BASE_URL);
        $this->clickLinkById('author-form-link');

        $firstName = "!.,:;\n" . getSampleAuthor()->firstName;
        $lastName = "!.,:;\n" . getSampleAuthor()->lastName;

        $this->setFieldByName('firstName', $firstName);
        $this->setFieldByName('lastName', $lastName);

        $this->clickByName('submitButton');

        $this->assertSourceContains($firstName);
        $this->assertSourceContains($lastName);
    }
}

(new Hw3Tests())->run(new PointsReporter(5, [6 => 3, 8 => 5]));
