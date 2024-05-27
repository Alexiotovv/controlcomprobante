//Variable Globales
 var cant_registros=0

function llenarDTComprobantesSeleccionado(data) {
    //Poner en la tabla
    $("#DTComprobantesSeleccionado tbody").html("");
    data.forEach(element => {
        cant_registros+=1

        $("#DTComprobantesSeleccionado").append('<tr>'+
            '<td>'+ element.id +'</td>'+
            '<td>'+ element.id_comprobante +'</td>'+
            '<td>'+
                '<a class="btn btn-danger btn-sm btnEliminarRegistroTemp ><i class="lni lni-pencil-alt">x</i></a>'+
            '</td>'+
            '<td>'+ element.numerocomprobante +'</td>'+
            '<td>'+ element.fecha +'</td>'+
            '<td>'+ element.nombreempresa +'</td>'+
            '<td>'+ element.importe +'</td>'+
            '<td>'+ element.siaf +'</td>'+
            '<td>'+ element.ftefto +'</td>'+
            '<td>'+ element.folio +'</td>'+
            '<td>'+ element.estante +'</td>'+
            '<td>'+ element.paquete +'</td>'+
            
        '</tr>');        
        
    });
}    



$("#btnActualizasSalidaComprobante").on("click",function (e) {
    e.preventDefault();
    ds=$("#frmEditSalidaComprobante").serialize();
    ru="/salidacomprobantes/update";
    mje="Salida de Comprobante Actualizado";
    dt="";
    GuardarRegistro(ds,ru,mje,dt);
    setTimeout(function () { 
        $("#modalEditarSalidaComprobante").modal('hide');
    },2500)
         
})
$(document).on("click",".btnEditarSalidaComprobante",function (e) { 
    e.preventDefault();
    fila = $(this).closest("tr");
    id= (fila).find('td:eq(0)').text();
    $("#idSalidaComprobante").val(id);
    $.ajax({
        type: "GET",
        url: "/salidacomprobantes/edit/"+id,
        dataType: "json",
        success: function (response) {
            $("#nro_cargo").val(response.numero_cargo);
            $("#nro_oficio").val(response.numero_oficio);
            $("#cant_folios").val(response.folios);
            $("#fecha_salida").val(response.fecha_salida);
            $("#hora_salida").val(response.hora_salida);
        }
    });
    $("#modalEditarSalidaComprobante").modal('show');

 })

obtenerclientes();

// $("#numero_cargo").on("keyup",function(){
//     BuscarSalidasComprobantes();
// })
// $("#numero_comp").on("keyup",function(){
//     BuscarSalidasComprobantes();
// })
// $("#numero_oficio").on("keyup",function(){
//     BuscarSalidasComprobantes();
// })
// $("#institucion").on("change",function(){
//     BuscarSalidasComprobantes();
// })


function BuscarSalidasComprobantes(){
    numero_cargo=$("#numero_cargo").val();
    numero_comp=$("#numero_comp").val();
    numero_oficio=$("#numero_oficio").val();
    institucion=$("#institucion").val();
    
    if (institucion=='-') {
        alert("Seleccione una institución para buscar")
        return false
    }
    
    if (numero_cargo.trim()=='') {
        numero_cargo='-';
    }
    if (numero_comp.trim()=='') {
        numero_comp='-';
    }
    if (numero_oficio.trim()=='') {
        numero_oficio='-';
    }
    
    
    $.ajax({
        type: "GET",
        url: "/salidacomprobantes/show/"+numero_cargo+"/"+numero_comp+"/"+numero_oficio+"/"+institucion,
        dataType: "json",
        beforeSend: function () { 
            $("#spinner_buscar_salida").prop('hidden',false);
        },
        success: function (response) {
            $("#DTSalidasComprobantes tbody").html("");
            
            response.forEach(element => {
                if (element.salida) {
                    codigo='<btn class="btn btn-danger btn-sm">Abierto</btn>';
                    estado="";
                }else{
                    estado="disabled";
                    codigo='<btn class="btn btn-success btn-sm">Cerrado</btn>';
                }
                // console.log(codigo);
                $("#DTSalidasComprobantes").append('<tr>'+
                '<td>'+ element.id +'</td>'+
                '<td><a class="btn btn-warning btn-sm btnEditarSalidaComprobante ' + estado +'"><li class="bx bx-pencil"></li></a>'+
                '<a class="btn btn-info btn-sm btnmodalDevolucion '+ estado + '" ><li class="bx bx-window-close"></li></a>'+
                '</td>'+
                '<td>'+ element.numero +'</td>'+
                '<td>'+ element.numero_cargo +'</td>'+
                '<td>'+ element.numero_oficio +'</td>'+
                '<td>'+ element.folios +'</td>'+
                '<td>'+ element.fecha_salida +'</td>'+
                '<td>'+ element.hora_salida +'</td>'+
                '<td>'+ codigo +'</td>'+
                '<td>'+ element.usuariosalida +'</td>'+
                '<td>'+ element.fecha_devolucion +'</td>'+
                '<td>'+ element.hora_devolucion +'</td>'+
                '<td>'+ element.usuariodevolucion +'</td>'+
                
                '</tr>');
            });
            $("#spinner_buscar_salida").prop('hidden',true);
        }
    });
}


