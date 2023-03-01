const d=document;
function filtrobuscar(value){
    //console.log(value);
    d.querySelectorAll(".filtro").forEach(
        texto=>(texto.textContent.toLowerCase().includes(value.toLowerCase()))
        ?(texto.parentNode).classList.remove("articulos__filtro")
        :(texto.parentNode).classList.add("articulos__filtro")
    );
}