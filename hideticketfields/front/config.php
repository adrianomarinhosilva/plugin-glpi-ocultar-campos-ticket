<?php
include ("../../../inc/includes.php");
$plugin = new Plugin();
if (!$plugin->isActivated("hideticketfields")) {
   Html::displayRightError();
}
Html::redirect($CFG_GLPI["root_doc"]."/front/config.form.php");