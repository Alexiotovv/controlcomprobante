$("#btnGuardarDevolucion").on("click",function (e) { 
    e.preventDefault();
    ds=$("#frmDevolucion").serialize();
    ru="/devolucioncomprobantes/store";
    msje="Registro Guardado";
    frm="#modalDevolucion";
    GuardarRegistroDevolucion(ds,ru,msje,frm);
    
})

$(document).on("click",".btnmodalDevolucion",function (e) {
    e.preventDefault();
    fila = $(this).closest("tr");
    id= (fila).find('td:eq(0)').text();
    $("#idSalida").val(id);
    $("#modalDevolucion").modal('show');
    
})

setInterval(muestrahora2, 1000);
function muestrahora2() { 
    var hoy = new Date();
    hora = ('0' + hoy.getHours()).slice(-2) + ':' + ('0' + hoy.getMinutes()).slice(-2);
    document.getElementById("hora_devolucion").value = hora;    
}

var fecha = new Date();
document.getElementById("fecha_devolucion").value = fecha.toJSON().slice(0, 10);