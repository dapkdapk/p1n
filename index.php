<?php
$relBootStrapPath = "vendor/twbs/bootstrap/dist/";
$relJQueryPath = "vendor/components/jquery/";
$relKnockoutPath = "vendor/itguy614/knockout/js/";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- JQuery -->
    <!-- <script src="<?=$relJQueryPath?>jquery.min.js"></script> -->
    <!-- Bootstrap -->
    <link href="<?=$relBootStrapPath?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Knockout -->
    <script src="<?=$relKnockoutPath?>knockout.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  
    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
 
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">P1N your url!</a>
        </div>
<!-- 
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Action</a></li>
                <li><a href="#">Another action</a></li>
                <li><a href="#">Something else here</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Nav header</li>
                <li><a href="#">Separated link</a></li>
                <li><a href="#">One more separated link</a></li>
              </ul>
            </li>
          </ul>
        </div>
-->        
      </div>
    </nav>  
	
	<div class="container" role="main">
	
	<div id="topalign">
		<p>&nbsp;</p>
		<p>&nbsp;</p>	
	</div>
	
      <div data-bind="visible: showNewUrl"><h4>short url</h4></div>	
	
	
      <form class="form">
        <h2 class="form-heading">Enter your url</h2>
        <label for="inputUrl" class="sr-only">http://</label>
        <input type="url" id="inputUrl" class="form-control" placeholder="http://" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Get short url!</button>
      </form>    
     </div>
     
<script type="text/javascript">
    var viewModel = {
    		showNewUrl: ko.observable(true) // Message initially visible
    };
    
   viewModel.showNewUrl(false); // ... now it's hidden
   // viewModel.showNewUrl(true); // ... now it's visible again
</script>     


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- <script src="<?=$relBootStrapPath?>js/bootstrap.min.js"></script> -->
  </body>
</html>