<?php

class SearchController extends AbstractController {
    public function index() {
        $posts = Table::factory('Posts')->findAllForTagOrTitle($this->request->getVar('q'));
        $query = $this->request->getVar('q');
        if ($query !== null && trim($query) != "") {
            $this->assign('search_query', $this->request->getVar('q'));
        }
        $this->assign('posts', $posts);
    }
}