$("#btnGuardarSalida").on("click",function (e) {
    e.preventDefault()
    ofi=$("#nro_oficio").val();
    fol=$("#cant_folios").val();

    if (cant_registros>0) {
        if (ofi.trim()!=='' || fol.trim()!=='') {
            //Muestra que debe llenar los campos el html
            e.preventDefault()
            ds=$("#frmSalidaComprobante").serialize();
            ru="/salidacomprobantes/store"
            mje="Registro Guardado"
            dt="DTComprobantesSeleccionado"

            GuardarRegistroSalida(ds,ru,mje,dt)
            //Limpiar Form se encuentra el funcion GuardarRegistro
        }else{
            alert("Complete los campos para guardar");    
        }
    }else{
        alert("Debe Seleccionar al menos un comprobante");
    }

})


$("#btnGuardarInstitucion").on("click",function (e) { 
    e.preventDefault();
    
    ds=$("#frmAgregarInstitucion").serialize();
    ru="/clientes/store"
    mje="Institución Registrada"
    GuardarRegistroRapido(ds,ru,mje)
    $("#modalAgregarInstitucion").modal('hide');
    $("#cliente").empty();
    $.ajax({
        type: "GET",
        url: "/clientes/show/",
        dataType: "json",
        success: function (response) {
            response.forEach(element => {
                console.log(element.nombre);
                $("#cliente").append(
                    '<option selected value='+ element.id +'>'+ element.nombre +'</option>');    
            });
            
        }
    });
    $("#nombreInstitucion").val('');

 })

function obtenerclientes() {
    $("#cliente").empty();
    $.ajax({
        type: "GET",
        url: "/clientes/show/",
        dataType: "json",
        success: function (response) {
            response.forEach(element => {
                $("#cliente").append(
                    '<option value='+ element.id +'>'+ element.nombre +'</option>').change();    
            });
            
        }
    });
 }

$("#btnAgregarInstitucion").on("click",function (e) { 
    e.preventDefault();
    $("#modalAgregarInstitucion").modal('show');
 })


$(document).ready(function() {
    $.ajax({
        type: "GET",
        url: "/tempcomprobante/show",
        dataType: "json",
        success: function (response) {
            
            llenarDTComprobantesSeleccionado(response.data)
        }
    });
    
});

$(document).on('click','.btnEliminarRegistroTemp',function(e){
    e.preventDefault();
    fila = $(this).closest("tr");
    id= (fila).find('td:eq(0)').text();
    $.ajax({
        type: "GET",
        url: "/tempcomprobante/destroy/"+id,
        dataType: "json",
        success: function (response) {
            cant_registros-=1
            llenarDTComprobantesSeleccionado(response.data)   
        }
    });
});


$(document).on("click",".btnSeleccionar",function (e) {
    // e.preventDefault();
    fila = $(this).closest("tr");
    id= (fila).find('td:eq(0)').text();

    //insertando en tabla temporal
    $.ajax({
        type: "GET",
        url: "/tempcomprobante/store/"+id,
        dataType: "json",
        statusCode: {
            409: function(data) {
               alert("Ya se agregó este comprobante");
            },
            200: function(data) {
                cant_registros+=1
                llenarDTComprobantesSeleccionado(data.data)   
             },
        } 
    });

    

    


})

$("#modal_nrocomprobante").on("keyup",function (){
    buscaComprobante();
})

$("#modal_nombreempresa").on("keyup",function (){
    buscaComprobante();
})
function buscaComprobante(){
    nrocomp=$("#modal_nrocomprobante").val();
    nomemp=$("#modal_nombreempresa").val();

    if (nrocomp.trim()=='') { 
        nrocomp='-';
    } 
    if (nomemp.trim()=='') { 
        nomemp='-';
    }

    $.ajax({
        type: "GET",
        url: "/comprobantes/show/"+nrocomp+"/"+nomemp,
        dataType: "json",
        beforeSend:function () { 
            $("#spinner_buscar_comprobante").prop('hidden',false)
        },
        success: function (response) {
            $("#modalBuscarComprobante tbody").html("");
            response.forEach(element => {
                $("#modal_DTComprobante").append('<tr>'+
                '<td>'+element.id+'</td>'+
                '<td><button class="btn btn-warning btn-sm btnSeleccionar"><i class="bx bx-plus"></i></button></td>'+
                '<td>'+element.numero+'</td>'+
                '<td>'+element.fecha+'</td>'+
                '<td>'+element.nombre+'</td>'+
                '<td>'+element.importe+'</td>'+
                '<td>'+element.siaf+'</td>'+
                '<td>'+element.fuentefto+'</td>'+
                '<td>'+element.folios+'</td>'+
                '<td>'+element.estante+'</td>'+
                '<td>'+element.paquete+'</td>'+
                '</tr>');
            });
            $("#spinner_buscar_comprobante").prop('hidden',true)
        }
    });
}

//Abre la ventana de buscar comprobante
$("#btnBuscarComprobante").on("click",function (e) {
    e.preventDefault();
    $("#modalBuscarComprobante").modal('show');
})
function LimpiarForm(){
    $("#nro_cargo").val("");
    $("#nro_oficio").val("");
    $("#cant_folios").val("");
    cant_registros=0;
}