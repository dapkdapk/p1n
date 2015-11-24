<?php

if (get_magic_quotes_gpc ()) {
	function stripslashes_deep($value) {
		$value = is_array ( $value ) ? array_map ( 'stripslashes_deep', $value ) : stripslashes ( $value );
		return $value;
	}
	$_POST = array_map ( 'stripslashes_deep', $_POST );
	$_GET = array_map ( 'stripslashes_deep', $_GET );
	$_COOKIE = array_map ( 'stripslashes_deep', $_COOKIE );
}

if (! empty ( $_POST ['data'] )) {
	header ( 'Content-type: application/json' );

	$error = false;

	// Create storage directory if it does not exist.
	if (! is_dir ( 'data' )) {
		mkdir ( 'data', 0705 );
		file_put_contents ( 'data/.htaccess', "Allow from none\nDeny from all\n", LOCK_EX );
	}

	// Make sure last paste from the IP address was more than 10 seconds ago.
	if (! trafic_limiter_canPass ( $_SERVER ['REMOTE_ADDR'] )) {
		echo json_encode ( array (
				'status' => 1,
				'message' => 'Please wait 10 seconds between each post.'
		) );
		exit ();
	}

	// Make sure content is not too big.
	$data = $_POST ['data'];
	if (strlen ( $data ) > 2000000) {
		echo json_encode ( array (
				'status' => 1,
				'message' => 'Url is limited to 2 Mb of encrypted data.'
		) );
		exit ();
	}

	// Make sure format is correct.
	if (! validSJCL ( $data )) {
		echo json_encode ( array (
				'status' => 1,
				'message' => 'Invalid data.'
		) );
		exit ();
	}

	// Read additional meta-information.
	$meta = array ();

	// Read expiration date
	if (! empty ( $_POST ['expire'] )) {
		$expire = $_POST ['expire'];
		if ($expire == '5min')
			$meta ['expire_date'] = time () + 5 * 60;
		elseif ($expire == '10min')
		$meta ['expire_date'] = time () + 10 * 60;
		elseif ($expire == '1hour')
		$meta ['expire_date'] = time () + 60 * 60;
		elseif ($expire == '1day')
		$meta ['expire_date'] = time () + 24 * 60 * 60;
		elseif ($expire == '1week')
		$meta ['expire_date'] = time () + 7 * 24 * 60 * 60;
		elseif ($expire == '1month')
		$meta ['expire_date'] = time () + 30 * 24 * 60 * 60; // Well this is not *exactly* one month, it's 30 days.
		elseif ($expire == '1year')
		$meta ['expire_date'] = time () + 365 * 24 * 60 * 60;
	}
	if ($error) {
		echo json_encode ( array (
				'status' => 1,
				'message' => 'Invalid data.'
		) );
		exit ();
	}

	// Add post date to meta.
	$meta ['postdate'] = time ();

	// We just want a small hash to avoid collisions: Half-MD5 (64 bits) will do the trick.
	$dataid = substr ( hash ( 'md5', $data ), 0, 16 );

	// $is_comment = (!empty($_POST['parentid']) && !empty($_POST['pasteid'])); // Is this post a comment ?
	$storage = array (
	'data' => $data
	);
	if (count ( $meta ) > 0)
		$storage ['meta'] = $meta; // Add meta-information only if necessary.

	$storagedir = dataid2path ( $dataid );
	if (! is_dir ( $storagedir ))
		mkdir ( $storagedir, $mode = 0705, $recursive = true );
	if (is_file ( $storagedir . $dataid )) // Oups... improbable collision.
	{
		echo json_encode ( array (
				'status' => 1,
				'message' => 'You are unlucky. Try again.'
		) );
		exit ();
	}
	// New paste
	file_put_contents ( $storagedir . $dataid, json_encode ( $storage ), LOCK_EX );

	// Generate the "delete" token.
	// The token is the hmac of the pasteid signed with the server salt.
	// The paste can be delete by calling http://myserver.com/zerobin/?pasteid=<pasteid>&deletetoken=<deletetoken>
	$deletetoken = hash_hmac ( 'sha1', $dataid, getServerSalt () );

	echo json_encode ( array (
			'status' => 0,
			'id' => $dataid,
			'deletetoken' => $deletetoken
	) ); // 0 = no error
	exit ();
	// }

	echo json_encode ( array (
			'status' => 1,
			'message' => 'Server error.'
	) );
	exit ();
}

$CIPHERDATA = '';
$ERRORMESSAGE = '';
$STATUS = '';

if (! empty ( $_GET ['deletetoken'] ) && ! empty ( $_GET ['pasteid'] )) // Delete an existing paste
{
	list ( $CIPHERDATA, $ERRORMESSAGE, $STATUS ) = processPasteDelete ( $_GET ['pasteid'], $_GET ['deletetoken'] );
} else if (! empty ( $_SERVER ['QUERY_STRING'] )) // Return an existing paste.
{
	list ( $CIPHERDATA, $ERRORMESSAGE, $STATUS ) = processPasteFetch ( $_SERVER ['QUERY_STRING'] );
}