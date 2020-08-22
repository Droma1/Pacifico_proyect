<?php
	require_once "./Config/configGeneral.php";
	require_once "./Controller/viewController.php";

	$plantilla = new viewController();
	$plantilla->index();
?>