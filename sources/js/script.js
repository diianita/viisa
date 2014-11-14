function processLogin() {
    var user = $('#username').val();
    var password = $('#password').val();

    $.post('/processLogin/', {username: user, password: password}, function(data) {
        // alert(data)
        var result = $.parseJSON(data);
        if (result.success) {
            window.location = '/dashboard/';
        } else {
            alert('Usuario y/o contaseña incorrectos');
        }
    });
}

function deleteEditorial(id) {
    if (confirm("Desea eliminar la editorial, esta acción no se puede deshacer.")) {
        $.ajax({
            type: "POST",
            url: init.WEBSITE_URL + "php/deleteEditorial.php",
            async: false,
            data: {
                id: id
            },
            success: function(data) {
                var result = $.parseJSON(data);
                if (result.success) {
                    window.location = init.WEBSITE_URL + 'editorial/list';
                } else {
                    alert('Hubo un error, ' + result.mensaje);
                }
            }
        });
    }
}

function deleteAutor(id) {
    if (confirm("Desea eliminar el autor, esta acción no se puede deshacer.")) {
        $.ajax({
            type: "POST",
            url: init.WEBSITE_URL + "php/deleteAutor.php",
            async: false,
            data: {
                id: id
            },
            success: function(data) {
                var result = $.parseJSON(data);
                if (result.success) {
                    window.location = init.WEBSITE_URL + 'author/list';
                } else {
                    alert('Hubo un error, ' + result.mensaje);
                }
            }
        });
    }
}

function deleteLibro(id) {
    if (confirm("Desea eliminar el libro, esta acción no se puede deshacer.")) {
        $.ajax({
            type: "POST",
            url: init.WEBSITE_URL + "php/deleteBook.php",
            async: false,
            data: {
                id: id
            },
            success: function(data) {
                var result = $.parseJSON(data);
                if (result.success) {
                    window.location = init.WEBSITE_URL + 'book/list';
                } else {
                    alert('Hubo un error, ' + result.mensaje);
                }
            }
        });
    }
}

function deleteEjemplar(id) {
    if (confirm("Desea eliminar el ejemplar, esta acción no se puede deshacer.")) {
        $.ajax({
            type: "POST",
            url: init.WEBSITE_URL + "php/deleteEjemplar.php",
            async: false,
            data: {
                id: id
            },
            success: function(data) {
                var result = $.parseJSON(data);
                if (result.success) {
                    location.reload(true);
                } else {
                    alert(result.mensaje);
                }
            }
        });
    }
}

