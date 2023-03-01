function in_dec_cant(elemento){
    const btn=elemento;
    var operador=btn.innerHTML;
    const inputcant=document.getElementById('modal_cantidad');
    var valor_actual=parseInt(inputcant.value);
    var valor_maximo=parseInt(inputcant.getAttribute('max'));
    if(valor_actual>0 && valor_actual<=valor_maximo){
        if(operador=='+'){
            valor_actual++;
            if(valor_actual>valor_maximo)valor_actual=valor_maximo;
        }
        if(operador=='-'){
            valor_actual--;
            if(valor_actual==0)valor_actual=1;
        }
        inputcant.value=valor_actual;
    }
}
function cambio_cant(elemento){
    const input=elemento;
    var valor_actual=parseInt(input.value);
    var valor_maximo=parseInt(input.getAttribute('max'));
    if(valor_actual<=0){
        input.value=1;
    }
    if(valor_actual>valor_maximo){
        input.value=valor_maximo;
    }

}