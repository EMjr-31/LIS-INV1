/*elemento ventana modal*/
const modal_c= document.getElementById('modal__contenedor__carrito');
/*Funcion que se ejecuta al seleccionar un producto y realiza la busqueda de dicho producto*/
function abrir_carrito(){
    desabilitarScroll();
    let modalStyle = window.getComputedStyle(modal_c);
    if( modalStyle.getPropertyValue('display')=="none"){
        modal_c.style.display='flex';
    }
}

/*Funcion para cerrar la cerrar la ventana moval y evitar el recargar la pagina*/
document.getElementById('btn__cerrar__carrito').addEventListener("click", function(event){
    event.preventDefault();
    modal_c.style.display='none'; 
    habilitarScroll();
});