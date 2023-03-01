<?php
/*parametro codigo*/
$cod=$_POST['cod'];
/*objeto para almacenar el producto encontrado*/
$prod_Encontrado="";
/*cargamos el archivo xml*/
$productos=simplexml_load_file("productos.xml");
    $i=0;
    $index=-1;
    /*Recorrido para encontrar el producto por codigo*/
    foreach($productos->producto as $prod){
         /*la estructura se detienen hasta que el codigo consida con un producto*/
        if($cod==$prod->codigo){
            $index=$i;
            break;
        }
        $i++;
    }
    /*Si el producto fue encontrado lo guardamos en el objeto*/
    if($index>=0){
        $prod_Encontrado=$productos->producto[$index];
    }
    /*convertimos el objeto en un jSON*/
    echo json_encode($prod_Encontrado);