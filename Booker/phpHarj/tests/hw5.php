<?php

require_once 'common.php';

const BASE_URL = 'http://localhost:8080';

class Hw5Tests extends HwTests {

    function canSaveBooksWithSingleAuthor() {

        $authorName = $this->insertSampleAuthor();

        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $book = getSampleBook();

        $this->setFieldByName('title', $book->title);
        $this->setFieldByName('author1', $authorName);

        $this->clickByName('submitButton');

        $this->assertSingleMatch($book->title);
        $this->assertSingleMatch($authorName);
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

    function canSaveBooksWithMultipleAuthors() {

        $author1 = $this->insertSampleAuthor();
        $author2 = $this->insertSampleAuthor();

        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $book = getSampleBook();

        $this->setFieldByName('title', $book->title);
        $this->setFieldByName('author1', $author1);
        $this->setFieldByName('author2', $author2);

        $this->clickByName('submitButton');

        $this->assertSingleMatch($book->title);
        $this->assertSingleMatch($author1);
        $this->assertSingleMatch($author2);
    }

    function canUpdateBooksWithMultipleAuthors() {

        $author1 = $this->insertSampleAuthor();
        $author2 = $this->insertSampleAuthor();
        $author3 = $this->insertSampleAuthor();

        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $book = getSampleBook();

        $this->setFieldByName('title', $book->title);
        $this->setFieldByName('author1', $author1);
        $this->setFieldByName('author2', $author2);

        $this->clickByName('submitButton');

        $this->clickLink($book->title);

        $this->assertFieldByName('title', $book->title);
        $this->assertSelectedOption('author1', $author1);
        $this->assertSelectedOption('author2', $author2);

        $this->setFieldByName('author1', $author2);
        $this->setFieldByName('author2', $author3);

        $this->clickByName('submitButton');

        $this->assertText($author2);
        $this->assertText($author3);
        $this->assertNoText($author1);
    }

    function doesNotAllowSqlInjection() {
        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $book = getSampleBook();

        $dangerousData = "';\"";
        $dangerousTitle = $book->title . $dangerousData;

        $this->setFieldByName('title', $dangerousTitle);
        $this->setFieldByName('grade', $dangerousData);
        $this->setFieldByName('isRead', $dangerousData);
        $this->setFieldByName('author1', $dangerousData);
        $this->setFieldByName('author2', $dangerousData);

        $this->clickByName('submitButton');

        $this->assertText($dangerousTitle);
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

(new Hw5Tests())->run(new PointsReporter(5, [3 => 3, 5 => 5]));
