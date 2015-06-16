<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppModel', 'Model');

/**
 * CakePHP ReportModel
 * @author selvedin
 */
class Report extends AppModel {
    public $useTable = false;
     
    public function generateReport($id, $from, $to) {
        //$result=$this->execute('call publisherReport(' . $id . ',' . $from . ',' . $to . ')');
        
        $this->begin();
        $result = $this->query("CALL publisherReport(" . $id . ",'" . $from . "','" . $to . "')");
        $this->commit();
        
        return $result;
    }
}
