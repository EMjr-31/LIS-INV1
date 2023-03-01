<?php
    session_start();
    $carrito_n=$_SESSION['carrito'];
    $prod=$_GET['indice'];
    if(isset($_SESSION['carrito'])){
        echo $prod;
        unset($carrito_n[$prod]);
    }
    foreach ($carrito_n as $prod){
        $nombre=$prod['nombre'];
        $precio=$prod['precio'];
        $cantidad=$prod['cantidad'];
        $nuevo_orden[]=array("nombre"=>$nombre,"precio"=>$precio,"cantidad"=>$cantidad);
    }
    $_SESSION['carrito']=$nuevo_orden;
    header("Location: ".$_SERVER['HTTP_REFERER']."");
?>