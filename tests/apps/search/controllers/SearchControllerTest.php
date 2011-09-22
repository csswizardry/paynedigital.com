<?php

class SearchControllerTest extends PHPUnitTestController {
    public function setUp() {
        parent::setUp();
        $this->request->setProperties(array(
            "base_href" => Settings::getValue("site.base_href")
        ));
    }

    public function testSearchWithNoResults() {
        $this->request->setParams(array(
            "q" => "no matching content",
        ))->dispatch("/search");

        $this->assertBodyHasContents("Sorry - no posts match this query.");
    }

    public function testSearchWithResults() {
        $this->request->setParams(array(
            "q" => "test",
        ))->dispatch("/search");

        $this->assertBodyHasContents("Another Test Post");
        $this->assertBodyHasContents("This Is A Test Post");
        $this->assertBodyHasContents("Testing Tags");
        $this->assertBodyHasContents("Just A Test");
    }
}
