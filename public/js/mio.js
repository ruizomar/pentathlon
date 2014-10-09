$(document).ready(function() {
   $('#buscarelemento').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
        }
    })
    .on('success.form.bv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');

            $('.spin-form').removeClass('hidden');
            $.post($form.attr('action'), $form.serialize(), function(json) {
                if (json.success) {
                    $('.table tbody tr td:first-child').text(json.id);
                    $('.table tbody tr td:nth-child(2)').text(json.name);
                    $('.table tbody tr td:nth-child(3)').text(json.paterno);
                    $('.table tbody tr td:nth-child(4)').text(json.materno);
                    $('.table tbody tr td:nth-child(5)').text(json.fecha);
                    $('.table tbody tr td:nth-child(6)').text(json.matricula);
                    $('.table tbody tr td:nth-child(7)').text(json.estatura);
                    $('.table tbody tr td:nth-child(8)').text(json.peso);
                    $('.table tbody tr td:nth-child(9)').text(json.ocupacion);
                    $('.table tbody tr td:nth-child(10)').text(json.estadocivil);
                    $('.table tbody tr td:nth-child(11)').text(json.fechanacimiento);
                    $('.table tbody tr td:nth-child(12)').text(json.escolaridad);
                    $('.table tbody tr td:nth-child(13)').text(json.escuela);
                    $('.table tbody tr td:nth-child(14)').text(json.fechaingreso);
                    $('.table tbody tr td:nth-child(15)').text(json.lugarnacimiento);
                    $('.table tbody tr td:nth-child(16)').text(json.curp);
                    $('.table tbody tr td:nth-child(17)').text(json.calle);
                    $('.table tbody tr td:nth-child(18)').text(json.colonia);
                    $('.table tbody tr td:nth-child(19)').text(json.cp);
                    $('.table tbody tr td:nth-child(20)').text(json.municipio);
                    $('.table tbody tr td:nth-child(21)').text(json.estado);
                    $('.table tbody tr td:nth-child(22)').text(json.reclutamiento);
                    $('.table tbody tr td:nth-child(23)').text(json.email);
                    $('.table tbody tr td:nth-child(24)').text(json.alergias);
                    $('.table tbody tr td:nth-child(25)').text(json.adiccion);
                    $('.table tbody tr td:nth-child(26)').text(json.tipoarma_id);
                    $('.table tbody tr td:nth-child(27)').text(json.tipocuerpo_id);
                    $('.table tbody tr td:nth-child(28)').text(json.companiasysubzona_id);


                    $('#elemento').removeClass('hidden');
                    $('#error').addClass('hidden');
                }
                else if(json.success == false){
                   $('#error').removeClass('hidden');
                   $('#elemento').addClass('hidden');
                }
                else{
                    $( "#elementos tbody" ).html('');
                    for (var i = json.length - 1; i >= 0; i--) {
                        var matricula='';
                        if(json[i].matricula!=null)
                                matricula=json[i].matricula.matricula;
                        $( "<tr>" ).append(
                            "<td>"+json[i].id+'</td>'+
                            "<td>"+json[i].nombre+'</td>'+
                            "<td>"+json[i].paterno+'</td>'+
                            "<td>"+json[i].materno+'</td>'+
                            "<td>"+json[i].fecha+'</td>'+
                            "<td>"+matricula+'</td>'+
                            '<td><button type="button" onclick="llenartabla(this)" class="btn btn-info select btn-sm">seleccionar</button></td>').appendTo( "#elementos tbody" );
                    };
                    $('#Elementos').modal('show')
                    $('#error').addClass('hidden');
                }
                $('.fa-spin').addClass('hidden');
    }, 'json');
    });
   $('#pagar').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok cantidad',
            invalid: 'glyphicon glyphicon-remove cantidad',
            validating: 'glyphicon glyphicon-refresh cantidad'
        },
        fields: {
            cantidad: {
                validators: {
                    notEmpty: {
                    },
                    regexp: {
                        regexp:/^[0-9]*\.?[0-9]+$/,
                        message: 'Por favor introduce una cantidad'
                    }
                }
            }
        }
    })
    .on('success.form.bv', function(e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $('#myModal').modal('show')
            $('.spin-modal').removeClass('hidden');
            $('[name=id]').val($('#elemento tbody tr td:first-child').text());
            $('#recibo').attr('href','recibo/'+$('#telemento tbody tr td:first-child').text());
            $('.alert').addClass('hidden');
            $.post($form.attr('action'), $form.serialize(), function(json) {
                if (json.success) {
                    $('#message').html(json.message+json.matricula);
                    $('.alert').removeClass('hidden alert-danger');
                    $('.alert').addClass('alert-success');
                } else {
                    $('#message').html(json.errormessage);
                    $('.alert').removeClass('hidden alert-success');
                    $('.alert').addClass('alert-danger');
                }
                $('.spin-modal').addClass('hidden');
                $('#pagar').data('bootstrapValidator').resetField('cantidad', true)

    }, 'json');
    });


});
    function llenartabla(a) {
        $('#Elementos').modal('hide');
        var $row = $(a).closest("tr");
        for (var i = 1; i < 7; i++) {
            $('#telemento tbody tr td:nth-child('+i+')').text($row.find("td:nth-child("+i+")").text());
        };
        $('#elemento').removeClass('hidden');
    }