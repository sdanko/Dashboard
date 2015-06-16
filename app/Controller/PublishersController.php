<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');

/**
 * CakePHP PublisherController
 * @author selvedin
 */
class PublishersController extends AppController {
    
    public function add() {
        $this->layout = 'layout';
        
        if ($this->request->is('post')) {
            $this->Publisher->create();
            if ($this->Publisher->save($this->request->data)) {
                $this->Session->setFlash(__('The publisher has been saved'));
                return $this->redirect(array('action' => 'add'));
            }
            $this->Session->setFlash(
                __('The publisher could not be saved. Please, try again.')
            );
        }
    }

    public function beforeFilter() {
        //parent::beforeFilter();
        // Allow users to register and logout.
        $this->Auth->allow('add', 'logout');
    }

    public function login() {
        $this->layout = 'layout';
        $this->set('title', 'Login'); 
        
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                return $this->redirect($this->Auth->redirect());
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

}
