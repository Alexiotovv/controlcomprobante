
////LA FUNCIÓN PARA GUARDAR O ACTUALIZAR REGISTRO
function GuardarRegistro(ds,ru,mje){

    $.ajax({
        type: "POST",
        url: ru,
        data: ds,
        dataType: "json",
        success: function (response) {
            Swal.fire(
                {
                position: 'top-end',
                icon: 'success',
                title: mje,
                showConfirmButton: false,
                timer: 1500}
                )
            
        },
        error: function(response) {
            Swal.fire('OPS!', 'Hubo un error!', 'error')
        },
    });
};

///FUNCION ELIMINAR REGISTRO
function EliminarRegistro(ru,mje,dt){
    Swal.fire({
        title: 'Estás seguro?', text: "Confirma para poder eliminar el registro!",
        icon: 'Mensaje', showCancelButton: true, confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33', confirmButtonText: 'Sí, eliminar!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: ru,
                dataType: "json",
                success: function (response) {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: mje,
                        showConfirmButton: false,
                        timer: 1500});
                    $(dt).DataTable().ajax.reload();
                },
                error: function(response) {
                    Swal.fire('OPS!', 'Hubo un error!', 'error');
                },
            });
        }
    })

};

