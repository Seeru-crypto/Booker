<?php

require_once 'common.php';

const BASE_URL = 'http://localhost:8080/';

class Hw7Tests extends HwTests {

    function applicationLinksShouldBeInCorrectFormat() {

        $this->get(BASE_URL);

        // expected format is ?key1=value1&key2=value2&...

        $this->assertFrontControllerLink('book-list-link');
        $this->assertFrontControllerLink('book-form-link');
        $this->assertFrontControllerLink('author-list-link');
        $this->assertFrontControllerLink('author-form-link');

        $this->clickLinkById('book-form-link');

        $this->assertFrontControllerLink('book-list-link');
        $this->assertFrontControllerLink('book-form-link');
        $this->assertFrontControllerLink('author-list-link');
        $this->assertFrontControllerLink('author-form-link');

        $this->clickLinkById('author-list-link');

        $this->assertFrontControllerLink('book-list-link');
        $this->assertFrontControllerLink('book-form-link');
        $this->assertFrontControllerLink('author-list-link');
        $this->assertFrontControllerLink('author-form-link');
    }

    function makesRedirectAfterFormSubmission() {
        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $this->setMaximumRedirects(0);

        $book = getSampleBook();

        $this->setFieldByName('title', $book->title);
        $this->clickByName('submitButton');

        $this->assertResponse([302]);

        $source = $this->getBrowser()->getContent();

        $this->assertNoPattern('/[<>\w\d]/',
            "Should not print any output along with Location header " .
            "but output was: \n $source");
    }

    function canUpdateBooksWithSingleAuthor() {

        $originalAuthorName = $this->insertSampleAuthor();
        $newAuthorName = $this->insertSampleAuthor();

        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $book = getSampleBook();

        $this->setFieldByName('title', $book->title);
        $this->setFieldByName('author1', $originalAuthorName);

        $this->clickByName('submitButton');

        $this->clickLink($book->title);

        $this->assertFieldByName('title', $book->title);
        $this->assertSelectedOption('author1', $originalAuthorName);

        $this->setFieldByName('author1', $newAuthorName);

        $this->clickByName('submitButton');

        $this->assertText($newAuthorName);
        $this->assertNoText($originalAuthorName);
    }

    private function insertSampleAuthor() {
        $this->get(BASE_URL);

        $this->clickLinkById('author-form-link');

        $author = getSampleAuthor();

        $this->setFieldByName('firstName', $author->firstName);
        $this->setFieldByName('lastName', $author->lastName);

        $this->clickByName('submitButton');

        return $author->firstName . ' ' . $author->lastName;
    }
}

(new Hw7Tests())->run(new PointsReporter(5, [3 => 5]));