$(document).ready(function() {

    $('#form-login').validate({
        debug: true,
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
        debug: true,
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
    $("#form-create-manager").submit(function() {
        return false;
    });
    
    $('#form-new-book, #form-edit-book').validate({
        debug: true,
        rules: {
            materia: {
                required: true
            },
            autor: {
                required: true
            },
            editorial: {
                required: true
            },
            nombre: {
                required: true,
                minlength: 5
            },
            descripcion: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            materia: {
                required: "Por favor seleccione un campo"
            },
            autor: {
                required: "Por favor seleccione un campo"
            },
            editorial: {
                required: "Por favor seleccione un campo"
            },
            nombre: {
                required: "Por favor ingrese el nombre del libro",
                minlength: "Por favor ingrese mínino 5 caracteres"
            },
            descripcion: {
                required: "Por favor ingrese la descripción del libro",
                minlength: "Por favor ingrese mínino 5 caracteres"
            }
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
    
    $("#form-new-book").submit(function() {
        return false;
    });
    
    $('#form-new-ej').validate({
        debug: true,
        rules: {
            codigo: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            codigo: {
                required: "Por favor ingrese el código del ejemplar",
                minlength: "Por favor ingrese mínino 5 caracteres"
            }
        }
    });
    
    $("#form-new-ej").submit(function() {
        return false;
    });
    
    /* -------------------------------------------------------------------*/

    $("#btn-login").click(function() {
        if ($("#form-login").validate().checkForm()) {
            processLogin();
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
                url: init.WEBSITE_URL + "php/manager.php",
                async: false,
                data: {
                    foto: foto,
                    nombre: nombre,
                    apellido: apellido,
                    email: email,
                    cargo: cargo
                },
                success: function(data) {
                    var result = $.parseJSON(data);
                    console.log(result);
                }
            });
        }
    });

    $(".btn-crear-author").click(function() {
        if ($(".form-crear-author").validate().checkForm()) {
            var nombre = $('.nombre').val();
            $.ajax({
                type: "POST",
                url: init.WEBSITE_URL + "php/saveAuthor.php",
                async: false,
                data: {
                    nombre: nombre
                },
                success: function(data) {
                    var result = $.parseJSON(data);
                    if (result.return) {
                        window.location = '/author/list';
                    }
                }
            });
        }
    });

    $(".btn-crear-editorial").click(function() {
        if ($(".form-crear-editorial").validate().checkForm()) {
            var nombre = $('.nombre').val();
            $.ajax({
                type: "POST",
                url: init.WEBSITE_URL + "php/saveEditorial.php",
                async: false,
                data: {
                    nombre: nombre
                },
                success: function(data) {
                    var result = $.parseJSON(data);
                    if (result.return) {
                        window.location = '/editorial/list';
                    }
                }
            });
        }
    });

    $(".guardar-materia-nueva").click(function() {
        var nombre = $('.materia-nueva').val();
        $.ajax({
            type: "POST",
            url: init.WEBSITE_URL + "php/saveMateria.php",
            async: false,
            data: {
                nombre: nombre
            },
            success: function(data) {
                var result = $.parseJSON(data);
                if (result.return) {
                    $('#myModal').modal('hide');
                    $('.materias').append('<option value="' + result.id + '">' + result.nombre + '</option>');
                    $('.materias').val(result.id);
                }
            }
        });
    });

    $(".crear-libro").click(function() {
        if ($("#form-new-book").validate().checkForm()) {
            var materias = $('.materias').val();
            var nombre = $('.nombre').val();
            var autor = $('.autor').val();
            var editorial = $('.editorial').val();
            var descripcion = $('.descripcion').val();

            $.ajax({
                type: "POST",
                url: init.WEBSITE_URL + "php/saveBook.php",
                async: false,
                data: {
                    materias: materias,
                    nombre: nombre,
                    autor: autor,
                    editorial: editorial,
                    descripcion: descripcion
                },
                success: function(data) {
                    var result = $.parseJSON(data);
                    if (result.return) {
                        window.location = '/book/list';
                    }
                }
            });
        }
    });
    
    $('.search-book').click(function() {
        window.location = '/biblioteca/search/' + $('.seleccione-filtro').val() + '/' + $('#searchText').val();
    });

    $('input[type="radio"], input[name="inlineRadioOptions"]').click(function() {
        $('input[type="radio"], input[name="inlineRadioOptions"]').removeAttr('checked');
        $(this).attr('checked', true);
    });

    $('label').click(function() {
        $('label').find('input').removeAttr('checked');
        $(this).find('input').attr('checked', true);
    });

    $(".btn-crear-user").click(function() {
        if ($(".form-crear-user").validate().checkForm()) {
            var nombre = $('.nombre').val();
            var apellido = $('.apellido').val();
            var cotrasena = $('.contrasena').val();
            var email = $('.email').val();
            var userTipo = $('.userTipo').val();
            $.ajax({
                type: "POST",
                url: init.WEBSITE_URL + "php/saveUser.php",
                async: false,
                data: {
                    nombre: nombre,
                    contrasena: cotrasena,
                    apellido: apellido,
                    email: email,
                    userTipo: userTipo
                },
                success: function(data) {
                    var result = $.parseJSON(data);
                    if (result.return) {
                        window.location = '/user/list';
                    }
                }
            });
        }
    });
    
    $(".btn-modal-new-ej").click(function() {
        var book = $(this).attr('data-book');
        $('.guardar-ejemplar').attr('data-book', book);
        $('#modalEjemplar').modal('show');
        
    });
    
    $(".guardar-ejemplar").click(function() {
        if ($("#form-new-ej").validate().checkForm()) {
            var book = $(this).attr('data-book');
            var codigo = $('#codigo').val();
            var descripcion = $('#descripcion').val();
            
            $.ajax({
                type: "POST",
                url: init.WEBSITE_URL + "php/saveEjemplar.php",
                async: false,
                data: {
                    book: book,
                    codigo: codigo,
                    descripcion: descripcion
                },
                success: function(data) {
                    var result = $.parseJSON(data);
                    console.log(data);
                    if (result.return) {
                        location.reload(true);
                    }else{
                        alert(result.mensaje);                        
                    }
                }
            });
        }
    });
});

	