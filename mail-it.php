<?php

/* Code by David McKeown - craftedbydavid.com */
/* Editable entries are bellow */

$send_to = "amin.wejebe@anahuac.mx";
$send_subject = "Mensaje de la página del BET ";



/*Be careful when editing below this line */

$f_name = cleanupentries($_POST["nombre"]);
$f_email = cleanupentries($_POST["email"]);
$f_message = cleanupentries($_POST["mensaje"]);
$from_ip = $_SERVER['REMOTE_ADDR'];
$from_browser = $_SERVER['HTTP_USER_AGENT'];

function cleanupentries($entry) {
	$entry = trim($entry);
	$entry = stripslashes($entry);
	$entry = htmlspecialchars($entry);

	return $entry;
}

$message = "Este mensaje fue enviado el" . date('m-d-Y') . 
"\n\nNombre: " . $f_name . 
"\n\nE-Mail: " . $f_email . 
"\n\nMenesaje: \n" . $f_message . 
"\n\n\nTechnical Details:\n" . $from_ip . "\n" . $from_browser;

$send_subject .= " - {$f_name}";

$headers = "From: " . $f_email . "\r\n" .
    "Reply-To: " . $f_email . "\r\n" .
    "X-Mailer: PHP/" . phpversion();

if (!$f_email) {
	echo "no email";
	exit;
}else if (!$f_name){
	echo "no name";
	exit;
}else{
	if (filter_var($f_email, FILTER_VALIDATE_EMAIL)) {
		mail($send_to, $send_subject, $message, $headers);
		echo "true";
	}else{
		echo "invalid email";
		exit;
	}
}

?>