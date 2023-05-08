$("#btnGuardarCliente").on("click",function (e) {
    nom=$("#nombre").val();
    if (nom.trim()=='') {
        //
    }else{
        e.preventDefault()
        ds=$("#frmCliente").serialize();
        ru="/clientes/store/";
        mje="Cliente Registrado";
        dt="";
        GuardarRegistro(ds,ru,mje,dt);
        
    }
})

//esta funcion es llamada desde crud
function LimpiarForm() { 
    $("#nombre").val('');
 }