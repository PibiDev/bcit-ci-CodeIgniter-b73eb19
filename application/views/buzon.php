<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Buzón de sugerencias</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <style type="text/css">
        textarea {
            resize: none;
            margin: 0 auto;
            display: flex;

        }

        #texto {
            margin: 50px;
            padding: 0px;
            text-align: center;
        }

        #titulo {
            margin-top: 50px;
        }

        #button {
            margin: 50px auto;
            display: flex;
        }

        .col-md-12{
            text-align: center;
        }
        
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 id="titulo" class="text-center">
                    Buzón de sugerencias
                </h3>
                <p id="texto" class="text-center">
                    Lorem ipsum dolor sit amet, <strong>consectetur adipiscing elit</strong>. Aliquam eget sapien sapien. Curabitur in metus urna. In hac habitasse platea dictumst. Phasellus eu sem sapien, sed vestibulum velit. Nam purus nibh, lacinia non faucibus et, pharetra in dolor. Sed iaculis posuere diam ut cursus. <em>Morbi commodo sodales nisi id sodales. Proin consectetur, nisi id commodo imperdiet, metus nunc consequat lectus, id bibendum diam velit et dui.</em> Proin massa magna, vulputate nec bibendum nec, posuere nec lacus. <small>Aliquam mi erat, aliquam vel luctus eu, pharetra quis elit. Nulla euismod ultrices massa, et feugiat ipsum consequat eu.</small>
                </p>

                <!--Funcion que valida si esta vacio el textarea-->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        document.getElementById("formulario").addEventListener('submit', validarFormulario);
                    });

                    function validarFormulario(evento) {
                        evento.preventDefault();
                        var texto = document.getElementById('textarea').value;
                        if (texto.length == 0) {
                            alert('Error: El campo no puede estar vacio.');
                            return;
                        }
                        alert('El buzon recibio tu sugerencia.');
                        this.submit();
                    }
                </script>

                <form action="<?= base_url() . 'index.php/Action/formData'; ?>" method="POST" id="formulario">
                    <textarea placeholder="Sugerencias" name="textarea" rows="10" cols="75" id="textarea"></textarea>
                    <button type="submit" id="button" class="btn btn-primary" name="save_task">Enviar</button>
                </form>
                <!--<a id="button2" class="btn btn-primary" href="http://sitiovirtual2.com:85/index.php/sugerencias" role="button">Sugerencias</a>-->
                <a id="button2" class="btn btn-primary" href="http://localhost:81/bcit-ci-CodeIgniter-b73eb19/index.php/sugerencias" role="button">Sugerencias</a>
            </div>
        </div>
    </div>
</body>