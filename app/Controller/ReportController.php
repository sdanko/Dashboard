<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('AppController', 'Controller');
App::uses('CakeTime', 'Utility');

/**
 * CakePHP ReportController
 * @author selvedin
 */
class ReportController extends AppController {

    public function index() {
         $this->layout = 'layout';
          
         $this->set('title', 'Izvjestaj'); 
    }
    
     public function generate_report() {
         $this->layout = 'layout';
          
         $this->set('title', 'Izvjestaj'); 
         
         if(!empty($this->request->data)) {
            $fromFormatted= CakeTime::format($this->request->data['from'], '%Y-%m-%d');
            $toFormatted= CakeTime::format($this->request->data['to'], '%Y-%m-%d');
         }
         
         if(!empty($this->request->data)) {
             $this->set('reportData', $this->build_report_data($this->Report->generateReport($this->Auth->user('publisher_id'),$fromFormatted,$toFormatted)));
         }
    }
    
    private function build_report_data($result) {
        $currency=0;
        $current_currency=0;
        $current_currency_total=0;
        $reportData['currencies']=array();
        
        //var_dump($result);
        
        if($result) {
            $reportData['name'] = $result[0]['pub']['name'];
            $reportData['start_date'] = $result[0][0]['start_date'];
            $reportData['end_date'] = $result[0][0]['end_date'];
        }
                
        foreach($result as $row) {
            if($current_currency!=$row['c']['currency_id']) {
                if($currency) {
                    $reportData['currencies'] [] = $currency;
                }
                
                $currency = array();
                $currency['books'] = array();
                
                $currency['currency_id'] = $row['c']['currency_id'];
                $currency['name'] = $row['c']['title'];
                $currency['total'] = $current_currency_total;
                
                if($row['c']['symbol_left']) {
                    $currency['total_string'] = $row['c']['symbol_left'] . ' ' .
                            sprintf( '%.02f' ,$currency['total']);
                }
                else {
                    $currency['total_string'] = sprintf( '%.02f' ,$currency['total']) . ' ' .
                            $row['c']['symbol_right'];
                }
                
                $current_currency = $row['c']['currency_id'];
                $current_currency_total = 0;
            }
            
            $currency['books'] [] = array(
                'author'    =>  $row['auth']['author'],
                'book_name' =>  $row['pd']['book_name'],
                'price'     =>  $row['p']['price'],
                'order_num' =>  $row[0]['order_num'],
                'book_sum'  =>  $row[0]['author_sum']
            );
            
            $current_currency_total += $row[0]['author_sum'];
        }
        
        //red je potreban radi dodavanja zadnje valute u niz
        $reportData['currencies'] [] = $currency;
        
        //var_dump($reportData);
        return $reportData;
    }

}
