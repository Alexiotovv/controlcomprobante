function LimpiarForm(){
    $("#id_comprobante").val('');
    $("#numero_comprobante").val('');
    $("#fecha").val('');
    $("#nombre").val('');
    $("#importe").val('');
    $("#numero_siaf").val('');
    $("#fuente_fmto").val('');
    $("#folios").val('');
    $("#estante").val('');
    $("#paquete").val('');
    $("#modalBuscarComprobante").modal('hide');
}



$(document).on("click",".btnSeleccionar",function (e) {
    e.preventDefault();
    fila = $(this).closest("tr");
    id= (fila).find('td:eq(0)').text();
    $("#id_comprobante").val((fila).find('td:eq(0)').text());
    $("#numero_comprobante").val((fila).find('td:eq(2)').text());
    $("#fecha").val((fila).find('td:eq(3)').text());
    $("#nombre").val((fila).find('td:eq(4)').text());
    $("#importe").val((fila).find('td:eq(5)').text());
    $("#numero_siaf").val((fila).find('td:eq(6)').text());
    $("#fuente_fmto").val((fila).find('td:eq(7)').text());
    $("#folios").val((fila).find('td:eq(8)').text());
    $("#estante").val((fila).find('td:eq(9)').text());
    $("#paquete").val((fila).find('td:eq(10)').text());
    $("#modalBuscarComprobante").modal('hide');
    $("#div_bloque_guardar").attr('hidden',false);
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
        success: function (response) {
            console.log(response);
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
        }
    });
}

//Abre la ventana de buscar comprobante
$("#btnBuscarComprobante").on("click",function (e) {
    e.preventDefault();
    $("#modalBuscarComprobante").modal('show');
})