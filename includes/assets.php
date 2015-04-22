<?php

  // This file will be responsible by insertion of the assets in the pages of the theme.

  /**
   * Inserts the styles and the scripts in the theme
   *
   * @return [void]
   *
   * @author Lucas Bernieri Ramos <[lucasramos53@gmail.com]>
   */
  function template_default() {

    /**
     * Array que irá conter os paramâmetros suportados pela função wp_register_style
     * Para saber mais sobre a função [http://codex.wordpress.org/Function_Reference/wp_register_style]
     *
    */
    $styles = array(
      array(
        'name' => 'the-style-min',
        'file' => DS . 'the-style.min.css',
        'deps' => array(),
        'media' => 'all',
        'enqueue' => true,
        'version' => '20150415'
      ),
      array(
        'name' => 'toastr',
        'file' => 'http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
        'deps' => array(),
        'media' => 'all',
        'enqueue' => true,
        'version' => '20150415',
        'external' => true
      )
    );

    /**
     * Percorre o objeto criado com todos os styles a serem inserido no tema
    */
    foreach( $styles as $style ) {
      $deps = null;

      if (array_key_exists('deps', $style))
      $deps = $style['deps'];

      /**
       * Registra todos os styles inseridos como parâmetros
      */
      if (!array_key_exists('external', $style))
        wp_register_style( $style['name'], CSS_URI . $style['file'], $deps, $style['version'], $style['media']);
      else
        wp_register_style( $style['name'], $style['file'], $deps, $style['version'], $style['media']);

      /**
       * Bota na fila para o carregamento todos os styles registrados
      */
      if( $style['enqueue'] )
        wp_enqueue_style( $style['name'] );
    }

    /* Array que irá conter os paramâmetros suportados pela função wp_register_style
     * Para saber mais sobre a função [http://codex.wordpress.org/Function_Reference/wp_register_script]
     *
    */
    $scripts = array(
      array(
        'name' => 'jquery_atual',
        'file' => 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js',
        'deps' => array(),
        'enqueue' => true,
        'in_footer' => true,
        'external' => true
      ),
      array(
        'name' => 'jquery_validate',
        'file' => 'http://cdn.jsdelivr.net/jquery.validation/1.13.1/jquery.validate.min.js',
        'deps' => array(),
        'enqueue' => true,
        'in_footer' => true,
        'external' => true
      ),
      array(
        'name' => 'toastr',
        'file' => 'http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',
        'deps' => array(),
        'enqueue' => true,
        'in_footer' => true,
        'external' => true
      ),
      array(
        'name' => 'bootstrap',
        'file' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js',
        'deps' => array(),
        'enqueue' => true,
        'in_footer' => true,
        'external' => true
      ),
      array(
        'name' => 'jwplayer',
        'file' => DS . 'jwplayer.js',
        'deps' => array(),
        'enqueue' => true,
        'in_footer' => false,
        'version' => '20150415'
      ),
      array(
        'name' => 'the-action-min',
        'file' => DS . 'the-action.min.js',
        'deps' => array(),
        'enqueue' => true,
        'in_footer' => true,
        'version' => '20150415'
      )
    );

    /**
     * Percorre o objeto criado
    */
    foreach( $scripts as $script ) {
      $deps = null;

      if( array_key_exists($deps, $script) )
        $deps = $script['deps'];

      if (!array_key_exists('external', $script))
        wp_register_script( $script['name'], JS_URI . $script['file'], $deps, $script['version'], $script['in_footer'] );
      else
        wp_register_script( $script['name'], $script['file'], $deps, $script['version'], $script['in_footer'] );

      /**
       * Coloca os arquivos na fila para serem carregados
      */
      if ($script['enqueue'])
        wp_enqueue_script( $script['name'] );
    }

    wp_localize_script( 'the-action-min', 'THE_AJAX_URL', admin_url( 'admin-ajax.php' ) );
  }
  add_action( 'wp_enqueue_scripts', 'template_default' );