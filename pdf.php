<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos_menu_pie.css">
    <link rel="stylesheet" href="css/estilos_tienda.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Cotizacion</title>
</head>
<body>
<?php
    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
        $carrito_n=$_SESSION['carrito'];
        $_SESSION['carrito']=$carrito_n;
    }
    ?>
<header>
        <div class="contenedor_barra_titulo">
            <div class="barra__titulo">
                <h1>Cotizacion TextilExport</h1>
                <span class="material-symbols-outlined">local_mall</span>
            </div>
            <div class="contendor_btn_carrito">
              <h3>Fecha: <?=$fechaActual = date('d-m-Y');?></h3>
            </div>
        </div>
</header>
    <div class="contenedor">
        <?php 
         if(isset($_SESSION['carrito'])){
            ?>
        <form class="contendor_cotizacion" method="POST" action="cotizacion.php">
            <div id="contendor_cotizacion_campos">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="cotizacion_campo_nombre">
                <label for="correo" id="label_correo">Correo</label>
                <input type="email" name="correo" id="cotizacion_campo_correo">
            </div>
            <div id="contendor_btn_carrito">
                <input type="submit" value="Enviar Cotizacion" id="btn_cotizacion">
            </div>
        </form>
        <?php
        }?>
    </div>
    <div class="contenedor">
        <table id="contenedor_tabla" >
            <thead>
                <th class="tabla_carrito_nombre">Nombre</th>
                <th class="tabla_precio">Precio</th>
                <th class="tabla_cantidad">Cantidad</th>
                <th  class="tabla_precio">Subtotal</th>
            </thead>
            <tbody>
                <?php
                if(isset($_SESSION['carrito'])){
                    $index=0;
                    $total=0;
                    foreach ($carrito_n as $prod){
                ?>
                <tr id="carrito_" >
                    <td class="tabla_nombre"><?=$prod['nombre']?></td>
                    <td class="tabla_precio">$<?=$prod['precio']?></td>
                    <td class="tabla_cantidad"><?=$prod['cantidad']?></td>
                    <td class="tabla_precio">$<?=$prod['cantidad']*$prod['precio']?></td>
                    <?php $total+=$prod['cantidad']*$prod['precio']?>
                </tr>
                <?php
                    $index=$index+1; 
                    }
                ?>
                    <tr class="tr_final">
                        <td colspan="3"><b>Total:</b></td>
                        <td colspan="2"><b><?=isset($total)?"$".$total:"$0"?></b></td>
                    </tr>
                <?php 
                }else{
                    ?>
                    <tr class="tr_final">
                        <td colspan="5"><?="No hay productos en el carrito"?></td>
                    </tr>
                    <?php
                }?>

            </tbody>
        </table>
</body>
</html>