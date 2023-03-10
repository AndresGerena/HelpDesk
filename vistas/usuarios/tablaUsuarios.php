
<?php 
    include "../../clases/Conexion.php";
    $con = new Conexion();
    $conexion = $con->conectar();
    $sql = "SELECT 
                usuarios.id_usuario as idUsuario,
                usuarios.usuario nombreUsuario,
                roles.nombre as rol,
                usuarios.id_rol as idRol,
                usuarios.ubicacion as ubicacion,
                usuarios.activo as estatus,
                usuarios.id_persona as idPersona,
                persona.nombre as nombrePersona,
                persona.paterno as paterno,
                persona.materno as materno,
                persona.fecha_nacimiento as fechaNacimiento,
                persona.sexo as sexo,
                persona.correo as correo,
                persona.telefono as telefono
            FROM
                t_usuarios AS usuarios
                    INNER JOIN
                t_cat_roles AS roles ON usuarios.id_rol = roles.id_rol
                    INNER JOIN
                t_persona AS persona ON usuarios.id_persona = persona.id_persona;";
    $respuesta = mysqli_query($conexion, $sql);            
?>

<table class="table table-sm dt-responsive nowrap" 
        id="tablaUsuariosDataTable" style="width:100%">
    <thead>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Nombre</th>
        <th>Edad</th>
        <th>Telefono</th>
        <th>Correo</th>
        <th>Usuario</th>
        <th>Ubicacion</th>
        <th>Sexo</th>
        <th>Reset Password</th>
        <th>Activar</th>
        <th>Editar</th>
        <th>Eliminar</th>
    </thead>
    <tbody>
        <?php 
            while($mostrar = mysqli_fetch_array($respuesta)) {
        ?>
        <tr>
            <td><?php echo $mostrar['paterno']; ?></td>
            <td><?php echo $mostrar['materno']; ?></td>
            <td><?php echo $mostrar['nombrePersona']; ?></td>
            <td><?php echo $mostrar['fechaNacimiento']; ?></td>
            <td><?php echo $mostrar['telefono']; ?></td>
            <td><?php echo $mostrar['correo']; ?></td>
            <td><?php echo $mostrar['nombreUsuario']; ?></td>
            <td><?php echo $mostrar['ubicacion']; ?></td>
            <td><?php echo $mostrar['sexo']; ?></td>}
            <td>
                <button class="btn btn-success btn-sm">
                    Cambiar Password
                </button>
            </td>
            <td>
                <?php if ($mostrar['estatus'] == 1) { 
                ?>                
                <button class="btn btn-info btn-sm">
                    Activo
                </button>
                <?php
                    } else { 
                ?>
                <button class="btn btn-info btn-sm">
                    Inactivo
                </button>
                <?php
                    } 
                ?>
            </td>
            <td>
                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalActualizarUsuarios"
                        onclick="obtenerDatosUsuario(<?php echo $mostrar['idUsuario'] ?>)">
                    Editar            
                </button>
            </td>
            <td>
                <button  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminas">
                    Eliminar
                </button>
            </td>
        </tr> 
        <?php } ?>           
    </tbody>
</table>

<script>
    $(document).ready(function(){
        $('#tablaUsuariosDataTable').DataTable();
    });
</script>