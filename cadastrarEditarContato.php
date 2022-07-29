<?php
require_once "load.php";

$editarSim = false;
$nomeIgual = false;

// Verificação Geral
if (isset($_GET['nome'])) {
    if ($_GET['nome'] != "") {
        $verificarNome = $conexao->prepare("SELECT nome FROM contatos WHERE codigo != :codigo");
        $verificarNome->bindParam(':codigo', $_GET['codigo']);
        $verificarNome->execute();
        while ($igualdade = $verificarNome->fetch(PDO::FETCH_ASSOC)) {
            $nomeInserido = strtolower($_GET['nome']);
            $nomeInserido = trim($_GET['nome']);
            //echo "$nomeInserido<br>";

            $nomeBanco = strtolower($igualdade['nome']);
            $nomeBanco = trim($igualdade['nome']);
            //echo "$nomeBanco<br>";

            if ($nomeBanco === $nomeInserido) {
                //echo"Entrou na condicao<br>";
                $nomeIgual = true;
                echo "<div class='alert alert-danger' role='alert'>
                    Erro ao insrir. Esse contato já existe!
                </div>";
            }
        }
    }
}


// Cadastro
if (isset($_GET["cadastrar"]) && $nomeIgual === false) {
    $tituloBotao = "Cadastrar";
    //echo "entrou na condicao<br>";

    if (isset($_GET['nome']) || isset($_GET['email'])) {
        if ($_GET['nome'] != '' && $_GET['email'] != '') {
            $categoria = $_GET['categorias_codigo'];
            $nome = $_GET['nome'];
            $email = $_GET['email'];
            $endereco = $_GET['endereco'];
            $telefone = $_GET['telefone'];
            $celular = $_GET['celular'];
            $cidade = $_GET['cidade'];
            $estado = $_GET['estado'];
            $foto = $_GET['foto'];
            $data_nascimento = $_GET['data_nascimento'];
            $observacoes = $_GET['observacoes'];

            try {
                $inserir = $conexao->prepare("INSERT INTO contatos (categorias_codigo, nome, email, endereco, telefone, celular, cidade, estado,
                                                                        foto, data_nascimento, observacoes) VALUES (:categorias_codigo, :nome, :email, :endereco, :telefone, :celular, 
                                                                                                                    :cidade, :estado, :foto, :data_nascimento, :observacoes)");
                $inserir->bindParam('categorias_codigo', $categoria);
                $inserir->bindParam('nome', $nome);
                $inserir->bindParam('email', $email);
                $inserir->bindParam('endereco', $endereco);
                $inserir->bindParam('telefone', $telefone);
                $inserir->bindParam('celular', $celular);
                $inserir->bindParam('cidade', $cidade);
                $inserir->bindParam('estado', $estado);
                $inserir->bindParam('foto', $foto);
                $inserir->bindParam('data_nascimento', $data_nascimento);
                $inserir->bindParam('observacoes', $observacoes);
                $inserir->execute();
                //echo "Sucesso ao inserir!";
                echo "<div class='alert alert-success' role='alert'>
                    Sucesso ao inserir!
                </div>";
            } catch (PDOException $e) {
                //echo "Erro ao inserir no banco: $e->getMessage()";
                echo "<div class='alert alert-danger' role='alert'>
                    Erro ao inserir no banco de dados!
                </div>" . $e->getMessage();
            }
        } else {
            echo "<script>alert('ERRO! Todos os campos devem ser preenchidos!'); window.history.go(-1)</script>";
            exit;
        }
    }
}

