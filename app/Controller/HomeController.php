<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP Home
 * @author selvedin
 */
class HomeController extends AppController {

    public function index() {
        $this->layout = 'layout';

        $this->set('title', 'Pocetna'); 
    }

}
