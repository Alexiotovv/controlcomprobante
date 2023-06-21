$(document).on("click",".btnEditarComprobante",function (e){
    e.preventDefault();
    fila = $(this).closest("tr");
    id= (fila).find('td:eq(0)').text();
    
    $("#idComprobante").val(id);
    $.ajax({
        type: "GET",
        url: "/comprobantes/edit/"+id,
        dataType: "json",
        success: function (response) {
            
            $("#numero").val(response[0].numero);
            $("#nombre").val(response[0].nombre);
            $("#importe").val(response[0].importe);
            $("#fecha").val(response[0].fecha);
            $("#siaf").val(response[0].siaf);
            $("#fuentefto").val(response[0].fuentefto);
            $("#folios").val(response[0].folios);
            $("#estante").val(response[0].estante);
            $("#paquete").val(response[0].paquete);
        }
    });
    $("#modalEditarComprobante").modal('show');

});

$("#btnActualizarComprobante").on("click",function (e) {
    num=$("#numero").val();
    nom=$("#nombre").val();
    importe=$("#importe").val();
    siaf=$("#siaf").val();
    if (num.trim()=='' || nom.trim()=='' || importe.trim()=='' || siaf.trim()=='') {
        //no hace nada
    }else{
        e.preventDefault()
        ds=$("#frmEditComprobante").serialize();
        ru="/comprobantes/update";
        mje="Comprobante Actualizado";
        dt="";
        GuardarRegistro(ds,ru,mje,dt);
        setTimeout(function () { 
            $("#modalEditarComprobante").modal('hide');
         },2500)
    }
    
});

$("#btnFiltrarComprobantes").on("click",function (e) {
    e.preventDefault();
    if ($("#numero_comprobante").val().trim()==''&&$("#nombre_comprobante").val().trim()==''&&$("#estante_comprobante").val().trim()==''&&$("#paquete_comprobante").val().trim()=='') {
        round_warning_noti("Ingrese por lo menos un filtro");
    }else{
        numero_comprobante=asignarGuion($("#numero_comprobante").val().trim());
        nombre_comprobante=asignarGuion($("#nombre_comprobante").val().trim());
        estante_comprobante=asignarGuion($("#estante_comprobante").val().trim());
        paquete_comprobante=asignarGuion($("#paquete_comprobante").val().trim());

        if (numero_comprobante.trim()=='') {
            numero_comprobante='-';
        }
        if (nombre_comprobante.trim()=='') {
            nombre_comprobante='-';
        }
        if (estante_comprobante.trim()=='') {
            estante_comprobante='-';
        }
        if (paquete_comprobante.trim()=='') {
            paquete_comprobante='-';
        }

        

        $.ajax({
            type: "GET",
            url: "/comprobantes/filtrar/"+numero_comprobante+"/"+nombre_comprobante+"/"+estante_comprobante+"/"+paquete_comprobante,
            dataType: "json",
            beforeSend:function () { 
                $("#spinner_filtrar_comprobantes").prop('hidden',false);
            },
            success: function (response) {
                console.log(response);        
                $("#DTComprobantes tbody").html("");
                response.forEach(element => {
                    $("#DTComprobantes").append('<tr>'+
                    '<td>'+ element.id+'</td>'+
                    '<td><button class="btn btn-warning btn-sm btnEditarComprobante"><li class="bx bx-pencil"></li></button></td>'+
                    '<td>'+ element.numero+'</td>'+
                    '<td>'+ element.fecha+'</td>'+
                    '<td>'+ element.nombre+'</td>'+
                    '<td>'+ element.importe+'</td>'+
                    '<td>'+ element.siaf+'</td>'+
                    '<td>'+ element.fuentefto+'</td>'+
                    '<td>'+ element.folios+'</td>'+
                    '<td>'+ element.estante+'</td>'+
                    '<td>'+ element.paquete+'</td>'+
                    '</tr>')
                });
                $("#spinner_filtrar_comprobantes").prop('hidden',true);
            },
            error: function (repsonse) {
                // round_error_noti("Error al intentar recuperar info");
                $("#spinner_filtrar_comprobantes").prop('hidden',true);
            }
        });
    }
})

function asignarGuion(valor) {
    if (valor==''){
        return '-';
    }else{
        return valor;
    }
}

$("#btnGuardarComprobante").on("click",function (e) {
    num=$("#numero").val();
    nom=$("#nombre").val();
    importe=$("#importe").val();
    siaf=$("#siaf").val();
    if (num.trim()=='' || nom.trim()=='' || importe.trim()=='' || siaf.trim()=='') {
        //no hace nada
    }else{
        e.preventDefault()
        ds=$("#frmComprobante").serialize();
        ru="/comprobantes/store";
        mje="Comprobante Guardado";
        dt="";
        GuardarRegistro(ds,ru,mje,dt);
        
    }
    
});


function LimpiarForm() { 
    $("#numero").val('');
    $("#nombre").val('');
    $("#importe").val('');
    $("#siaf").val('');
    $("#fuentefto").val('');
    $("#folios").val('');
    $("#estante").val('');
    $("#paquete").val('');
 }