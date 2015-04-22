<?php

function set_html_content_type() { return 'text/html'; }

function envia_email() {

  $nome = FILTER_INPUT( INPUT_POST, 'nome', FILTER_SANITIZE_STRING );
  $email = FILTER_INPUT( INPUT_POST, 'email', FILTER_SANITIZE_STRING );
  $assunto = FILTER_INPUT( INPUT_POST, 'assunto', FILTER_SANITIZE_STRING );
  $mensagem = nl2br(FILTER_INPUT( INPUT_POST, 'mensagem', FILTER_SANITIZE_STRING ));
  $hora = date('d/m/Y H:i:s');

  $header = "From: Contato do website <{vilhena@fimca.com.br}>";
  $body = <<<MSG
  Uma mensagem foi enviada através do formulário de contato do website do Campus de Vilhena.
  Segue abaixo as informações:

  <table border="0">
    <tr>
      <td><b>Nome:</b></td>
      <td>{$nome}</td>
    </tr>
    <tr>
      <td><b>Email:</b></td>
      <td>{$email}</td>
    </tr>
    <tr>
      <td><b>Data/Hora:</b></td>
      <td>{$hora}</td>
    </tr>
    <tr>
      <td><b>Assunto:</b></td>
      <td>{$assunto}</td>
    </tr>
    <tr>
      <td colspan="2">
        <b>Mensagem:</b><br><br>
        {$mensagem}
      </td>
    </tr>
  </table>
MSG;

  add_filter( 'wp_mail_content_type', 'set_html_content_type' );

  $envio = wp_mail( get_option('admin_email'), "Contato através do website do Campus Vilhena", $body, $header );

  remove_filter( 'wp_mail_content_type', 'set_html_content_type' );

  $response = array();

  if($envio)
    $response = array('status' => 200, 'classe' => 'success', 'mensagem' => 'O e-mail foi enviado com sucesso! Responderemos ao seu contato o mais rápido possível.');
  else
    $response = array('status' => 500, 'classe' => 'error', 'mensagem' => 'Ocorreu um erro ao enviar o email. Tente novamente mais tarde...');

  echo json_encode( $response );
  die();
}

add_action( 'wp_ajax_envia_email', 'envia_email' );
add_action( 'wp_ajax_nopriv_envia_email', 'envia_email' );