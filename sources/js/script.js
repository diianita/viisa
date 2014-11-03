$(document).ready(function () {

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

    $("#form-login").submit(function () {
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
            emailManager: {
                required: true,
                email: true
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
            emailManager: {
                required: "Porfavor ingrese el email del directivo",
                email: "Formato de email invalido"
            },
            cargoManager: {
                required: "Porfavor ingrese el cargo del directivo",
                minlength: "Escriba minimo 5 carácteres"
            }
        }
    });


    $("#form-create-manager").submit(function () {
        return false;
    });

    /* -------------------------------------------------------------------*/

    $("#btn-login").click(function () {
        if ($("#form-login").validate().checkForm()) {
            alert("bien");
        }
    });

    $("#btn-crear-manager").click(function () {
        if ($("#form-create-manager").validate().checkForm()) {
            var foto = "";
            var nombre = $('#nombreManager').val();
            var apellido = $('#apellidoManager').val();
            var email = $('#emailManager').val();
            var cargo = $('#cargoManager').val();

            $.ajax({
                type: "POST",
                url: "php/manager.php",
                async: false,
                data: {
                    foto: foto,
                    nombre: nombre,
                    apellido: apellido,
                    email: email,
                    cargo: cargo
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    console.log(result);
                }
            });
        }
    });


    $(".btn-crear-author").click(function () {

        if ($(".form-crear-author").validate().checkForm()) {

            var nombre = $('.nombre').val();


            $.ajax({
                type: "POST",
                url: "php/saveAuthor.php",
                async: false,
                data: {
                    nombre: nombre
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.return) {
                        window.location = '/autores';
                    }
                }
            });
        }
    });


    $(".btn-crear-editorial").click(function () {

        if ($(".form-crear-editorial").validate().checkForm()) {

            var nombre = $('.nombre').val();


            $.ajax({
                type: "POST",
                url: "php/saveEditorial.php",
                async: false,
                data: {
                    nombre: nombre
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.return) {
                        window.location = '/editorial';
                    }
                }
            });
        }
    });

    $(".guardar-materia-nueva").click(function () {

        var nombre = $('.materia-nueva').val();


        $.ajax({
            type: "POST",
            url: "php/saveMateria.php",
            async: false,
            data: {
                nombre: nombre
            },
            success: function (data) {
                var result = $.parseJSON(data);
                if (result.return) {
                    $('#myModal').modal('hide');
                    $('.materias').append('<option value="' + result.id + '">' + result.nombre + '</option>')
                    $('.materias').val(result.id)
                }
            }
        });

    });


    $(".crear-libro").click(function () {

        // if ($(".agregar-libro").validate()) {
        var materias = $('.materias').val();
        var nombre = $('.nombre').val();
        var autor = $('.autor').val();
        var editorial = $('.editorial').val();
        var descripcion = $('.descripcion').val();

        if (nombre.length == 0) {
            alert('Escriba un nombre')
            return false;
        }
        else if (materias == 0) {
            alert('Seleccione una Materia')
            return false;
        }
        else if (autor == 0) {
            alert('Seleccione un Autor')
            return false;
        }
        else if (editorial == 0) {
            alert('Seleccione un Editorial')
            return false;
        }
        else if (descripcion.length == 0) {
            alert('Escriba una descripcion')
            return false;
        }


        $.ajax({
            type: "POST",
            url: "php/saveBook.php",
            async: false,
            data: {
                materias: materias,
                nombre: nombre,
                autor: autor,
                editorial: editorial,
                descripcion: descripcion
            },
            success: function (data) {
                var result = $.parseJSON(data);
                if (result.return) {
                    window.location = '/listBooks'
                    /*$('#myModal').modal('hide');
                     $('.materias').append('<option value="' + result.id + '">' + result.nombre + '</option>')
                     $('.materias').val(result.id)*/
                }
            }
        });

    });



    $('.search-book').click(function () {
        window.location = '/biblioteca/search/' + $('.seleccione-filtro').val() + '/' + $('#searchText').val()
    })

    $('input[type="radio"], input[name="inlineRadioOptions"]').click(function () {
        $('input[type="radio"], input[name="inlineRadioOptions"]').removeAttr('checked')
        $(this).attr('checked', true)
    })

    $('label').click(function () {
        $('label').find('input').removeAttr('checked')
        $(this).find('input').attr('checked', true)
    })

    $(".btn-crear-user").click(function () {

        if ($(".form-crear-user").validate().checkForm()) {

            var nombre = $('.nombre').val();
            var apellido = $('.apellido').val();
            var cotrasena = $('.contrasena').val();
            var email = $('.email').val();
            
            var userTipo = $('.userTipo').val();
            

            $.ajax({
                type: "POST",
                url: "php/saveUser.php",
                async: false,
                data: {
                    nombre: nombre,
                    contrasena: cotrasena,
                    apellido: apellido,
                    email: email,
                    userTipo:userTipo
                },
                success: function (data) {
                    var result = $.parseJSON(data);
                    if (result.return) {
                        window.location = '/usuarios';
                    }
                }
            });
        }
    });
});

	