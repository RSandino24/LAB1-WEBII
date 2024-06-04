<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Pagos</title>
    <link rel="stylesheet" href="style.css">
</head>



<body>
<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $deudor = $_POST['deudor'];
    $cuota = $_POST['cuota'];
    $cuota_capital = $_POST['cuota_capital'];
    $fecha_pago = $_POST['fecha_pago'];

    $sql = "INSERT INTO pagos (deudor, cuota, cuota_capital, fecha_pago) VALUES (:deudor, :cuota, :cuota_capital, :fecha_pago)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':deudor', $deudor);
    $stmt->bindParam(':cuota', $cuota);
    $stmt->bindParam(':cuota_capital', $cuota_capital);
    $stmt->bindParam(':fecha_pago', $fecha_pago);

    if ($stmt->execute()) {
        echo "<script>limpiarCampos();</script>";
    } else {
        echo "Error: No se pudo insertar el registro";
    }
}



$sql = "SELECT * FROM pagos";
$stmt = $db->query($sql);
$pagos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
<div class="titulo-container">
        <h1>Registro de Pagos</h1>
    </div>

    <h2>Ingresar nuevo pago</h2>
    <form method="POST" action="">
        <div class="form-group">
            <label for="deudor">Deudor:</label><br>
            <input type="text" id="deudor" name="deudor" required><br>
        </div>
        
        <div class="form-group">
            <label for="cuota">Número de Cuota:</label><br>
            <input type="number" id="cuota" name="cuota" required><br>
        </div>
        
        <div class="form-group">
            <label for="cuota_capital">Monto de Cuota:</label><br>
            <input type="number" step="0.01" id="cuota_capital" name="cuota_capital" required><br>
        </div>
        
        <div class="form-group">
            <label for="fecha_pago">Fecha de pago:</label><br>
            <input type="date" id="fecha_pago" name="fecha_pago" required><br><br>
        </div>
        
        <input type="submit" value="Registrar Pago" class="green-button">
    </form>
</div>

<h2>Lista de pagos</h2>
<table pagos="1">
    <tr>
        <th>ID</th>
        <th>Deudor</th>
        <th>Número de cuota</th>
        <th>Monto de la cuota</th>
        <th>Fecha de pago</th>
    </tr>
    <?php
    if (count($pagos) > 0) {
        foreach ($pagos as $pago) {
            echo "<tr>
                    <td>{$pago['id']}</td>
                    <td>{$pago['deudor']}</td>
                    <td>{$pago['cuota']}</td>
                    <td>{$pago['cuota_capital']}</td>
                    <td>{$pago['fecha_pago']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No hay registros</td></tr>";
    }
    ?>
</table>

<script>
    function limpiarCampos() {
        document.getElementById("deudor").value = "";
        document.getElementById("cuota").value = "";
        document.getElementById("cuota_capital").value = "";
        document.getElementById("fecha_pago").value = "";
    }
</script>

</body>
</html>








