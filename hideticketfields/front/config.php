<?php
include ("../../../inc/includes.php");

// Check if user has rights
Session::checkRight("config", UPDATE);

// Display header
Html::header('Hide Ticket Fields', $_SERVER['PHP_SELF'], "config", "plugins");

$config = new PluginHideticketfieldsConfig();

if (isset($_POST["update"])) {
   $config->update($_POST);
   Html::back();
}

$config->display(['id' => 1]);

Html::footer();