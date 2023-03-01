<?php
session_start();

if(isset($_SESSION['carrito'])){
    $carrito_n=$_SESSION['carrito'];
    if(isset($_POST['nombre'])){
        $nombre=$_POST['nombre'];
        $precio=$_POST['precio'];
        $cantidad=$_POST['cantidad'];
        $carrito_n[]=array("nombre"=>$nombre,"precio"=>$precio,"cantidad"=>$cantidad);
    }
}else{
    $nombre=$_POST['nombre'];
    $precio=$_POST['precio'];
    $cantidad=$_POST['cantidad'];
    $carrito_n[]=array("nombre"=>$nombre,"precio"=>$precio,"cantidad"=>$cantidad);
}
$_SESSION['carrito']=$carrito_n;
header("Location: ".$_SERVER['HTTP_REFERER']."");
?>