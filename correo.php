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
    <title>Enviar Cotizacion</title>
</head>
<body>
<?php
    if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){
        $carrito_n=$_SESSION['carrito'];
        $_SESSION['carrito']=$carrito_n;
    }
?>
<?php
$nombre = $_POST['nombre'];
require 'vendor/autoload.php';
$html='
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
    *{font-family: Quicksand, sans-serif;}
    
        h1{color:green;}

        table,tr,td,th{
        border:1px solid black;
        border-collapse:collapse;
        }

        table{
        width:50%;
        align:center;
        }

        #columna1 {
        position:absolute;
        top:60px;
        left:0px;
        width:300px;
        margin-top:10px;
        }

        #columna2 {
        border-radius: 10px;
        margin-left:420px;
        margin-right:150px;
        margin-top:10px;
        background-color:#ffffbb;
        }

        #columna2>p {
            font-size: 13px;
            }
        
            #footer>p>a {
            color: blue;
            font-size: 15px;
        }
</style>
</head>
<body>
    <h1>TextilExport</h1>
    <div id="columna1">
    <h4>Calle a Plan del Pino Km 1 1/2.<br/> Ciudadela Don Bosco<br/> Soyapango, El Salvador<br />
    www.textilexport.github.com<br />
    (+503) 2251-8241</h4>
    </div>
    <div id="columna2">
    <h3>Cotización</h3>
    <p>
    Fecha 01/03/2023<br />
    Cotización #    2023-01<br />
    Valido Hasta    05/03/2023<br />
    </p >
    </div>
    <p><b><br/>Cliente: </b>'
    .$nombre.
    '</p>
    <p>Detalle de sus prodcutos bajo la cotizacion realizada. <br/>Cotización vigente por 5 días.
    </p>
    <table align=center width:50%>
    <thead>
        <th class="tabla_carrito_nombre">Nombre</th>
        <th class="tabla_precio">Precio</th>
        <th class="tabla_cantidad">Cantidad</th>
        <th  class="tabla_precio">Subtotal</th>
    </thead>    
    <tbody>';
    $html.='<tr id="carrito_" >';
    $total=0;
    foreach ($carrito_n as $prod){
        $html.='<tr>';
        $html.='<td class="tabla_nombre">'.$prod['nombre'].'</td>';
        $html.='<td class="tabla_precio">$'.$prod['precio'].'</td>';
        $html.='<td class="tabla_cantidad">'.$prod['cantidad'].'</td>';
        $html.='<td class="tabla_precio">$'.$prod['cantidad']*$prod['precio'].'</td>';
        $total+=$prod['cantidad']*$prod['precio'];
        $html.='</tr>';
    }
    $html.='
        <tr>
            <td colspan="3"><b>Total:</b></td>
            <td colspan="2"><b>$'.$total.'</b></td>
        </tr>';   

$html .='
     </tbody>

    </table>
    <br/>
    <h4><br />Terminos y Condiciones<br/></h4>
    <p>
    1. Al cliente se le cobrará después de aceptada esta cotización.<br/>
    2. El pago debe realizarlo antes del envio de sus productos.<br/>
    3. Cotización no tiene validez depués de la fecha de vencimiento.<br/>
    4. El tiempo de entrega es de 3 a 5 días.
    </p>
    <div id="footer">
    Alguna duda sobre esta cotización, por favor contactarse al correo: <b/>
    <p>
    <a>alumnos.udb.investigacion@gmail.com</a><br/>
    </p>
    </div>
    <p><br/>¡Gracias por hacer negocios con nosotros!</p>
</body>
</html>
';
$nombre_n=str_replace(' ','',$nombre);
$fecha_actual = getdate();
        $fecha= $fecha_actual['mday'];
        $fecha.=$fecha_actual['mon'];
        $fecha.=$fecha_actual['year'];
        $fecha.=$fecha_actual['hours'].$fecha_actual['minutes'].$fecha_actual['seconds'];
        $nombre_archivo='cotizacion_'.$nombre_n.$fecha.".pdf";

use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->load_html($html);
$dompdf->render();
$output = $dompdf->output();
$namepdf = $nombre_archivo;
$path = 'pdfDoc/'.$namepdf;
file_put_contents($path, $output);
//$dompdf->stream("documento.pdf",array('Attachment'=>'0'));
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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (empty($_POST['correo'])||empty($_POST['nombre'])) {
    echo "<p class='textoCorreo'>Debe ingresar su nombre y un correo valido para el envio de la cotización.</p>";
    echo "<p class='textoCorreo'><a href='cotizacion.php'>Volver</a></p>";
} else {
    $correo_cliente=$_POST['correo'];
    $nombre_cliente=$_POST['nombre'];

    require 'vendor/autoload.php';
    $mail = new PHPMailer(true);
try{
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->SMTPAuth   = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = 'alumnos.udb.investigacion@gmail.com';
    $mail->Password   = 'hykzjitvkvysmjlb';
    $mail->setFrom('alumnos.udb.investigacion@gmail.com', 'COTIZACION TEx');
    $mail->addAddress($correo_cliente, 'COMPRAS TEx');
    $mail->AddAttachment('pdfDoc/'.$nombre_archivo, 'Cotizacion_TextilExport.pdf');
    $mail->isHTML(true);
    $mail->Subject = 'Cotizacion TextilExport';
    $mail->Body = "Hola ". $nombre_cliente . ",<br/>Compartimos su <b>Cotizacion</b> realizada. Es un placer atenderle."; 
    $mail->send();
    }catch(Exception $e){
        echo 'Mensaje ', $mail->ErrorInfo;
        }
?>
    <p class="textoCorreo">Correo Enviado <br /> Gracias por realizar la cotizacion con nosotros.</p>
        <form class="contendor_cotizacion" method="POST" action="index.php">
            <div id="contendor_btn_carrito">
                <input type="submit" value="Realizar otra Cotizacion" id="btn_cotizacion">
            </div>
        </form>
    </div>
<?php
    }
?>
</body>
</html>