<?php
/**
 * dapkdapk
 */
if (version_compare ( PHP_VERSION, '5.2.6' ) < 0)
	die ( 'p1n requires php 5.2.6 or above to work. Sorry.' );
require_once "3rd/lib/serversalt.php";
require_once "3rd/lib/functions.zerobin.php";
require_once "cfg/config.inc.php";
require_once "lib/p1n.php";

$relBootStrapPath = "vendor/twbs/bootstrap/dist/";
$relJQueryPath = "vendor/components/jquery/";
$relKnockoutPath = "vendor/itguy614/knockout/js/";
$relP1NPath = "lib/";
$rel3rdPath = "3rd/";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>P1N URL</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

<!-- JQuery -->
<script src="<?=$relJQueryPath?>jquery.min.js"></script>
<!-- Bootstrap -->
<link href="<?=$relBootStrapPath?>css/bootstrap.min.css"
	rel="stylesheet">
<!-- Knockout -->
<script src="<?=$relKnockoutPath?>knockout.js"></script>
<!-- 3rd -->
<script src="<?=$rel3rdPath?>js/sjcl.js"></script>
<script src="<?=$rel3rdPath?>js/functions.zerobin.js"></script>
<script src="<?=$rel3rdPath?>js/base64.js"></script>
<script src="<?=$rel3rdPath?>js/rawdeflate.js"></script>
<script src="<?=$rel3rdPath?>js/rawinflate.js"></script>

<!-- css -->
<link type="text/css" rel="stylesheet" href="<?=$relP1NPath?>p1n.css" />

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
				<button type="button" class="navbar-toggle collapsed"
					data-toggle="collapse" data-target="#navbar" aria-expanded="false"
					aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span> <span
						class="icon-bar"></span> <span class="icon-bar"></span> <span
						class="icon-bar"></span>
				</button>
				<a class="navbar-brand"
					href="javascript:window.location=scriptLocation();">P1N URL</a>
			</div>

		</div>
	</nav>

	<div class="container" role="main">

		<div id="topalign">
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		</div>

		<div data-bind="visible: showNewUrl" class="alert alert-success"
			role="alert">
			<!-- <span class="glyphicon glyphicon-ok" aria-hidden="true"></span> -->
			<span class="sr bold">Encrypted:</span> <a
				data-bind="attr: {href: urlString}" target="_blank"> <span
				data-bind="text: urlString" style="font-weight: bold;"></span>
			</a> &nbsp;

			<button data-bind="visible: shortUrlButton, click: getShortUrl"
				type="button" class="btn btn-default btn-xs">
				<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
				GET SHORTURL
			</button>

			<span data-bind="visible: shortUrlSpan"><br />
			<br /> <span class="sr bold">Shorturl:</span> <a
				data-bind="attr: {href: shortUrlString}" target="_blank"> <span
					data-bind="text: shortUrlString" style="font-weight: bold;"></span>
			</a> </span>

			<div align="right">
				<a data-bind="attr: {href: deleteUrl}" target="_self"> <span
					class="glyphicon glyphicon-trash"></span>
				</a>
			</div>
		</div>

		<div data-bind="visible: errorBox" class="alert alert-danger"
			role="alert">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
			<span class="sr-only">Error:</span> <span data-bind="text: errorText"></span>
		</div>

		<div data-bind="visible: statusBox" class="alert alert-info"
			role="alert">
			<span data-bind="visible: infoTextSpin"
				class="glyphicon glyphicon-refresh glyphicon-spin"
				aria-hidden="true"></span> <span data-bind="text: infoText"></span>
		</div>

		<form class="form" data-bind="visible: showForm">
			<h4 class="form-heading">Enter your url</h4>
			<label for="inputUrl" class="sr-only">http://</label> <input
				data-bind="textInput: rawUrlString, value: enterText, valueUpdate: 'afterkeydown', 
    event: { keypress: enterKeyboardCmd}"
				type="url" id="inputUrl" class="form-control" placeholder="http://"
				required autofocus>

<div class="item row">
  <div class="col-xs-2">
    <label>
      <input type="checkbox" > Burn after clicking
    </label>
  </div>
  <div class="col-xs-3">
  			<label for="expiresSelect"> Expires
<select id="expiresSelect" class="form-control">
       <option value="5min">5 minutes</option>
        <option value="10min">10 minutes</option>
        <option value="1hour">1 hour</option>
        <option value="1day">1 day</option>
        <option value="1week">1 week</option>
        <option value="1month" selected="selected">1 month</option>
        <option value="1year">1 year</option>
        <option value="never">Never</option>

</select>
</label>   
  </div>
</div>				
  
				
			<button data-bind="click: generateUrl"
				class="btn btn-lg btn-primary btn-block" type="submit">GET</button>
		</form>
	</div>

	<div id="cipherdata" style="display: none;"><?=$CIPHERDATA?></div>
	<div id="errormessage" style="display: none;"><?=$ERRORMESSAGE?></div>
	<div id="statusmessage" style="display: none;"><?=$STATUS?></div>

	<!-- p1n -->
	<script src="<?=$relP1NPath?>p1n.js"></script>
	<script src="<?=$relBootStrapPath?>js/bootstrap.min.js"></script>
</body>
</html>