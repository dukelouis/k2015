<?php get_header(); ?>

<header id="the_header">
  <div class="container logo">
    <div class="row">
      <div class="col-xs-12">
        <h1><a href="">Kaminari Rondônia</a></h1>
        <nav class="menu">
          <ul>

          </ul>
        </nav>
      </div>
    </div>
  </div>
  <div class="banner">
    <div class="dados">
      <div class="wrapper visible-xs-block visible-sm-block clearfix">
        <header>
          <h1>Kaminari <em>2015</em></h1>
          <h2>Datas</h2>
        </header>
        <time datetime="2015-07-04">
          <em>04</em>
          Jul
        </time>
        <time datetime="2015-07-04">
          <em>05</em>
          Jul
        </time>
      </div>
      <footer class="visible-xs-block visible-sm-block">
        <div class="wrapper">
          <time>Das <em>11h</em> às <em>19h</em></time>
          <h2 class="hidden-md">Horário</h2>
        </div>
      </footer>
    </div>
  </div>
</div>
</header>
<div id="sessoes">
  <?php
  $posts = get_posts(array(
    'post_type' => 'sessao'
    ));

  foreach ( $posts as $post ) : setup_postdata( $post ); 
  ?>
  <article id="<?php echo $post->post_name; ?>">
    <h1><?php the_title(); ?></h1>
    <?php the_content(); ?>
  </article>
  <?php 
  endforeach; 
  wp_reset_postdata();
  ?>
</div>
<div id="patrocinios"></div>
<div id="programacao"></div>
<?php
$posts = get_posts(array(
  'post_type' => 'convidado'
  ));
if(count($posts)):
  ?>
<div id="convidados" class="clearfix">
  <h1>Convidados</h1>
  <?php
  foreach ( $posts as $post ) : setup_postdata( $post ); 
  $meta = get_post_meta(get_the_ID());
  ?>
  <div class="convidado col-xs-12 col-sm-6">
    <img src="<?php echo $meta['wpcf-url-imagem'][0]; ?>">
    <h1><?php the_title(); ?></h1>
    <p>
      <?php echo $meta['wpcf-resumo'][0]; ?> 
    </p>
  </div>
  <?php 
  endforeach; 
  wp_reset_postdata();
  ?>
</div>
<?php
endif;
?>
<div id="ingressos">
  <div class="container">
    <div class="row">
      <h1>Ingressos</h1>
      <p class="col-xs-12 col-sm-6">
        Curtiu a programação? Gostou ainda mais das atrações que estarão na edição deste ano? <br>
        Então compre seu ingresso agora!
      </p>
      <div class="col-xs-12 col-sm-6">
        <a href="" target="_blank" class="comprar">
          <span>
            <i class="fa fa-ticket"></i>
            <em>R$34,00</em>
            Meia R$17,00
          </span>
          <span>Comprar</span>
        </a>
      </div>
    </div>
  </div>
</div>
<div id="contato">
  <h1>Contato</h1>
  <div class="container">
    <div class="row">
      <div class="info col-xs-12 col-sm-4">
        <h2>Telefone</h2>
        <address class="phone">(69) 9258.5495</address>
      </div>
      <div class="info col-xs-12 col-sm-4">
        <h2>Email</h2>
        <address class="email">pro.kaminari@gmail.com</address>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>