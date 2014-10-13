$(document).ready(function() {

    //$("#form-login").validate({debug: true});

    $('#form-login').validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            username: {
                required: "Porfavor ingrese su nombre de usuario"
            },
            password: {
                required: "Porfavor ingrese una contaseña",
                minlength: "Escriba minimo 5 carácteres"
            }
        }
    });

    $("#btn-login").click(function() {
        if ($("#form-login").validate().checkForm()) {
            alert("bien");
        }else{
            alert("vefirique los datos del formulario");
        }
    });

    $("#form-login").submit(function() {
        return false;
    });
});

	