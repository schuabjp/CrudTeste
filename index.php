<?php
require_once "load.php";

if (isset($_GET['excluir']) && isset($_GET['codigo'])) {
    $excluir = $conexao->prepare("DELETE FROM contatos WHERE codigo = :codigo");
    $excluir->bindParam(':codigo', $_GET['codigo']);
    $excluir->execute();
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
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
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
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small">Teste Instar</span>
                    </div>
                </div>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Contatos do Sistema</h1>

                <a href="cadastrarEditarContato.php?cadastrar=s" class="btn btn-primary btn-icon-split mb-4">
                        <span class="icon text-white-50">
                            <i class="fas fa-user"></i>
                        </span>
                    <span class="text">Cadastrar Contato</span>
                </a>
                <a href="categorias.php" class="btn btn-primary btn-icon-split mb-4">
                        <span class="icon text-white-50">
                            <i class="fas fa-align-justify"></i>
                        </span>
                    <span class="text">Categorias</span>
                </a>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <!--<th scope="col">ID</th>-->
                        <th scope="col">Nome</th>
                        <!--<th scope="col">E-Mail</th>-->
                        <!--<th scope="col">Endereço</th>-->
                        <th scope="col">Telefone</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Cidade</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Data de Nascimento</th>
                        <!--<th scope="col">Observações</th>-->
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $listar = $conexao->prepare("SELECT * FROM contatos");
                    $listar->execute();

                    while ($contato = $listar->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <td><?= $contato['nome']; ?></td>
                            <!--<td><?/*= $contato['email']; */?></td>-->
                            <!--<td><?/*= $contato['endereco']; */?></td>-->
                            <td><?= $contato['telefone']; ?></td>
                            <td><?= $contato['celular']; ?></td>
                            <td><?= $contato['cidade']; ?></td>
                            <td><?= $contato['estado']; ?></td>
                            <td><?= $contato['foto']; ?></td>
                            <td><?= $contato['data_nascimento']; ?></td>
                            <!--<td><?/*= $contato['observacoes']; */?></td>-->
                            <td><a class="btn btn-info" href="cadastrarEditarContato.php?editar=s&codigo=<?= $contato['codigo']; ?>">Editar</a></td>
                            <td><a class="btn btn-danger" href="index.php?excluir=s&codigo=<?= $contato['codigo']; ?>">Deletar</a></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>

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