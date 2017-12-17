<?php
session_start();
$_SESSION['idnum'] = 11443081;


	$dbc=mysqli_connect('localhost', 'root', '1234', 'facultyassocnew');

	if (!$dbc) {

		die('Could not connect: '.mysql_error());

	}

?>