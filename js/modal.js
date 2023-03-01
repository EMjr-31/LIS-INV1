
/*elemento ventana modal*/
const modal= document.getElementById('modal__contenedor');
/*Funcion que se ejecuta al seleccionar un producto y realiza la busqueda de dicho producto*/
function abrir(elemento){
    desabilitarScroll();
    const articulo= elemento;
    let modalStyle = window.getComputedStyle(modal);
    if( modalStyle.getPropertyValue('display')=="none"){
        modal.style.display='flex';
        var codigo= articulo.getAttribute("data-id");
        $.post('./busqueda.php',{cod:codigo},
        function(datos, estado){
            cargarProducto(datos);
            //console.log(estado);
        }
        );
        

    }
}
/*Funcion para mostrar el productos a seleccionar*/
function cargarProducto(datos){
    /*Convertimos el JSON en un Objeto JS*/
    let prod=JSON.parse(datos);
    /*cargamos la informacion*/
    document.getElementById('modal__img').src="img/"+prod["img"];
    document.getElementById('modal__nombre').innerHTML=prod["nombre"];
    document.getElementById('nombre_c').value=prod["nombre"];
    document.getElementById('modal__cat').innerHTML="<b>Categoria: </b>"+prod["categoria"];
    document.getElementById('modal__desc').innerHTML="<b>Descripcion: </b>"+prod["descripcion"];
    document.getElementById('modal__prec').innerHTML="<b>Precio: </b>$"+prod["precio"];
    document.getElementById('precio_c').value=prod["precio"];
    if(prod["existencias"]>0){
        document.getElementById('modal_cantidad').value="1";
        document.getElementById('modal__exis').innerHTML="<b>En existencia: </b>"+prod["existencias"]+" unidades";
        document.getElementById('modal__exis').style.color="black";
        document.getElementById('modal_cantidad').setAttribute("max",prod["existencias"]);
        document.getElementById('contenedor__cantidades').style.display="flex";
    }else{
        document.getElementById('modal__exis').innerHTML="<b>Producto no disponible</b>";
        document.getElementById('modal__exis').style.color="#FE8484";
        document.getElementById('contenedor__cantidades').style.display="none";
    }
   
}

/*Funcion para cerrar la cerrar la ventana moval y evitar el recargar la pagina*/
document.getElementById('btn__cerrar').addEventListener("click", function(event){
    event.preventDefault();
    modal.style.display='none'; 
    habilitarScroll();
});

/* barra de desplaza,miento*/
function desabilitarScroll(){  
    var x = window.scrollX;
    var y = window.scrollY;
    window.onscroll = function(){ window.scrollTo(x, y) };
}

function habilitarScroll(){  
    window.onscroll = null;
}