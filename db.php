<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=db_registroPagos;charset=utf8', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}
?>

