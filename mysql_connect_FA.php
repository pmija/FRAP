<?php

	$dbc=mysqli_connect('localhost', 'root', '', 'facultyassocnew');

	if (!$dbc) {

		die('Could not connect: '.mysql_error());

	}

?>