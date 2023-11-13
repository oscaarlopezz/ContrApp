<?php
session_start();
// Recibir datos del formulario AJAX
$username = "%" . $_POST['username'] . "%";
include_once('../herramientas/conexion.php');
if ($username === '%%') {
    echo "No se han encontrado resultados";
}else{
// Preparar la consulta SQL con una sentencia preparada para evitar inyecciones SQL
$sql = "SELECT username, nombre FROM usuarios WHERE username LIKE ? or nombre LIKE ?";

$stmt = mysqli_prepare($conn, $sql);

// Vincular los parámetros a la sentencia
mysqli_stmt_bind_param($stmt, "ss", $username, $username);

// Ejecutar la sentencia
mysqli_stmt_execute($stmt);

// Obtener el resultado
$resultado = mysqli_stmt_get_result($stmt);


if (mysqli_num_rows($resultado) > 0) {
    while ($row = mysqli_fetch_assoc($resultado)) {
        ?>
        <tr>
            <th><?php echo $row['username']; ?></th>
            <th><?php echo $row['nombre']; ?></th>
            <th>
                <form action="../procesos/proc_enviarSolicitud.php" method="post">
                    <input type="text" style="visibility: hidden;" value="<?php echo $row['username']; ?>" id="user" name="user">
                    <input type="submit" name="btnEnviar" class="boton" id="btnEnviar" value="Enviar">
                    <!-- <script src="../js/validacionAñadir.js"></script> Este script valida el formato y si los campos están vacíos -->
                </form>
            </th>
        </tr>
        <?php
    }
}else {
    echo '<br>';
    echo "No se han encontrado resultados";
}

}