<?php
include ("../../../inc/includes.php");

// Check rights
Session::checkRight("config", UPDATE);

// Get current config
global $DB;

if (isset($_POST["update"])) {
    $query = "UPDATE glpi_plugin_hideticketfields_configs SET 
              hide_urgency = " . $_POST['hide_urgency'] . ",
              hide_impact = " . $_POST['hide_impact'] . ",
              hide_priority = " . $_POST['hide_priority'] . ",
              hide_source = " . $_POST['hide_source'] . ",
              hide_status = " . $_POST['hide_status'] . "
              WHERE id = 1";
    
    if ($DB->query($query)) {
        Session::addMessageAfterRedirect('Configurações salvas com sucesso!', true);
    }
    
    Html::redirect($_SERVER['PHP_SELF']);
}

Html::header('Ocultar Campos do Chamado', $_SERVER['PHP_SELF'], "config", "plugins");

// Get current settings
$query = "SELECT * FROM glpi_plugin_hideticketfields_configs WHERE id = 1";
$result = $DB->query($query);
$current_config = $DB->fetchAssoc($result);

echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
echo "<div class='center'>";
echo "<table class='tab_cadre_fixe'>";

echo "<tr><th colspan='2'>Configuração dos Campos do Chamado</th></tr>";

// Urgency field
echo "<tr class='tab_bg_1'>";
echo "<td>Ocultar campo Urgência</td>";
echo "<td>";
Dropdown::showYesNo("hide_urgency", $current_config['hide_urgency']);
echo "</td></tr>";

// Impact field
echo "<tr class='tab_bg_1'>";
echo "<td>Ocultar campo Impacto</td>";
echo "<td>";
Dropdown::showYesNo("hide_impact", $current_config['hide_impact']);
echo "</td></tr>";

// Priority field
echo "<tr class='tab_bg_1'>";
echo "<td>Ocultar campo Prioridade</td>";
echo "<td>";
Dropdown::showYesNo("hide_priority", $current_config['hide_priority']);
echo "</td></tr>";

// Source field
echo "<tr class='tab_bg_1'>";
echo "<td>Ocultar campo Origem da Requisição</td>";
echo "<td>";
Dropdown::showYesNo("hide_source", $current_config['hide_source']);
echo "</td></tr>";

// Status field
echo "<tr class='tab_bg_1'>";
echo "<td>Ocultar campo Status</td>";
echo "<td>";
Dropdown::showYesNo("hide_status", $current_config['hide_status']);
echo "</td></tr>";

// Save button
echo "<tr class='tab_bg_2'>";
echo "<td colspan='2' class='center'>";
echo "<input type='submit' name='update' value='Salvar' class='submit'>";
echo "</td></tr>";

echo "</table></div>";
Html::closeForm();

Html::footer();