
$(document).ready(function(){
    $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
});

function agregarNuevoUsuario(){

    $.ajax({
        type: "POST",
        data: $('#frmAgregarUsuario').serialize(),
        url: "../procesos/usuarios/agregarNuevoUsuario.php",
        success:function(respuesta) {
            respuesta = respuesta.trim();
            if (respuesta == 1){
                $('#tablaUsuariosLoad').load("usuarios/tablaUsuarios.php");
                $('#frmAgregarUsuario')[0].reset();
                Swal.fire(":D","Agregado con Exito!","success");
            }else {
                Swal.fire(":(","Error al agregar" + respuesta,"error")
            }
        } 
    });
    
    return false;
}


function obtenerDatosUsuarios(idUsuario) {
    $.ajax({
        type: "POST",
        data: "idUsuario" + idUsuario,
        url: "../procesos/usuarios/obtenerDatosUsuarios.php",
        success:function(respuesta) {
            respuesta = jQuery.parseJSON(respuesta);
            console.log(respuesta);
        }
    });
}