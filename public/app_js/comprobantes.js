

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

        $.ajax({
            type: "GET",
            url: "/comprobantes/filtrar/"+numero_comprobante+"/"+nombre_comprobante+"/"+estante_comprobante+"/"+paquete_comprobante,
            dataType: "json",
            beforeSend:function () { 
                $("#spinner_filtrar_comprobantes").prop('hidden',false);
            },
            success: function (response) {
                    
                $("#DTComprobantes tbody").html("");
                    response['comprobantes'].forEach(element => {
                    $("#DTComprobantes").append('<tr>'+
                    '<td>'+ element.id+'</td>'+
                    '<td><button class="btn btn-warning btn-sm btnEditarComprobante"><li class="bx bx-pencil"></li></button></td>'+
                    '<td>'+ element.nombrearchivo+'</td>'+
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
    fuentefto=$("#fuentefto").val();
    folios=$("#folios").val();
    paquete=$("#paquete").val();
    if (num.trim()=='' || nom.trim()=='' || importe.trim()=='' || siaf.trim()==''||fuentefto.trim()==''||folios.trim()==''||paquete.trim()=='') {
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