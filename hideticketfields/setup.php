<?php
define('HIDETICKETFIELDS_VERSION', '1.0.0');

function plugin_init_hideticketfields() {
   global $PLUGIN_HOOKS;
   
   $PLUGIN_HOOKS['csrf_compliant']['hideticketfields'] = true;
   
   // Adiciona CSS apenas nas páginas de ticket
   if (strpos($_SERVER['REQUEST_URI'], 'ticket.form.php') !== false 
       || strpos($_SERVER['REQUEST_URI'], 'newticket.form.php') !== false) {
      $PLUGIN_HOOKS['add_css']['hideticketfields'] = 'css/hideticketfields.css';
   }
}

function plugin_version_hideticketfields() {
   return [
      'name'           => 'Hide Ticket Fields',
      'version'        => HIDETICKETFIELDS_VERSION,
      'author'         => 'Adriano Marinho',
      'license'        => 'GPLv2+',
      'homepage'       => 'https://github.com/malakaygames',
      'requirements'   => [
         'glpi' => [
            'min' => '10.0',
            'max' => '10.1',
            'dev' => false
         ]
      ]
   ];
}

function plugin_hideticketfields_check_prerequisites() {
   return true;
}

function plugin_hideticketfields_check_config() {
   return true;
}