<?php

require_once __DIR__ . '/vendor/simpletest/simpletest/unit_tester.php';
require_once __DIR__ . '/vendor/simpletest/simpletest/web_tester.php';
require_once __DIR__ . '/vendor/parser.php';

const MAX_POINTS = 5;
const RESULT_PATTERN = "\nRESULT: %s of %s POINTS\n";

class HwTests extends WebTestCase {

    public function getTests() {
        return empty($this->getSelectedTestMethodNames())
            ? $this->getAllTestMethodNames()
            : $this->getSelectedTestMethodNames();
    }

    private function getSelectedTestMethodNames() {
        $methodNames = $this->getAllTestMethodNames();

        return array_filter($methodNames, function ($each) {
            return preg_match('/^_/', $each);
        });
    }

    private function getAllTestMethodNames() {
        $class = get_class($this);

        $r = new ReflectionClass($class);

        $testMethods = array_filter($r->getMethods(), function ($each) use ($class) {
            return $each->class === $class && $each->isPublic();
        });

        return array_map(
            function ($each) {
                return $each->name;
            }, $testMethods);
    }

    public function printSource() {
        print $this->getBrowser()->getContent();
    }

    public function get($url, $parameters = false) {
        $result = parent::get($url, $parameters);

        $this->assertCorrectSource();

        return $result;
    }

    public function clickLink($label, $index = 0) {
        $this->assertLink($label);

        $result = parent::clickLink($label, $index);

        $this->assertCorrectSource();

        return $result;
    }

    public function clickLinkById($id) {
        $this->assertLinkById($id);

        $result = parent::clickLinkById($id);

        $this->assertCorrectSource();

        return $result;
    }

    public function clickByName($name, $additional = false) {
        $value = $this->getBrowser()->getField($name);

        if (!$value) {
            $this->assertTrue(false, "input with type 'submit' and name '$name' should exist");
        }

        $result = parent::clickByName($name, $additional);

        $this->assertCorrectSource();

        return $result;
    }

    private function assertCorrectSource() {
        $source = $this->getBrowser()->getContent();

        $message = (new tplLib\HtmlValidator())->validate($source);

        if ($message !== null) {
            $this->assertTrue(false, $message);
        }
    }

    public function assertFrontControllerLink($linkId) {

        $href = $this->getBrowser()->getLinkHrefById($linkId);

        $pattern = '/^(index\.php)?\?[-=&\w]*$/';

        $message = 'Front Controller pattern expects all links '
            . 'to be in ?key1=value1&key2=... format. But this link was: ' . $href;

        $this->assert(new PatternExpectation($pattern), $href, $message);
    }

    public function assertAttribute($attribute, $value) {
        $pattern = '/' . $attribute . '\s*=\s*["\']' . $value . '["\']/';

        $this->assertPattern($pattern,
            "can't find element with attribute '$attribute' and value '$value'");
    }

    public function assertElementById($id) {
        $this->assertPattern('/id\s*=\s*["\']?' . $id . '["\']?/',
            "can't find element with id '$id'");
    }

    public function assertNoElementById($id) {
        $this->assertNoPattern('/id\s*=\s*["\']?' . $id . '["\']?/',
            "element with id '$id' should not exits");
    }

    public function assertNoField($fieldName) {
        $value = $this->getBrowser()->getField($fieldName);

        if ($value !== NULL) {
            $this->assertTrue(false, "field '$fieldName' should not exist");
        }
    }

    public function assertSingleMatch($textToMatch) {
        $text = $this->getBrowser()->getContentAsText();

        $matchCount = substr_count($text, $textToMatch);

        if ($matchCount !== 1) {
            $this->fail(sprintf("Expecting to find text '%s' once but found it %s times",
                $textToMatch, $matchCount));
        }
    }

    public function getLinkLabelById($id) {
        return $this->getBrowser()->getLinkLabelById($id);
    }

    public function getFieldValue($name) {
        return $this->getBrowser()->getField($name);
    }

    public function assertSelectedOption($fieldName, $optionText) {
        $htmlSource = $this->getBrowser()->getContent();

        $optionValue = $this->findOptionValue($htmlSource, $optionText);

        if ($optionValue === null) {
            $this->fail(sprintf("Did not find option with text '%s' and value attribute", $optionText));
            return;
        }

        $this->assertFieldByName($fieldName, $optionValue,
            sprintf("field '%s' does not match '%s'", $fieldName, $optionText));
    }

    function findOptionValue($htmlSource, $optionText) {
        $htmlSource = preg_replace("/[\"']/", " ", $htmlSource);

        $matches = [];

        preg_match_all("/<option.*?option>/m", $htmlSource, $matches);

        foreach ($matches[0] as $option) {
            if (preg_match("/>" . $optionText . "</", $option)) {

                $matches = [];
                preg_match("/value\s*=\s*([^\s>]+)/m", $option, $matches);

                return isset($matches[1]) ? $matches[1] : null;
            }
        }

        return null;
    }

}

class PointsReporter extends TextReporter {

    private $maxPoints;
    private $failCountBeforeTest;
    private $passedMethodCount = 0;
    private $totalMethodRunCount = 0;
    private $scale;

    public function __construct($maxPoints, $scale) {
        parent::__construct();
        $this->maxPoints = $maxPoints;
        $this->scale = $scale;
    }


    public function paintMethodStart($test_name) {
        $this->failCountBeforeTest =
            $this->getFailCount() + $this->getExceptionCount();

        parent::paintMethodStart($test_name);
    }

    public function paintMethodEnd($test_name) {
        $this->totalMethodRunCount++;

        if ($this->failCountBeforeTest < $this->getFailCount() + $this->getExceptionCount()) {
            printf("%s failed\n", $test_name);
        } else {
            $this->passedMethodCount++;
            printf("%s ok\n", $test_name);
        }

        parent::paintMethodEnd($test_name);
    }

    public function paintFooter($test_name) {
        $keys = array_keys($this->scale);
        $maxThreshold = array_pop($keys);

        if ($this->totalMethodRunCount < $maxThreshold) {
            return; // do not show points if some test are disabled
        }

        $finalPoints = 0;

        foreach ($this->scale as $threshold => $points) {
            if ($this->passedMethodCount >= $threshold) {
                $finalPoints = $points;
            }
        }

        printf(RESULT_PATTERN, $finalPoints, $this->maxPoints);
    }
}

class Author {
    public $firstName;
    public $lastName;
    public $grade;
}

class Book {
    public $title;
    public $grade;
    public $isRead;
}

function getSampleAuthor() {
    $author = new Author();
    $randomValue = substr(md5(mt_rand()), 0, 9);
    $author->firstName = $randomValue . '0';
    $author->lastName = $randomValue . '1';
    $author->grade = 5;
    return $author;
}

function getSampleBook() {
    $book = new Book();
    $randomValue = substr(md5(mt_rand()), 0, 9);
    $book->title = $randomValue . '0';
    $book->grade = 5;
    $book->isRead = true;
    return $book;
}
