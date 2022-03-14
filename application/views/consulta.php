<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Buzón de sugerencias</title>
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>-->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style type="text/css">
        #titulo {
            margin-top: 50px;
            text-align: center;
        }

        th {
            text-align: center;
        }

        #idBoton {
            text-align: center;
        }

        #tabla th:nth-child(2) {
            width: 84%;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .page-link {
            color: black;
            border-color: grey;
            background-color: white;
        }

        .page-link:hover {
            color: black;
        }

        #act {
            background-color: grey;
            border-color: grey;
        }

        a {
            color: grey;
        }

        #btnexp {
            text-align: end;
        }
    </style>

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 id="titulo">
                    Buzón de sugerencias - Contultas
                </h3>
                <!--Boton exportar tabla a exel-->
                <div id="btnexp">
                    <a class="btn btn-primary" href="http://localhost:81/bcit-ci-CodeIgniter-b73eb19/" role="button">Buzon</a>
                    <a class="btn btn-success" href='<?= base_url() ?>index.php/Sugerencias/export'>Exportar</a><br><br>
                </div>
                <table id="tabla" class="table table-bordered table-hover">
                    <thead>
                        <tr class="table-active">
                            <th>
                                Id
                            </th>
                            <th>
                                Sugerencia
                            </th>
                            <th>
                                Fecha
                            </th>
                            <th>

                            </th>
                        </tr>
                    </thead>
                    <!--Cuerpo de la tabla-->
                    <tbody>
                        <?php
                        foreach ($sugerencias as $fila) {
                        ?>
                            <tr class="table table-bordered" style="max-height: 5px;">
                                <td style="text-align: center">
                                    <?= $fila->id; ?>
                                </td>
                                <td>
                                    <?php if (strlen($fila->sugerencia) > 200) { ?>
                                        <?= substr($fila->sugerencia, 0, 200) ?>
                                        <a href="#" id="btn.<?= $fila->id; ?>" onclick="javascript:document.getElementById('btn.<?= $fila->id; ?>').style.display='none';" data-toggle="collapse" data-target="#<?= $fila->id; ?>" style="color:blue;">
                                            ...Ver mas
                                        </a>
                                        <div id="<?= $fila->id; ?>" class="collapse">
                                            <?= substr($fila->sugerencia, 200) ?>
                                            <a href="#" onclick="javascript:document.getElementById('btn.<?= $fila->id; ?>').style.display='initial';" data-toggle="collapse" data-target="#<?= $fila->id; ?>" style="color:blue;">
                                                ...Ver menos
                                            </a>
                                        </div>
                                    <?php
                                    } else {
                                        echo $fila->sugerencia;
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center">
                                    <?= $fila->fecha; ?>
                                </td>
                                <form action="<?= base_url() . 'index.php/Sugerencias/formData/' . $fila->id; ?>" method="POST" id="formulario">
                                    <!--Boton eliminar-->
                                    <td id="idBoton">
                                        <button onclick="return confirm('¿Eliminar?')" type="submit" class="btn btn-danger">X</button>
                                    </td>
                                </form>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
                <div class="h4">
                    <!--botones de paginacion-->
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</body>