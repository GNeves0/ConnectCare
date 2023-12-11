<?php
session_start();
include("conexao.php");

$email = $_GET["email"];
$cpf = $_GET["cpf"];

// Consulta para verificar o tipo de usuário
$sql_tipo_usuario = "SELECT id_tipousuario FROM usuario WHERE email = ?";
$stmt_tipo_usuario = $conn->prepare($sql_tipo_usuario);
$stmt_tipo_usuario->bind_param("s", $email);
$stmt_tipo_usuario->execute();
$stmt_tipo_usuario->bind_result($id_tipousuario);
$stmt_tipo_usuario->fetch();
$stmt_tipo_usuario->close();

// Consulta para obter o CPF associado ao e-mail
$sql_cpf = "SELECT cpf FROM usuario WHERE email = ?";
$stmt_cpf = $conn->prepare($sql_cpf);
$stmt_cpf->bind_param("s", $email);
$stmt_cpf->execute();
$result_cpf = $stmt_cpf->get_result();

if ($result_cpf->num_rows > 0) {
    $row_cpf = $result_cpf->fetch_assoc();
    $cpfBanco = $row_cpf["cpf"];

    // Verifica se o CPF fornecido corresponde ao CPF no banco de dados
    if ($cpf == $cpfBanco) {
        // Redireciona com base no tipo de usuário
        if ($id_tipousuario == 1) {
            // Usuário tipo 1, redireciona para a tela 1
            header("Location: principal.html");
            exit();
        } elseif ($id_tipousuario == 2) {
            // Usuário tipo 2, redireciona para a tela 2
            header("Location: principaldois.html");
            exit();
        } else {
            // Tipo de usuário desconhecido, redireciona para uma página de erro
            header("Location: erro.php");
            exit();
        }
    } else {
        include('telalogin.html');
        echo "<script>alert('E-mail ou senha incorretos.');</script>";
    }
} else {
    include('telalogin.html');
    echo "<script>alert('E-mail não encontrado.');</script>";
}

// Fecha as declarações e a conexão
$stmt_cpf->close();
$conn->close();
?>