<?php

if (! empty ( $_GET ['s'] ) && strlen ( $_GET ['s'] ) == 4) {
	$urlc = $_GET ['s'];
	$code = array (
			substr ( $urlc, 0, 2 ),
			substr ( $urlc, 2, 2 )
	);
	$codeenc = aksencode ( serialize ( $code ) );
	$file = 'data/' . $code [0] . '/' . $code [1] . '/' . urlencode ( $codeenc );

	if (file_exists ( $file )) {
		header ( "location: " . decrypt ( file_get_contents ( $file ) ) );
		exit ();
	}
}