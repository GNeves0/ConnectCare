<?php
    include('conexao.php');

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["nome_completo"])) {
        $nome = $_GET["nome_completo"];
        $rg = $_GET["rg"];
        $cpf = $_GET["cpf"];
        $telefone = $_GET["telefone"];
        $cep = $_GET["cep"];
        $email = $_GET["email"];
        $formacao = $_GET["formacao_academica"];
        $grau_escolar = $_GET["grau_de_escolaridade"];
        $foto_do_documento = isset($_POST["foto_do_documento"]) ? $_POST["foto_do_documento"] : null;
        $comprovante_de_residencia = isset($_POST["comprovante_de_residencia"]) ? $_POST["comprovante_de_residencia"] : null;
        $data_nasc = $_GET["data_de_nascimento"];


        $stmt = $conn->prepare("INSERT INTO `connectcare`.`usuario` (nome_completo, rg, cpf, telefone, cep, email, formacao_academica,
         foto_do_documento, grau_de_escolaridade, comprovante_de_residencia, data_de_nascimento, id_tipousuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '2')");
        $stmt->bind_param("sssssssssss", $nome, $rg, $cpf, $telefone, $cep, $email, $formacao, $foto, $grau_escolar, $comprovante, $data_nasc);
    
        if ($stmt->execute()) {
            include('mensagem.html');
        } else {
            include('telacadastrodois.html');
            echo "Erro ao inserir registro: " . $stmt->error;
        }
    
        $stmt->close();
    }
    
    $conn->close();
?>
