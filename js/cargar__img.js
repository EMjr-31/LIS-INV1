document.getElementById('btn__subir').onchange=function(e){
    let archivo= new FileReader();
    archivo.readAsDataURL(e.target.files[0]);
    archivo.onload=function(){
        document.getElementById('modal__img').src=archivo.result;
        console.log(archivo.result);
    }
}