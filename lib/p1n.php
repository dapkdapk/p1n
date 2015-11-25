<?php
/**
 * dapkdapk
 */
if (get_magic_quotes_gpc ()) {
	function stripslashes_deep($value) {
		$value = is_array ( $value ) ? array_map ( 'stripslashes_deep', $value ) : stripslashes ( $value );
		return $value;
	}
	$_POST = array_map ( 'stripslashes_deep', $_POST );
	$_GET = array_map ( 'stripslashes_deep', $_GET );
	$_COOKIE = array_map ( 'stripslashes_deep', $_COOKIE );
}

require_once 'lib/p1n.functions.php';
require_once 'lib/p1n.post.php';
require_once 'lib/p1n.get.php';

$CIPHERDATA = '';
$ERRORMESSAGE = '';
$STATUS = '';

if (! empty ( $_GET ['deletetoken'] ) && ! empty ( $_GET ['pasteid'] )) {
	list ( $CIPHERDATA, $ERRORMESSAGE, $STATUS ) = processPasteDelete ( $_GET ['pasteid'], $_GET ['deletetoken'] );
} else if (! empty ( $_SERVER ['QUERY_STRING'] )) {
	list ( $CIPHERDATA, $ERRORMESSAGE, $STATUS ) = processPasteFetch ( $_SERVER ['QUERY_STRING'] );
}