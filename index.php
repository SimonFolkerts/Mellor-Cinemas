<?php

final class Index {
    
    //load the following classes into the scope
    public function loadClass($name) {
        $classes = array(
            'Dao' => 'dao/Dao.php',
            'ShowingDao' => 'dao/ShowingDao.php',
            'Showing' => 'classes/Showing.php',
            'ShowingMapper' => 'mapping/ShowingMapper.php',
            'UserDao' => 'dao/UserDao.php',
            'User' => 'classes/User.php',
            'UserMapper' => 'mapping/UserMapper.php',
            'UserValidator' => 'validation/UserValidator.php',
            'Utilities' => 'utilities/Utilities.php'
        );
        if (!array_key_exists($name, $classes)) {
            die('Class "' . $name . '" not found.');
        }
        require_once $classes[$name];
    }
    
    //constants
    const PAGE_DIRECTORY = 'page';

    //start session and initiate class loading
    public function init() {
        session_start();
        spl_autoload_register(array($this, 'loadClass'));
    }

    //function to check if there is a page key in the GET, 
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
        require 'layout/index-view.php';
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