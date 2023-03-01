
/*elemento ventana modal*/
const modal= document.getElementById('modal__contenedor');
/*Funcion que se ejecuta al seleccionar un producto y realiza la busqueda de dicho producto*/
function abrir(elemento){
    desabilitarScroll();
    const btn= elemento;
    let modalStyle = window.getComputedStyle(modal);
    if( modalStyle.getPropertyValue('display')=="none"){
        modal.style.display='flex';
        var tipobtn= btn.getAttribute("data-btn");
        switch (tipobtn) {
            case "agregar": 
                agregar();
            break;               
            case "modificar": 
                editar(elemento);            
            break;
            case "eliminar": console.log("E");
                eliminar(elemento); 
            break;
        }
        ;
        /*
        
        */
    }
}

/*funcion para agregar */
function agregar(){
    var labels= document.querySelectorAll('.label');
    labels.forEach(function(label){
        label.classList.remove("articulos__filtro");
    });
    imgDefecto();
    document.getElementById('desc_modal_from').setAttribute("action","agregar.php");
    document.getElementById('btn__guardar').setAttribute("value","Guardar");
    document.getElementById('btn__subir').classList.remove("articulos__filtro");
    document.getElementById('modal__input__codigo').removeAttribute("readonly");
}
/*funcion para editar*/
function editar(elemento){
    document.getElementById('pregunta').innerHTML="";
    var labels= document.querySelectorAll('.label');
    labels.forEach(function(label){
        label.classList.remove("articulos__filtro");
    });
    var codigo=((elemento.parentNode).parentNode).getAttribute("id");
    document.getElementById('desc_modal_from').setAttribute("action","editar.php");
    document.getElementById('btn__guardar').setAttribute("value","Guardar Cambios");
    document.getElementById('btn__subir').classList.add("articulos__filtro");
    document.getElementById('modal__input__codigo').setAttribute("readonly","");
    $.post('./busqueda.php',{cod:codigo},
        function(datos, estado){
            cargarProducto(datos);
            //console.log(estado);
        }
        );
}
function eliminar(elemento){
    document.getElementById('pregunta').innerHTML="";
    document.getElementById('btn__subir').classList.add("articulos__filtro");
    document.getElementById('btn__guardar').setAttribute("value","Eliminar");

    var labels= document.querySelectorAll('.label');
    labels.forEach(function(label){
        label.classList.add("articulos__filtro");
    });

    var inputs= document.querySelectorAll('.input');
    inputs.forEach(function(input){
        input.setAttribute("required","");
    });
    
    var codigo=((elemento.parentNode).parentNode).getAttribute("id");
    document.getElementById('desc_modal_from').setAttribute("action","eliminar.php");
    $.post('./busqueda.php',{cod:codigo},
    function(datos, estado){
        cargarProducto2(datos);
        //console.log(estado);
    }
    );
}
/*Funcion para mostrar el productos a seleccionar*/
function cargarProducto(datos){
    /*Convertimos el JSON en un Objeto JS*/
    let prod=JSON.parse(datos);
    /*cargamos la informacion*/
    document.getElementById('modal__img').src="img/"+prod["img"];
    document.getElementById('modal__input__codigo').setAttribute("value",prod["codigo"]);
    document.getElementById('modal__input__nombre').setAttribute("value",prod["nombre"]);
    document.getElementById('modal__input__categoria').setAttribute("value",prod["categoria"]);
    document.getElementById('modal__input__descripcion').setAttribute("value",prod["descripcion"]);
    document.getElementById('modal__input__existencia').setAttribute("value",prod["existencias"]);
    document.getElementById('modal__input__precio').setAttribute("value",prod["precio"]);
}
function cargarProducto2(datos){
    /*Convertimos el JSON en un Objeto JS*/
    let prod=JSON.parse(datos);
    /*cargamos la informacion*/
    document.getElementById('modal__img').src="img/"+prod["img"];
    document.getElementById('modal__input__codigo').setAttribute("value",prod["codigo"]);
    document.getElementById('modal__input__nombre').setAttribute("value",prod["nombre"]);
    document.getElementById('modal__input__categoria').setAttribute("value",prod["categoria"]);
    document.getElementById('modal__input__descripcion').setAttribute("value",prod["descripcion"]);
    document.getElementById('modal__input__existencia').setAttribute("value",prod["existencias"]);
    document.getElementById('modal__input__precio').setAttribute("value",prod["precio"]);
    document.getElementById('pregunta').innerHTML="Esta seguro de eliminar el poducto \" "+prod["nombre"]+" \"?";
}

/* Cargar imagen*/
function imgDefecto(){
    document.getElementById('modal__img').src="img/subir_img.jpg";
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