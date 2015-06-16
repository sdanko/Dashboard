<?php 
    
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
        <div class="col-md-4">
            <?php echo $this->Form->input('from',  array('label' => false, 'div' => false, 'class' => 'datefield form-control')); ?>
        </div>
        <div class="col-md-4">
            <?php echo $this->Form->input('to', array('label' => false, 'div' => false, 'class' => 'datefield form-control')); ?>
        </div>
        
      <button type="submit" class="btn btn-default">Izvještaj</button>
      
      <?php echo $this->Form->end(); ?>

    <hr />

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
        sortable: false,
        condensed: true,
        stripped: true,
        bordered:true
      });
    });
    </script>