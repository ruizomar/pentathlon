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
                    $('[name=persona_id]').val(json.persona_id);
                    $('[name=reclunombre]').val(json.name);
                    $('[name=reclupaterno]').val(json.paterno);
                    $('[name=reclumaterno]').val(json.materno);
                    $('[name=fotoperfil]').attr('src','../imgs/fotos/'+json.fotoperfil);
                    $('[name=reclusexo] option[value='+json.sexo+']').attr('selected', true);
                    $('[name=birthday]').val(json.fechanacimiento);
                    $('[name=domicilio]').val(json.calle);
                    $('[name=colonia]').val(json.colonia);
                    $('[name=municipio]').val(json.municipio);
                    $('[name=estado] option[value='+json.estado+']').attr('selected', true);
                    $('[name=postal]').val(json.cp);
                    $('[name=lugnac]').val(json.lugarnacimiento);
                    $('[name=curp]').val(json.curp);
                    $('[name=email]').val(json.email);
                    $('[name=reclutelefonofijo]').val(json.reclutelefonofijo);
                    $('[name=reclutelefonomovil]').val(json.reclutelefonomovil);
                    $('[name=reclufacebook]').val(json.facebook);
                    $('[name=reclutwitter]').val(json.twitter);
                    $('[name=estatura]').val(json.estatura);
                    $('[name=peso]').val(json.peso);
                    $('[name=tiposangre] option[value='+json.tiposangre+']').attr('selected', true);
                    $('[name=ocupacion]').val(json.ocupacion);
                    $('[name=estadocivil]').val(json.estadocivil);
                    $('[name=escolaridad]').val(json.escolaridad);
                    $('[name=escuela]').val(json.escuela);
                    $('[name=alergia]').val(json.alergias);
                    $('[name=vicios]').val(json.adiccion);
                    $('[name=arma]').val(json.arma);
                    $('[name=cuerpo]').val(json.cuerpo);
                    $('[name=compania]').val(json.compania);
                    $('[name=contactonombre]').val(json.contactonombre);
                    $('[name=contactopaterno]').val(json.contactopaterno);
                    $('[name=contactomaterno]').val(json.contactomaterno);
                    $('[name=contactosexo]').val(json.contactosexo);
                    $('[name=contactorelacion]').val(json.contactorelacion);
                    $('[name=contactotelefonofijo]').val(json.contactotelefonofijo);
                    $('[name=contactotelefonomovil]').val(json.contactotelefonomovil);
                    $('[name=contactoemail]').val(json.contactoemail);
                    $('[name=contactofacebook]').val(json.contactofacebook);
                    $('[name=contactotwitter]').val(json.contactotwitter);
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
                        $( "<tr>" ).append(
                            "<td>"+json[i].matricula+'</td>'+
                            "<td class='hidden'>"+json[i].persona_id+"</td>"+
                            "<td>"+json[i].name+"</td>"+
                            "<td>"+json[i].paterno+"</td>"+
                            "<td>"+json[i].materno+"</td>"+
                            "<td class='hidden'>"+json[i].fotoperfil+"</td>"+
                            "<td class='hidden'>"+json[i].sexo+"</td>"+
                            "<td>"+json[i].fechanacimiento+"</td>"+
                            "<td class='hidden'>"+json[i].calle+"</td>"+
                            "<td class='hidden'>"+json[i].colonia+"</td>"+
                            "<td class='hidden'>"+json[i].municipio+"</td>"+
                            "<td class='hidden'>"+json[i].estado+"</td>"+
                            "<td class='hidden'>"+json[i].cp+"</td>"+
                            "<td class='hidden'>"+json[i].lugarnacimiento+"</td>"+
                            "<td class='hidden'>"+json[i].curp+"</td>"+
                            "<td class='hidden'>"+json[i].email+"</td>"+
                            "<td class='hidden'>"+json[i].reclutelefonofijo+"</td>"+
                            "<td class='hidden'>"+json[i].reclutelefonomovil+"</td>"+
                            "<td class='hidden'>"+json[i].facebook+"</td>"+
                            "<td class='hidden'>"+json[i].twitter+"</td>"+
                            "<td class='hidden'>"+json[i].estatura+"</td>"+
                            "<td class='hidden'>"+json[i].peso+"</td>"+
                            "<td class='hidden'>"+json[i].tiposangre+"</td>"+
                            "<td class='hidden'>"+json[i].ocupacion+"</td>"+
                            "<td class='hidden'>"+json[i].estadocivil+"</td>"+
                            "<td class='hidden'>"+json[i].escolaridad+"</td>"+
                            "<td class='hidden'>"+json[i].escuela+"</td>"+
                            "<td class='hidden'>"+json[i].alergias+"</td>"+
                            "<td class='hidden'>"+json[i].adiccion+"</td>"+
                            "<td class='hidden'>"+json[i].arma+"</td>"+
                            "<td class='hidden'>"+json[i].cuerpo+"</td>"+
                            "<td class='hidden'>"+json[i].compania+"</td>"+
                            "<td class='hidden'>"+json[i].contactonombre+"</td>"+
                            "<td class='hidden'>"+json[i].contactopaterno+"</td>"+
                            "<td class='hidden'>"+json[i].contactomaterno+"</td>"+
                            "<td class='hidden'>"+json[i].contactosexo+"</td>"+
                            "<td class='hidden'>"+json[i].contactorelacion+"</td>"+
                            "<td class='hidden'>"+json[i].contactotelefonofijo+"</td>"+
                            "<td class='hidden'>"+json[i].contactotelefonomovil+"</td>"+
                            "<td class='hidden'>"+json[i].contactoemail+"</td>"+
                            "<td class='hidden'>"+json[i].contactofacebook+"</td>"+
                            "<td class='hidden'>"+json[i].contactotwitter+"</td>"+

                            '<td><button type="button" onclick="llenartabla(this)" class="btn btn-info select btn-sm">seleccionar</button></td>'
                        ).appendTo( "#elementos tbody" );
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
            $('[name=id]').val($('#elemento tbody tr td:nth-child(2)').text());
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
    $('[name=persona_id]').val($row.find("td:nth-child(2)").text());
    $('[name=reclunombre]').val($row.find("td:nth-child(3)").text());
    $('[name=reclupaterno]').val($row.find("td:nth-child(4)").text());
    $('[name=reclumaterno]').val($row.find("td:nth-child(5)").text());
    $('[name=fotoperfil]').attr('src','../imgs/fotos/'+$row.find("td:nth-child(6)").text());
    $('[name=reclusexo] option[value='+$row.find("td:nth-child(7)").text()+']').attr('selected', true);
    $('[name=birthday]').val($row.find("td:nth-child(8)").text());
    $('[name=domicilio]').val($row.find("td:nth-child(9)").text());
    $('[name=colonia]').val($row.find("td:nth-child(10)").text());
    $('[name=municipio]').val($row.find("td:nth-child(11)").text());
    $('[name=estado] option[value='+$row.find("td:nth-child(12)").text()+']').attr('selected', true);
    $('[name=postal]').val($row.find("td:nth-child(13)").text());
    $('[name=lugnac]').val($row.find("td:nth-child(14)").text());
    $('[name=curp]').val($row.find("td:nth-child(15)").text());
    $('[name=email]').val($row.find("td:nth-child(16)").text());
    $('[name=reclutelefonofijo]').val($row.find("td:nth-child(17)").text());
    $('[name=reclutelefonomovil]').val($row.find("td:nth-child(18)").text());
    $('[name=reclufacebook]').val($row.find("td:nth-child(19)").text());
    $('[name=reclutwitter]').val($row.find("td:nth-child(20)").text());
    $('[name=estatura]').val($row.find("td:nth-child(21)").text());
    $('[name=peso]').val($row.find("td:nth-child(22)").text());
    $('[name=tiposangre] option[value='+$row.find("td:nth-child(23)").text()+']').attr('selected', true);
    $('[name=ocupacion]').val($row.find("td:nth-child(24)").text());
    $('[name=estadocivil]').val($row.find("td:nth-child(25)").text());
    $('[name=escolaridad]').val($row.find("td:nth-child(26)").text());
    $('[name=escuela]').val($row.find("td:nth-child(27)").text());
    $('[name=alergia]').val($row.find("td:nth-child(28)").text());
    $('[name=vicios]').val($row.find("td:nth-child(29)").text());
    $('[name=arma]').val($row.find("td:nth-child(30)").text());
    $('[name=cuerpo]').val($row.find("td:nth-child(31)").text());
    $('[name=compania] option[value='+$row.find("td:nth-child(32)").text()+']').attr('selected', true);
    $('[name=contactonombre]').val($row.find("td:nth-child(33)").text());
    $('[name=contactopaterno]').val($row.find("td:nth-child(34)").text());
    $('[name=contactomaterno]').val($row.find("td:nth-child(35)").text());
    $('[name=contactosexo] option[value='+$row.find("td:nth-child(36)").text()+']').attr('selected', true);
    $('[name=contactorelacion]').val($row.find("td:nth-child(37)").text());
    $('[name=contactotelefonofijo]').val($row.find("td:nth-child(38)").text());
    $('[name=contactotelefonomovil]').val($row.find("td:nth-child(39)").text());
    $('[name=contactoemail]').val($row.find("td:nth-child(40)").text());
    $('[name=contactofacebook]').val($row.find("td:nth-child(41)").text());
    $('[name=contactotwitter]').val($row.find("td:nth-child(42)").text());

    $('#elemento').removeClass('hidden');
}