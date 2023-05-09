

//esta funcion es llamada desde crud
function LimpiarForm() { 
    $("#nombre").val('');
 }

 

$("#DTListarClientes").DataTable({
    "destroy":true,
    "ajax":"/clientes/listar",
    "method":"GET",
    "columns":[
        {data:"id"},
        { "defaultContent": "<button class='btn btn-icon btn-outline-warning btnEditarCliente'><i class='fadeIn animated bx bx-pencil'></i></button>"},
        {data:"nombre"},
    ],order:[0],
    buttons:['excel'],
    dom: 'Bfrtip',
  
});

$(document).on("click",".btnEditarCliente",function (e) {
    e.preventDefault();
    fila = $(this).closest("tr");
    id= (fila).find('td:eq(0)').text();
    nombre= (fila).find('td:eq(2)').text();
    $("#idCliente").val(id);
    $("#etiquetaCliente").text('Editar Cliente');
    $("#nombre").val(nombre);
    $("#modalCliente").modal('show');

})



$("#btnGuardarCliente").on("click",function (e) { 
    e.preventDefault();
    ds=$("#frmCliente").serialize();
    dt="#DTListarClientes";
    if ($("#etiquetaCliente").text()=='Editar Cliente') {
        ru="/clientes/update";
        mje="Cliente Actualizado";
    }else{
        ru="/clientes/store";
        mje="Cliente Registrado";
    }
    GuardarRegistro(ds,ru,mje,dt);
    $("#modalCliente").modal('hide');
 })

 $("#btnNuevoCliente").on("click",function (e) {
    e.preventDefault();
    $("#etiquetaCliente").text('Nuevo Cliente');
    $("#nombre").val('');
    $("#modalCliente").modal('show');
 })