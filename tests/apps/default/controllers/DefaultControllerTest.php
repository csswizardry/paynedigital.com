<?php

class DefaultControllerTest extends PHPUnitTestController {
    public function testIndexAction() {
        $this->request->dispatch("/");
        $this->assertResponseCode(200);
        $this->assertController("Default");
        $this->assertApp("default");
        $this->assertAction("index");
    }

    /**
     * @dataProvider basicActionsDP
     */
    public function testBasicActions($url, $action, $controller="Default", $app="default", $responseCode=200, $isRedirect = false, $redirectUrl = null) {

        $this->request->dispatch($url);
        $this->assertResponseCode($responseCode);
        $this->assertController($controller);
        $this->assertApp($app);
        $this->assertAction($action);
        $this->assertRedirect($isRedirect);
        if ($redirectUrl !== null) {
            $this->assertRedirectUrl($redirectUrl);
        }
    }

    public function basicActionsDP() {
        return array(
            array("/", "index"),
            array("/contact", "index", "Contact", "contact"),
            array("/contact/thanks", "thanks", "Contact", "contact", 303, true, "/"),
            array("/articles", "index", "Blog", "blog"),
            array("/2011/01", "view_month", "Blog", "blog"),
            array("/2011/09/another-test-post", "view_post", "Blog", "blog"),
            array("/2011/09/another-test-post/comment/thanks", "comment_thanks", "Blog", "blog", 303, true, "/"),
            array("/tag/foo", "search_tags", "Blog", "blog"),
            array("/search", "index", "Search", "search"),
            array("/feed.xml", "index", "Feed", "feed"),
            array("/feed.rss", "index", "Feed", "feed"),
            /**
             * static pages (no logic, just tpls)
             */
            array("/about", "view_static", "Static", "static"),
            array("/services", "view_static", "Static", "static"),
        );
    }

    public function testCompanyInformationShownInFooter() {
        $this->request->dispatch("/");

        $this->assertBodyHasContentsInOrder("<div id='footer'>");
        $this->assertBodyHasContentsInOrder("13 Moorland Avenue, Leeds, LS20 9EQ");
        $this->assertBodyHasContentsInOrder("Company No. 07277912");
        $this->assertBodyHasContentsInOrder("VAT No. 991909470");
    }

    public function testHomepageShowsPostArchive() {
        $this->request->dispatch("/");

        $this->assertBodyHasContentsInOrder("The Archive");
        $this->assertBodyHasContentsInOrder("September 2011");
        $this->assertBodyHasContentsInOrder("July 2011");
    }
}
