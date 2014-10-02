$(document).ready(function() {
   $('#fbuscar').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            nombre: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'The username can only consist of alphabetical and number'
                    },
                    different: {
                        field: 'password',
                        message: 'The username and password cannot be the same as each other'
                    }
                }
            },
            paterno: {
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z]+$/,
                        message: 'The username can only consist of alphabetical and number'
                    },
                    different: {
                        field: 'password',
                        message: 'The username and password cannot be the same as each other'
                    }
                }
            },
            materno: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    },
                }
            }
        }
    })
.on('success.form.bv', function(e) {
            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $('.fa-spin').removeClass('hidden');
            $.post($form.attr('action'), $form.serialize(), function(json) {
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
            }, 'json');
        });;
});
