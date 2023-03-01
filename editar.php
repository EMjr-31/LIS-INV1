<?php 
    $codigo=$_POST['codigo'];
    $nombre=$_POST['nombre'];
    $categoria=$_POST['categoria'];
    $descripcion=$_POST['descripcion'];
    $exis=$_POST['existencias'];
    $precio=$_POST['precio'];

$productos=simplexml_load_file("productos.xml");
    $i=0;
    $index=-1;
    foreach($productos->producto as $prod){
        if($codigo==$prod->codigo){
            $index=$i;
            break;
            
        }
        $i++;
    }
    if($index>=0){
        $productos->producto[$index]->nombre=$nombre;
        $productos->producto[$index]->categoria=$categoria;
        $productos->producto[$index]->descripcion=$descripcion;
        $productos->producto[$index]->existencias=$exis;
        $productos->producto[$index]->precio=$precio;
         echo var_dump($materias);
    }
    file_put_contents("productos.xml",$productos->asXML());
    header('location:admin.php');