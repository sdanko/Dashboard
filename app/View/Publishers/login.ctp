<?php 
    $showAlert = false;
    $error = $this->Session->flash();
    if($error) {
        $showAlert = true;
    }
?>
     <div class="col-lg-8 alert alert-danger"  <?php if ($showAlert===false){?>style="display:none"<?php } ?>><?php echo $error; ?></div>
<div class="col-lg-5">
       <div class="form-signin">
           <h2 class="form-signin-heading">Prijava</h2>
           
           <?php echo $this->Session->flash('auth'); ?>
           <?php echo $this->Form->create('Publisher'); ?>
           
           <?php echo $this->Form->input('username',  array('label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => 'Korisničko ime')); ?>

           <?php echo $this->Form->input('password',  array('label' => false, 'div' => false, 'class' => 'form-control', 'placeholder' => 'Password')); ?>

           <hr/>
           
           <button type="submit" class="btn btn-lg btn-primary btn-block">Login</button>
       </div>


   </div> <!-- /container -->