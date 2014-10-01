$(document).ready(function() {
  
  $('#buscar').click(function() {
    $('.fa-spin').removeClass('hidden');
    $.post('elemento', $('#fbuscar').serialize(), function(json) {
        if (json.success) {
            $('.table tbody tr td:first-child').text(json.id);
            $('.table tbody tr td:nth-child(2)').text(json.name);
            $('.table tbody tr td:nth-child(3)').text(json.paterno);
            $('.table tbody tr td:nth-child(4)').text(json.materno);
            $('.table tbody tr td:nth-child(5)').text(json.fecha);
            $('.table tbody tr td:nth-child(6)').text(json.matricula);
            
            $('.tabla').removeClass('hidden');
            $('.fa-spin').addClass('hidden');
            $('#error').addClass('hidden');
        } else {
           $('#error').removeClass('hidden');
           $('.fa-spin').addClass('hidden');
           $('.tabla').addClass('hidden');
        }
    });
  });

  jQuery.validator.setDefaults({
  debug: true,
  success: "valid"
	});
	$( "#fbuscar" ).validate({
	  rules: {
	    matricula: {
	      required: true,
	      number: true
	    }
	  }
	});
 
});