// Edição
if (isset($_GET['editar']) && $nomeIgual === false) {
    /*echo "testando o if da edicao";*/
    $tituloBotao = "Editar";

    if (isset($_GET['codigo'])) {
        /*echo "testando o if do isset do codigo";*/
        $editarSim = true;

        $registro = $conexao->prepare("SELECT * FROM contatos WHERE codigo = :codigo");
        $registro->bindParam("codigo", $_GET['codigo']);
        $registro->execute();
        while ($informacao = $registro->fetch(PDO::FETCH_ASSOC)) {
            $nomeEditar = $informacao['nome'];
            $emailEditar = $informacao['email'];
        }

        if (isset($_GET['nome']) || isset($_GET['email'])) {
            if (isset($_GET['nome']) && $_GET['email'] !== '') {
                $nome = $_GET['nome'];
                $email = $_GET['email'];
                $endereco = $_GET['endereco'];
                $telefone = $_GET['telefone'];
                $celular = $_GET['celular'];
                $cidade = $_GET['cidade'];
                $estado = $_GET['estado'];
                $foto = $_GET['foto'];
                $data_nascimento = $_GET['data_nascimento'];
                $observacoes = $_GET['observacoes'];


                try {
                    $inserir = $conexao->prepare("UPDATE contatos SET nome = :nome, email = :email, endereco = :endereco, telefone = :telefone,
                                                        celular = :celular, cidade = :cidade, estado = :estado, foto = :foto, 
                                                        data_nascimento = :data_nascimento, observacoes = :observacoes WHERE codigo = :codigo");
                    $inserir->bindParam('codigo', $_GET['codigo']);
                    $inserir->bindParam('nome', $nome);
                    $inserir->bindParam('email', $email);
                    $inserir->bindParam('endereco', $endereco);
                    $inserir->bindParam('telefone', $telefone);
                    $inserir->bindParam('celular', $celular);
                    $inserir->bindParam('cidade', $cidade);
                    $inserir->bindParam('estado', $estado);
                    $inserir->bindParam('foto', $foto);
                    $inserir->bindParam('data_nascimento', $data_nascimento);
                    $inserir->bindParam('observacoes', $observacoes);
                    $inserir->execute();
                    //echo "Sucesso ao inserir!";
                    echo "<div class='alert alert-success' role='alert'>
                    Alterado com sucesso!
                </div>";
                } catch (PDOException $e) {
                    //echo "Erro ao inserir no banco: $e->getMessage()";
                    echo "<div class='alert alert-danger' role='alert'>
                    Erro ao alterar no banco de dados! $e->getMessage
                </div>";
                }
            } else {
                echo "<script>alert('ERRO! Todos os campos devem ser preenchidos!'); window.history.go(-1)</script>";
                exit;
            }
        }
    }
}


// Action -> Input Hidden
$parametro = "cadastrar";
if ($editarSim === true) {
    $parametro = 'editar';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistema</title>

    <!-- Custom fonts for this template-->
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="admin/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="principal.php">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-dice-d6"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Sistema</div>
        </a>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <!-- Nav Item - User Information -->
                <div class="nav-item dropdown no-arrow">
                    <div class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Sistema Teste</span>
                    </div>
                </div>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Cadastrar - Contatos</h1>

                <a href="principal.php" class="btn btn-primary btn-icon-split mb-4">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                        </span>
                    <span class="text">Voltar</span>
                </a>

                <div class="container">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Contato</label>
                            <select name="categorias_codigo" class="form-control">
                                <?php
                                $selectContato = $conexao->prepare("SELECT * FROM categorias ORDER BY nome ASC");
                                $selectContato->execute();

                                while ($opcoes = $selectContato->fetch(PDO::FETCH_ASSOC)) {
                                    ?>
                                    <option value="<?= $opcoes['codigo'] ?>"><?= $opcoes['nome'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nome</label>
                            <input <?php if ($editarSim === true) {
                                ?> value="<?= $nomeEditar ?>" <?php
                            } ?> type="text" name="nome" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">E-mail</label>
                            <input <?php if ($editarSim === true) {
                                ?> value="<?= $emailEditar ?>" <?php
                            } ?> type="text" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Endereço</label>
                            <input name="endereco" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Telefone</label>
                            <input name="telefone" type="tel" class="form-control" maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Celular</label>
                            <input name="celular" type="tel" class="form-control" maxlength="15">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Cidade</label>
                            <input name="cidade" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Estado</label>
                            <input name="estado" type="text" class="form-control" maxlength="2">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Foto</label>
                            <input name="foto" type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Data de Nascimento</label>
                            <input name="data_nascimento" type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Observações</label>
                            <input name="observacoes" type="text" class="form-control">
                        </div>
                        <input type="hidden" name="<?= $parametro; ?>" value="s">
                        <?php if ($editarSim === true) {
                            ?>
                            <input type="hidden" name="codigo" value="<?= $_GET['codigo'] ?>">
                            <?php
                        } ?>
                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                    </form>
                </div>


            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>SISTEMA - DATA</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
</body>

</html>