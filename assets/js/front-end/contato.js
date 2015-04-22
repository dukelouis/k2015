jQuery(document).ready(function($){
  window.ajax_form_sending = false;
  $('#fale-conosco form').submit(function(e){
    e.preventDefault();

    if(window.ajax_form_sending)
      return false;

    var form_data = $(this), response;

    if ( form_data.valid() ) {

      var dados = form_data.serialize();
      dados = 'action=envia_email&' + dados;

      $.ajax({
        url: THE_AJAX_URL,
        type: 'POST',
        data: dados,
        beforeSend: function() {
          window.ajax_form_sending = true;
          $('button', form_data).html('Enviando...').attr('disabled', true);
        }
      })
      .done(function(data) {
        window.ajax_form_sending = false;
        response = $.parseJSON(data);
        $('button', form_data).html('Enviar Mensagem &raquo;').attr('disabled', false);
        form_data.get(0).reset();

        if(response.status == 200)
          toastr.success(response.mensagem);
        else
          toastr.error(response.mensagem);

      })
      .fail(function(data) {
        window.ajax_form_sending = false;
        response = $.parseJSON(data);
        $('.btn-enviar-amigo').html('Enviar Mensagem &raquo;').attr('disabled', false);
        toastr.error("Ocorreu um erro ao enviar o formulário. Tente novamente mais tarde...");
      });
    }
    else {
      return false;
    }

  });

});