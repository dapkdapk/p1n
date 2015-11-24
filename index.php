<?php
/**
 * dapkdapk
 */
if (version_compare ( PHP_VERSION, '5.2.6' ) < 0)
	die ( 'p1n requires php 5.2.6 or above to work. Sorry.' );
require_once "3rd/lib/serversalt.php";
require_once "3rd/lib/functions.zerobin.php";
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
<title>P1N</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<title>Bootstrap 101 Template</title>

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
					href="javascript:window.location=scriptLocation();">P1N your url!</a>
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
			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span> <span
				class="sr bold">Generated:</span> <a
				data-bind="attr: {href: urlString}" target="_blank"> <span
				data-bind="text: urlString" style="font-weight: bold;"></span>
			</a>
			<div align="right">
				<a data-bind="attr: {href: deleteUrl}" target="_top"> <span
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
			<h2 class="form-heading">Enter your url</h2>
			<label for="inputUrl" class="sr-only">http://</label> <input
				data-bind="textInput: rawUrlString" type="url" id="inputUrl"
				class="form-control" placeholder="http://" required autofocus>
			<button data-bind="click: generateUrl"
				class="btn btn-lg btn-primary btn-block" type="submit">Get short
				url!</button>
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