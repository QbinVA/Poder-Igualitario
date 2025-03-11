<?php

include("con_db.php");

if(isset($_POST['registro'])){
    if (strlen($_POST['name']) >= 1 && strlen($_POST['email']) >= 1 ) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $fechareg = date("d/m/y");
        $consultas = "INSERT INTO 'datos'(Nombre, email, fecha_reg) VALUES ('$name','$email','$fechareg')";
        $resultado = mysqli_query($conex,$consultas);
        if ($resultado){
            ?>
            <h3> class = "ok" >¡te has inscripto correctamente!</h3>
            <?php
        }else{
            ?>
            <h3 class = "bad" >¡ups ha ocurrido un error!</h3>
            <?php
        }
        }else{
        ?>
        <h3 class = "bad" >¡por favor complete!</h3>
        <?php
    }
}

?>