<?php 
    $codigo=$_POST['codigo'];

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
        unset( $productos->producto[$index]);
    }
    file_put_contents("productos.xml",$productos->asXML());
    header('location:admin.php');