<?php 
    $total=0;
    $this->Html->css(array('tablecloth/css/tablecloth', 'tablecloth/css/prettify'), array('inline' => false));
    $this->Html->script(array('jquery.metadata', 'jquery.tablesorter.min', 'jquery.tablecloth'), array('inline' => false)); 
?>

<div class="row">
    <div class="col-lg-8">
      <h3>Generisanje izvještaja</h3>
      

    <?php 
         $options = array(
                'action' => 'generate_report',
                'class' => 'form-inline well'
            );
        echo $this->Form->create(false, $options);
    ?>
        <div class="col-md-3">
            <?php echo $this->Form->input('from',  array('label' => false, 'div' => false, 'class' => 'datefield form-control')); ?>
        </div>
        <div class="col-md-3">
            <?php echo $this->Form->input('to', array('label' => false, 'div' => false, 'class' => 'datefield form-control')); ?>
        </div>
        
      <button type="submit" class="btn btn-default">Izvještaj</button>
      
      <?php echo $this->Form->end(); ?>
      
    <hr />
    
    <h2> <?php
        if(!empty($reportData)) {
             echo sprintf("%s: %s",'Izdavač', $reportData[0]['pub']['name']);
        }
    ?></h2>
    <h3><?php 
        if(!empty($reportData)) {
            echo sprintf("%s: %s | %s: %s ",'Pocetni datum', $reportData[0][0]['start_date'], 'Zavrsni datum', $reportData[0][0]['end_date']);
        } ?>
    </h3>  
    
        <div id ="report">

            <?php if(!empty($reportData)) { ?>
                <table>
                    <thead>
                        <tr>
                            <th>Autor</th>
                            <th>Naziv knjige</th>
                            <th>Valuta</th>
                            <th>Cijena</th>
                            <th>Količina</th>
                            <th>Vrijednost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reportData as $row){ ?>
                        <tr>
                            <td><?php echo $row['auth']['author']; ?></td>
                            <td><?php echo $row['pd']['book_name']; ?></td>
                            <td><?php echo $row['c']['title']; ?></td>
                            <td class="text-right"><?php echo sprintf( '%.02f' ,$row['p']['price']); ?></td>
                            <td class="text-right"><?php echo $row[0]['order_num']; ?></td>
                            <td class="text-right"><?php $total+=$row[0]['author_sum'];echo sprintf( '%.02f' ,$row[0]['author_sum']); ?></td>
                        </tr>
                            <?php }} ?>
                    </tbody>
                </table>
                <div class="row text-right">
                    <div class="col-xs-2 col-xs-offset-8">
                      <p>
                        <strong>
                          Total : <br>
                        </strong>
                      </p>
                    </div>
                    <div class="col-xs-2">
                      <strong>
                        <?php echo sprintf( '%.02f' ,$total); ?> <br>
                      </strong>
                    </div>
                </div>
        </div>

    </div>
</div>

<script type="text/javascript" charset="utf-8">
     $(function () {
        $('.datefield').datepicker({ dateFormat: "dd.mm.yy", changeMonth: true, changeYear: true });
    });
    
    $(document).ready(function() {
      $("table").tablecloth({
        theme: "default",
        striped: true,
        sortable: true,
        condensed: true,
        stripped: true,
        bordered:true
      });
    });
    </script>