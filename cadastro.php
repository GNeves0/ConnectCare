<?php
include('conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nome_completo"])) {
        $nome = $_GET["nome_completo"];
        $rg = $_GET["rg"];
        $cpf = $_GET["cpf"];
        $telefone = $_GET["telefone"];
        $cep = $_GET["cep"];
        $email = $_GET["email"];
        $data = $_GET["data_de_nascimento"];

        $stmt = $conn->prepare("INSERT INTO `connectcare`.`usuario` (nome_completo, rg, cpf, telefone, cep, email, data_de_nascimento, id_tipousuario) VALUES (?, ?, ?, ?, ?, ?, ?, '1')");
        $stmt->bind_param("sssssss", $nome, $rg, $cpf, $telefone, $cep, $email, $data);

        if ($stmt->execute()) {
            include('mensagem.html');
        } else {
            include('telacadastro.html');
            echo "Erro ao inserir registro: " . $stmt->error;
        }

        $stmt->close();
    }

    $conn->close();
?>
