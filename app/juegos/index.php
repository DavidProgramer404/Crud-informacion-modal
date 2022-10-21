<?php

session_start();

require '../config/database.php';

$sqlJuegos = "SELECT p.id, p.nombre, p.descripcion, g.nombre AS genero FROM juego AS p
 INNER JOIN genero AS g ON p.id_genero=g.id";
 $juegos = $conn->query($sqlJuegos);

 $dir = "posters/";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud Modal</title>
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="../../assets/css/all.min.css" rel="stylesheet"/>

     <style>
        body {
            background-image: url("https://cdn.pixabay.com/photo/2017/05/09/13/33/laptop-2298286_960_720.png");
            
            height: 900px;
            background-position: center;
            background-repeat: no-repeat;
            
        }
    </style>

</head>

<body>


    
    <div class="container py-3">

        <h2 class="text-center">Modelo de informaciónes </h2>
        <h4>Creado por ↓DavidProgramer404↓</h4>

        <hr>

        <?php if (isset($_SESSION['msg'])){ ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['msg']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>


        <?php 
        unset($_SESSION['msg']);
        } ?>

        <div class="row justify-content-end">
            <div class="col-auto">
            <a href="" class="btn btn-primary" data-bs-toggle="modal"
            data-bs-target="#nuevoModal"><i class="fa-solid fa-circle-plus"></i>
            Nuevo registros</a>
        </div>
    </div>        

        <table class="table table-sm table-striped table-hover mt-4">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Género</th>
                    <th>Poster</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>

            <?php while($row_juego = $juegos->fetch_assoc()){ ?>
                <tr>
                    <td><?= $row_juego['id']; ?></td>
                    <td><?= $row_juego['nombre']; ?></td>
                    <td><?= $row_juego['descripcion']; ?></td>
                    <td><?= $row_juego['genero']; ?></td>
                    <td><img src="<?= $dir .$row_juego['id'] . '.jpg'; ?>" width="100"></td>
                    <td>

                    <a href="#" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                    data-bs-target="#editaModal"data-bs-id="<?= $row_juego['id']; ?>"><i
                    class="fa-solid fa-pen-to-square"></i> Editar</a>

                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                    data-bs-target="#eliminaModal"data-bs-id="<?= $row_juego['id']; ?>"><i
                    class="fa-solid fa-trash"></i></i> Eliminar</a>

                    </td>
                    
                </tr>

            <?php }?>

            </tbody>
        </table>


        <?php
        $sqlGenero = "SELECT id, nombre FROM genero";
        $generos = $conn->query($sqlGenero);
        ?>

    <?php include 'nuevoModal.php'; ?>

    <?php $generos->data_seek(0);?>


    <?php include 'editaModal.php'; ?>
    <?php include 'eliminaModal.php'; ?>

    <script>
        let editaModal = document.getElementById('editaModal')
        let eliminaModal = document.getElementById('eliminaModal')

        editaModal.addEventListener('shown.bs.modal', event => {
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')

            let inputId = editaModal.querySelector('.modal-body #id')
            let inputNombre = editaModal.querySelector('.modal-body #nombre')
            let inputDescripcion = editaModal.querySelector('.modal-body #descripcion')
            let inputGenero = editaModal.querySelector('.modal-body #genero')

            let url = "getJuego.php"
            let formData = new FormData()
            formData.append('id',id)

            fetch(url, {
                method: "POST",
                body: formData
            }).then(response=> response.json())
            .then(data => {

                inputId.value = data.id
                inputNombre.value = data.nombre
                inputDescripcion.value = data.descripcion
                inputGenero.value = data.id_genero
            }).catch(err => console.log(err))

        })

        eliminaModal.addEventListener('shown.bs.modal',event=>{
            let button = event.relatedTarget
            let id = button.getAttribute('data-bs-id')
            eliminaModal.querySelector('.modal-footer #id').value = id
        })

    </script>
    

    
    <script src="../../assets/js/bootstrap.bundle.min.js"></script>
</body>


</html>