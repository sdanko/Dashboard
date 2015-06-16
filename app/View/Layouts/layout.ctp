<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title><?php echo $title; ?></title>
    <!-- Include external files and scripts here (See HTML helper for more info.) -->
    <?php
        echo $this->Html->script('jquery-1.9.1');
        echo $this->Html->script('jquery-ui-1.10.3');
        
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');
        echo $this->Html->css(array('bootstrap', 'themes/base/jquery-ui'));
    ?>

</head>
<body>
    
    <!-- Header -->

    <div class="navbar navbar-inverse navbar-static-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Administracija</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
            <?php
                $username = $this->session->read('Auth.User.username');
                if (!empty($username)) { 
            ?>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $username; ?><b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                      </ul>
                </li>
            <?php } ?>
                <li><?php echo $this->Html->link('Log out', array('controller' => 'publishers', 'action' => 'logout')) ?></li>
            </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <!-- /Header -->

    <!-- Main -->
    <div class="container">
        <div class="row">
	        <div class="col col-lg-3">
              <!-- Left -->
              <ul class="nav nav-pills nav-stacked">
                <li class="nav-header"></li>
                <?php 
                echo $this->Menu->item($this->Html->link('Pocetna', array('controller' => 'home', 'action' => 'index')));
                echo $this->Menu->item($this->Html->link('Izvjestaji', array('controller' => 'report', 'action' => 'index'))); 
                ?>
                <li><a href="#">Postavke</a></li>
                <li><a href="#">Jezici</a></li>
                <li><a href="#">Servisi</a></li>
              </ul>
  	        </div><!-- /span-3 -->
                
            <?php echo $this->fetch('content'); ?>

        </div>
    </div>
    <!-- /Main -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
     <?php
        echo $this->Html->script('bootstrap');
        echo $this->Js->writeBuffer(); 
    ?>
</body>
</html>