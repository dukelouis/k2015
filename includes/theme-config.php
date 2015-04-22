<?php

  // This file will contain the general setups of the theme as the setups of the themes supports.

  /** Definindo as variáveis constantes que serão utilizadas no tema */

  /** Pegando o caminho relativo do tema */
  if ( !defined('THEME_URI') )
    define('THEME_URI', get_template_directory_uri());

  /** Pegando o caminho relativo do tema */
  if ( !defined('THEME_DIR') )
    define('THEME_DIR', get_template_directory());

  /** Variáveis constantes com o caminho e url relativos dos assets do tema */
  define( 'ASSETS_URI', THEME_URI . DS . 'assets' );
  define( 'ASSETS_DIR', THEME_DIR . DS . 'assets' );

  /** Variáveis contantes com o caminho e url relativa dos css do tema */
  define( 'CSS_URI', ASSETS_URI . DS . 'css' );
  define( 'CSS_DIR', ASSETS_DIR . DS . 'css' );

  /** Variáveis contantes com o caminho e url relativa dos js do tema */
  define( 'JS_URI', ASSETS_URI . DS . 'js' );
  define( 'JS_DIR', ASSETS_DIR . DS . 'js' );

  /** Variáveis contantes com o caminho e url relativa dos js do tema */
  define( 'IMG_URI', ASSETS_URI . DS . 'images' );
  define( 'IMG_DIR', ASSETS_DIR . DS . 'images' );

  /** Corrige o timezone */
  setlocale( LC_ALL, "pt_BR" );
  date_default_timezone_set( 'America/Manaus' );

  /** Adiciona favicon ao tema */
  // function theme_favicon() {
  //   echo "<link rel='Shortcut Icon' type='image/x-icon' href='" . IMG_URI . DS . "favicon.png'>";
  // }
  // add_action('wp_head', 'theme_favicon');

  /** Adiciona favicon ao gerenciador */
  // function theme_favicon_admin() {
  //   echo "<link rel='Shortcut Icon' type='image/x-icon' href='" . IMG_URI . DS . "favicon.png'>";
  // }
  // add_action('admin_head', 'theme_favicon_admin');

  /** Desabilita a edição de arquivos pela IDE do Wordpress */
  define('DISALLOW_FILE_EDIT', true);

  /** Este tema tem suporte para background customizado. */
  add_theme_support( 'custom-background' );

  /** Este tema tem suporte para formatos de posts. */
  add_theme_support( 'post-formats', array() );

  /** Este tema tem suporte para header customizado */
  add_theme_support( 'custom-header' );

  /** Este tema tem suporte para imagem destacada */
  add_theme_support( 'post-thumbnails' );

  /** Adiciona suporte para menus no tema */
  add_theme_support( 'menus' );

  /** Limpa o <head> de coisas desnecessárias padrões do wordpress */
  function removeLinks() {
    remove_action('wp_head', 'rsd_link');
    remove_action( 'wp_head', 'wlwmanifest_link' );
    remove_action('wp_head', 'wp_generator');
  }
  add_action('init', 'removeLinks');

  /** Define a qualidade para as imagens jpeg para 80% */
  function wp_jpeg_quality() {
    return 80;
  }
  add_filter( 'jpeg_quality', 'wp_jpeg_quality' );


  /** Altera a logo da tela de login do wordpress */
  function theme_admin_logo_url() {
    return home_url();
  }
  add_filter( 'login_headerurl', 'theme_admin_logo_url' );

  //Custom WordPress Login Logo by WpTotal.com.br
  // function my_custom_login_logo() {
  //   echo '
  //   <style type="text/css">
  //     .login h1 a {
  //       background-image:url('. IMG_URI . DS . 'logo.png) !important;
  //       background-size: 200px 192px;
  //       height: 192px;
  //       display: block;
  //       width: 200px;
  //       margin-left: 50px!important;
  //     }
  //   </style>';
  // }
  // add_action('login_head', 'my_custom_login_logo');