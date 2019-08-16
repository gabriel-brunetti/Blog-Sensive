<?php
    if ($_POST) {
        // Tente fazer a operação, se der errado capture o erro do PDO !!! (try e catch)
        try {
            require 'req/conexao.php';
            // Fazendo a seleção da queery no banco de dados ! $conexao = caminho do banco!!!
            $select = $conexao->prepare("SELECT * FROM escritores WHERE email = :emailPost AND senha = :senhaPost");
            // EXECUTAR A SELEÇÂO e atribuir valor ao :emailPost e :senhaPost
            $select->execute([
                ':emailPost' => $_POST["email"],
                ':senhaPost' => $_POST["senha"]
            ]);

            // FUNÇÃO FETCH PARA PEGAR OS DADOS DO MYSQL E TRAZER AO PHP; criar em array associativo
            $escritor = $select->fetch(PDO::FETCH_ASSOC);
            $conexao = null;

            if($escritor) {
                session_start();
                $_SESSION["escritorLogado"] = $escritor;
                
                header("Location: inserir.php");
            }
        } catch (PDOException $erro) {
            echo $erro->getMessage();
        }
    }

    include 'layouts/head.php';
    include 'layouts/header.php';

?>
    <div class="container d-flex justify-content-center align-items-center" style="height: 90vh">
        <div class="col-8 border rounded p-4" style="background-color: #f8f8f8">
            <form action="" method="post">
                <div class="form-group">
                    <label for="emailInput">E-mail</label>
                    <input id="emailInput" name="email" type="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="senhaInput">Senha</label>
                    <input id="senhaInput" name="senha" type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-secondary mt-3 col-12">Entrar</button>
            </form>    
        </div>
    </div>
<?
    include 'layouts/footer.php'
    include 'layouts/footer.php'
?>