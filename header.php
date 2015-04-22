<!doctype html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
  <head>

    <meta http-equiv="X-UA-Compatible" content="IE=Edge" /> <?php/* Meta para modo de compatibilidade do IE. Precisa ser a primeira meta para que funcione corretamente */?> 
    <meta charset="UTF-8"> <?php/* Meta para codificação de caracteres */?> 
    <!--<meta name="viewport" content="width=device-width, initial-scale=1"> <?php/* Meta para dispositivos móveis */?>-->

    <title><?php 
      if (function_exists('is_tag') && is_tag()):
        single_tag_title('Tag para &quot;'); 
        echo '&quot; &mdash; ';
      elseif (is_archive()):
        wp_title(''); echo ' Post Arquivado &mdash; ';
      elseif (is_search()):
        echo 'Busca por &quot;'.wp_specialchars($s).'&quot; &mdash; ';
      // elseif( is_front_page() ):
      //   bloginfo( 'name' );
      elseif (!(is_404()) && (is_single()) || (is_page())):
        wp_title(''); 
        echo ' &mdash; ';
      elseif (is_404()): 
        echo 'Não Encontrado &mdash; ';
      endif;
      
      if (is_home()):
        bloginfo('name'); 
        echo ' &mdash; '; 
        bloginfo('description'); 
      else:
        bloginfo('name'); 
      endif;
      
      if ($paged > 1)
        echo ' &mdash; Página '. $paged; 
      ?></title>

<?php/* Metas para SEO ==--> */?>
    <meta http-equiv="cache-control" content="public">
    <meta name='author' content='Rodrigo Waltenberg, Estefani Coutinho, Lucas Ramos' />
    <meta name='revised' content='21/04/2015' />
    <meta name='keywords' content='kaminari japão pop k-pop j-rock anime manga desenho cosplay naruto evento goku' />
    <meta name='description' content='O Kaminari é um projeto que realiza eventos de cultura pop no estado de Rondônia.' />
    <meta name='revisit-after' content='30 days' />
    <meta name="copyright" content="<?php bloginfo( 'name' ); ?> - <?php echo Date('Y') ?> - Todos os direitos reservados">
    <meta name="application-name" content="Kaminari Rondônia">

    <?php wp_head(); ?>

  </head> 
<?php flush(); ?>
  <body>