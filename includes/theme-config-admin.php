<?php

  // This file will contain the setups of the admin panel

  /** Customizar o rodapé do WordPress */
  function remove_footer_admin () {
    echo 'Website criado e desenvolvido por <a href="#" target="_blank">Nome da Empresa</a>.';
  }
  add_filter('admin_footer_text', 'remove_footer_admin');

  /** Remover a versao do wordpress do rodapé */
  function remove_footer_version() {
   return '';
  }
  add_filter( 'update_footer', 'remove_footer_version', 9999 );

  /** Remove o icone do wordpress do dashboard */
  function remove_itens_dashboard() {
      global $wp_admin_bar;
      $wp_admin_bar->remove_menu('wp-logo');
  }
  add_action( 'wp_before_admin_bar_render', 'remove_itens_dashboard' );

  // Saudação customizada no painel de administração
  function replace_howdy( $wp_admin_bar ) {
      $my_account=$wp_admin_bar->get_node('my-account');
      $newtitle = str_replace( 'Olá', 'Bem vindo', $my_account->title );
      $wp_admin_bar->add_node( array(
          'id' => 'my-account',
          'title' => $newtitle,
      ) );
  }
  add_filter( 'admin_bar_menu', 'replace_howdy',25 );

  // Remove o item post do menu do wordpress
  function remove_links_menu() {
    remove_menu_page('edit.php'); // Posts
  }
  add_action( 'admin_menu', 'remove_links_menu' );