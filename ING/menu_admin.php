<?php
    include("php/conexion.php");// el include es para llamar a un archivo
    include("php/validarSesion.php");
    if(!isset($_SESSION['rol'])){
        header('Location: index.php');
    }else{
        if($_SESSION['rol'] != 1){
            header('Location: index.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Administrador | SBD</title>
        <link rel="stylesheet" href="./estilo.css">
        <link rel="icon" href="img/hospital.png">
        <style>

        </style>
    </head>
    <body>
    <div class="container">
    <div class="tutorial">
    <ul>
      <div style="font-size:40px; float: left; color: white;padding-top: 15px; margin-right: 15px;">Inicio administrador</div>
        <li><a id="a" href="php/cerrarSesion.php">Cerrar sesión </a></li>
      </ul>
      <div class="slider">
        <br>
        <h2>Nóminas - Empresa</h2>
        <br>
        <div style="margin: 0% 25%;">
            <div style="display: flex;">
                <div>
                    <p style="margin: 9px auto; padding: 5px;">Buscar por nombre</p>
                    <p style="margin: 9px auto; padding: 5px;">Buscar por area</p>
                </div>
                <div style="width: -webkit-fill-available;">
                    <form action="Busqueda.php" method="GET">
                        <input type="text" autocomplete="off" name="nombre">
                        <input type="submit" name = "submit" class="green" value="->" style="width: 30px">
                        <br>
                    </form>
                    <form action="Busqueda.php" method="GET">
                        <input type="text" autocomplete="off" name="area">
                        <input type="submit" name = "submit" class="green" value="->" style="width: 30px">
                    </form>
                </div>
            </div>
            
            <br>
            <div style="text-align:center;">
                <button id="btnadd">Agregar un empleado</button>
                <button id="btnlook">Ver lista completa de empleados</button>
            </div>
            
            <div id="add" style="margin: 0% 25%; text-align: center; display:none;">
                <?php require_once 'php/process.php'?>
                <form action="php/process.php" method="POST">
                    Agregar empleado<br>
                    <input type="text" autocomplete="off" placeholder="Nombre del empleado" name="nombreADD"><br>
                    <input type="text" autocomplete="off" placeholder="Area del empleado" name="areaADD"><br>
                    <input type="text" autocomplete="off" placeholder="Sueldo del empleado" name="sueldoADD"><br>
                    <button type="submit" name="save">Guardar datos</button>
                </form>
            </div>

            <div id="look" style="text-align: center; display:none;">
                <div>
                    <table class="styled-table">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Trabajo</th>
                            <th>Sueldo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $con = mysqli_connect("localhost", "root", "", "usuarioing");
                                $query = "SELECT * FROM trabajadores";
                                $query_run = mysqli_query($con, $query);
                                if(mysqli_num_rows($query_run) > 0){
                                foreach($query_run as $items){
                            ?>
                            <tr onclick="window.location='Busqueda.php?nombre=<?php echo $items['Nombre']; ?>'" class="active-row">
                            <td><?= $items['id']; ?></td>
                            <td><?= $items['Nombre']; ?></td>
                            <td><?= $items['Area']; ?></td>
                            <td><?= $items['Sueldo']; ?></td>
                            </tr>
                            <?php
                                }}?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <br>
    </div>
    <div class="information">
    </div>
</div>
<script>
    const targetDiv1 = document.getElementById("add");
    const targetDiv2 = document.getElementById("look");
    const btn1 = document.getElementById("btnadd");
    const btn2 = document.getElementById("btnlook");
    btn1.onclick = function () {
        if (targetDiv1.style.display !== "block") {
            targetDiv1.style.display = "block";
        }else{
            targetDiv1.style.display = "none";
        }
    };
    btn2.onclick = function () {
        if (targetDiv2.style.display !== "block") {
            targetDiv2.style.display = "block";
        }else{
            targetDiv2.style.display = "none";
        }
    };
</script>
    </div><link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- partial -->
    </body>
</html>