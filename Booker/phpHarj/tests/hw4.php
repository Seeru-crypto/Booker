<?php

require_once 'common.php';

const BASE_URL = 'http://localhost:8080';

class Hw4Tests extends HwTests {

    function displaysErrorWhenSubmittingInvalidBookData() {

        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $this->clickByName('submitButton');

        $this->assertElementById('error-block');

        $this->setFieldByName('title', "aa");

        $this->clickByName('submitButton');

        $this->assertElementById('error-block');

        $this->setFieldByName('title', "aaa");

        $this->clickByName('submitButton');

        $this->assertNoElementById('error-block');
        $this->assertElementById('message-block');
    }

    function onValidationErrorDisplayedBookFormIsFilledWithInsertedData() {

        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $this->setFieldByName('title', "a");
        $this->setFieldByName('grade', "4");
        $this->setFieldByName('isRead', true);

        $this->clickByName('submitButton');

        $this->assertFieldByName('title', "a");
        $this->assertFieldByName('grade', "4");
        $this->assertFieldByName('isRead', true);
    }

    function displaysErrorWhenSubmittingInvalidAuthorData() {

        $this->get(BASE_URL);

        $this->clickLinkById('author-form-link');

        $this->clickByName('submitButton');

        $this->assertElementById('error-block');

        $this->setFieldByName('firstName', "a");
        $this->setFieldByName('lastName', "aa");

        $this->clickByName('submitButton');

        $this->assertNoElementById('error-block');
        $this->assertElementById('message-block');
    }

    function onValidationErrorDisplayedAuthorFormIsFilledWithInsertedData() {

        $this->get(BASE_URL);

        $this->clickLinkById('author-form-link');

        $this->setFieldByName('firstName', "a");
        $this->setFieldByName('lastName', "b");
        $this->setFieldByName('grade', "3");

        $this->clickByName('submitButton');

        $this->assertFieldByName('firstName', "a");
        $this->assertFieldByName('lastName', "b");
        $this->assertFieldByName('grade', "3");
    }

    function canUpdateInsertedBooks() {

        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $book = getSampleBook();

        $this->setFieldByName('title', $book->title);
        $this->setFieldByName('grade', 5);
        $this->setFieldByName('isRead', false);

        $this->clickByName('submitButton');

        $this->clickLink($book->title);

        $this->assertFieldByName('title', $book->title);
        $this->assertFieldByName('grade', 5);
        $this->assertFieldByName('isRead', false);

        $updatedBook = getSampleBook();

        $this->setFieldByName('title', $updatedBook->title);

        $this->clickByName('submitButton');

        $this->assertText($updatedBook->title);
        $this->assertNoText($book->title);
    }

    function canUpdateInsertedAuthors() {

        $this->get(BASE_URL);

        $this->clickLinkById('author-form-link');

        $author = getSampleAuthor();

        $this->setFieldByName('firstName', $author->firstName);
        $this->setFieldByName('lastName', $author->lastName);
        $this->setFieldByName('grade', 5);

        $this->clickByName('submitButton');

        $this->clickLink($author->firstName);

        $this->assertFieldByName('firstName', $author->firstName);
        $this->assertFieldByName('lastName', $author->lastName);
        $this->assertFieldByName('grade', 5);

        $updatedAuthor = getSampleAuthor();

        $this->setFieldByName('firstName', $updatedAuthor->firstName);

        $this->clickByName('submitButton');

        $this->assertText($updatedAuthor->firstName);
        $this->assertNoText($author->firstName);
    }

    function canDeleteInsertedBooks() {

        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $book = getSampleBook();

        $this->setFieldByName('title', $book->title);

        $this->clickByName('submitButton');

        $this->clickLink($book->title);

        $this->clickByName('deleteButton');

        $this->assertNoText($book->title);
    }

    function canDeleteInsertedAuthors() {

        $this->get(BASE_URL);

        $this->clickLinkById('author-form-link');

        $author = getSampleAuthor();

        $this->setFieldByName('firstName', $author->firstName);
        $this->setFieldByName('lastName', $author->lastName);

        $this->clickByName('submitButton');

        $this->clickLink($author->firstName);

        $this->clickByName('deleteButton');

        $this->assertNoText($author->firstName);
    }

    function bookFormsDeleteButtonIsNotVisibleWhenAddingNewBook() {
        $this->get(BASE_URL);

        $this->clickLinkById('book-form-link');

        $this->assertNoField('deleteButton');
    }

    function authorFormsDeleteButtonIsNotVisibleWhenAddingNewAuthor() {
        $this->get(BASE_URL);

        $this->clickLinkById('author-form-link');

        $this->assertNoField('deleteButton');
    }

}

(new Hw4Tests())->run(new PointsReporter(5, [6 => 3, 10 => 5]));
