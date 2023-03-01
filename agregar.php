<?php
 if(isset($_POST['btn'])){
    if(validarCodigo($_POST['codigo']) && existenciaCodigo($_POST['codigo']) && validarNumero($_POST['existencias']) && validarNumero(validarNumero($_POST['precio']))){
        if(isset($_FILES['file'])){
            $archivo=$_FILES['file'];
            $archivo_nombre=$archivo['name'];
            $archivo_tipo=$archivo['type'];
            $ext= explode('.',$archivo_nombre);
            $tipos=array("image/jpg","image/png");
            var_dump($archivo_tipo);
            if(!in_array($archivo_tipo,$tipos)){
                error("No se permite ese formato de imagen o La imagen del producto no se subio");
            }else{
                 //directorio 
                if(!is_dir("img")){
                    mkdir("img", 8777);
                }
                //mover archivo
                $nuevo_nombre=trim($_POST['codigo']).'.'.$ext[1];
                move_uploaded_file($archivo['tmp_name'], 'img/'.$nuevo_nombre);
                //agregar
                $productos=simplexml_load_file("productos.xml");
                $producto=$productos->addChild('producto');
                $producto->addChild('codigo',$_POST['codigo']);
                $producto->addChild('nombre',$_POST['nombre']);
                $producto->addChild('descripcion',$_POST['descripcion']);
                $producto->addChild('img',$nuevo_nombre);
                $producto->addChild('categoria',$_POST['categoria']);
                $producto->addChild('precio',$_POST['precio']);
                $producto->addChild('existencias',$_POST['existencias']);
                file_put_contents("productos.xml",$productos->asXML());
                header('location:admin.php');
            }
        }else{
            error("La imagen del producto no se subio");
        }
    }

 }else{
    error("Formularrio no completado");
 }
    /*Funcion para validar el formato del codigo */
    function validarCodigo($codigo){
        if(preg_match("/^(PROD)\d{5}$/",$codigo)){
            return true;
        }else{
            error("El codigo no coincide con el formato");
            return false;
        }
    }
        /*Funcion para buscar si el codigo del producto exsite */
    function existenciaCodigo($codigo){
        $productos=simplexml_load_file("productos.xml");
        $i=0;
        $index=-1;
        /*Recorrido para encontrar el producto por codigo*/
        foreach($productos->producto as $prod){
             /*la estructura se detienen hasta que el codigo consida con un producto*/
            if($codigo==$prod->codigo){
                $index=$i;
                break;
            }
            $i++;
        }
        /*Si el producto fue encontrado lo guardamos en el objeto*/
        if($index>=0){
            error("Ya existe el codigo");
            return false;
        }else{
            return true;
        }
    }
    /*Funcion para validar numeros */
    function validarNumero($num){
        if($num>0){
            return true;
        }else{
            return false;
        }

    }
    /*Funcion de error*/
    function error($cadena){
        echo "<script language=JavaScript>alert('$cadena.');</script>";
    }
?>