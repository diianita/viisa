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
    
    $("#form-login").submit(function() {
        return false;
    });
    
    $('#form-create-manager').validate({
        rules: {
            nombreManager: {
                required: true,
                minlength: 5
            },
            apellidoManager: {
                required: true,
                minlength: 5
            },
            emailManager:{
                required: true,
                email:true
            },
            cargoManager: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            nombreManager: {
                required: "Porfavor ingrese el nombre del directivo",
                minlength: "Escriba minimo 5 carácteres"
            },
            apellidoManager: {
                required: "Porfavor ingrese el apellido del directivo",
                minlength: "Escriba minimo 5 carácteres"
            },
            emailManager:{
                required: "Porfavor ingrese el email del directivo",
                email: "Formato de email invalido"
            },
            cargoManager: {
                required: "Porfavor ingrese el cargo del directivo",
                minlength: "Escriba minimo 5 carácteres"
            }
        }
    });
    
    $("#form-create-manager").submit(function() {
        return false;
    });
    
    /* -------------------------------------------------------------------*/

    $("#btn-login").click(function() {
        if ($("#form-login").validate().checkForm()) {
            alert("bien");
        }
    });

    $("#btn-crear-manager").click(function() {
        if ($("#form-create-manager").validate().checkForm()) {
            var foto = "";
            var nombre = $('#nombreManager').val();
            var apellido = $('#apellidoManager').val();
            var email = $('#emailManager').val();
            var cargo = $('#cargoManager').val();
            
            $.ajax({
                type: "POST",
                url: "php/manager.php",
                async:false,
                data: {
                    foto:foto,
                    nombre:nombre,
                    apellido:apellido,
                    email:email,
                    cargo:cargo
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    console.log(result);
                }
            });
        }
    });
});

	