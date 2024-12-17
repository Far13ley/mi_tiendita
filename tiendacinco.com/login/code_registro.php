<?php
require_once('../conection/cnx.php');

$username = $email = $password = "";
$username_err = $email_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validando nombre de usuario
    if (empty(trim($_POST["username"]))) {
        $username_err = "Por favor ingrese un nombre de usuario";
    } else {
        // Preparando una declaración de selección
        $sql = "SELECT id FROM usuarios WHERE usuario=?";
        if ($stmt = mysqli_prepare($cnx, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Este nombre de usuario ya existe";
                } else {
                    $username = trim($_POST["username"]);
                }
            }
        }
    }

    // Validando email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Por favor ingrese un correo";
    } else {
        // Preparando una declaración de selección
        $sql = "SELECT id FROM usuarios WHERE email=?";
        if ($stmt = mysqli_prepare($cnx, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST["email"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "Este correo de usuario ya existe";
                } else {
                    $email = trim($_POST["email"]);
                }
            }
        }
    }

    // Validando contraseña
    if (empty(trim($_POST["password"]))) {
        $password_err = "Por favor ingrese una contraseña";
    } elseif (strlen(trim($_POST["password"])) < 4) {
        $password_err = "La contraseña debe tener al menos cuatro caracteres";
    } else {
        $password = trim($_POST["password"]);
    }

    // Comprobar errores de entrada antes de insertar en la base
    if (empty($username_err) && empty($email_err) && empty($password_err)) {
        $sql = "INSERT INTO usuarios (usuario, email, clave) VALUES (?,?,?)";
        if ($stmt = mysqli_prepare($cnx, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_email, $param_password);

            // Estableciendo parámetros
            $param_username = $username;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Encriptando

            if (mysqli_stmt_execute($stmt)) {
                header("location: inicio.php");
            } else {
                echo "Algo salió mal";
            }
        }
    }
    mysqli_close($cnx);
}
?>
