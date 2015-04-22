<?php

  update_option('siteurl','http://www.projetokaminari.com.br');
  update_option('home','http://www.projetokaminari.com.br');

  // Making the inclusion of the theme files
  $files = array(
    'ajax',
    'assets',
    'breadcrumbs',
    'custom-post-types',
    'custom-taxonomy',
    'menus',
    'theme-config',
    'theme-config-admin',
    'thumbnails'
  );
  foreach ( $files as $file ) :
    require_once 'includes/' . $file . '.php';
  endforeach;