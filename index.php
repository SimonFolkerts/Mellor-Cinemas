<?php

final class Index {
    
    //constants
    const PAGE_DIRECTORY = '../page';

    //start session
    public function init() {
        session_start();
    }

    //functio to check if there is a page key in the GET, 
    //if yes then set the $page variable to the keys value in the GET.
    private function getPage() {
        if (array_key_exists('page', $_GET)) {
            $page = $_GET['page'];
            return $page;
        }
        //otherwise set the page variable to 'home' page by default
        else {
            return 'home';
        }
    }

    //function to send the $page to the template for display, 
    //and to require the $page controller and the template into the scope
    private function assemblePage($page) {
        $view = $this->getView($page);
        require $this->getController($page);
        require 'index-view.php';
    }
    
    //assemble the page using assemblePage, with the page determined by getPage
    public function run() {
        $this->assemblePage($this->getPage());
    }
    
    
    //MVC assemblers will return the correct page components.
    //e.g. page-controller/home-controller.php
    private function getController($page) {
        return self::PAGE_DIRECTORY . '-controller/' . $page . '-controller.php';
    }

    private function getView($page) {
        return self::PAGE_DIRECTORY . '-view/' . $page . '-view.php';
    }
}
 $index = new Index();
 $index->init();
 $index->run();