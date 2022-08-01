<?php
require_once "load.php";

if (isset($_GET['excluir']) && isset($_GET['codigo'])) {
    $excluir = $conexao->prepare("DELETE FROM categorias WHERE codigo = :codigo");
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
                <h1 class="h3 mb-4 text-gray-800">Categorias</h1>

                <a href="index.php" class="btn btn-primary btn-icon-split mb-4">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-alt-circle-left"></i>
                        </span>
                    <span class="text">Voltar</span>
                </a>

                <a href="cadastrarEditarCategoria.php?cadastrar=s" class="btn btn-primary btn-icon-split mb-4">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus-square"></i>
                        </span>
                    <span class="text">Cadastrar Categoria</span>
                </a>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Deletar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $listar = $conexao->prepare("SELECT * FROM categorias");
                    $listar->execute();

                    while ($categoria = $listar->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <tr>
                            <th><?= $categoria['codigo']; ?></th>
                            <td><?= $categoria['nome']; ?></td>
                            <td><?= $categoria['descricao']; ?></td>
                            <td><a class="btn btn-info" href="cadastrarEditarCategoria.php?editar=s&codigo=<?= $categoria['codigo']; ?>">Editar</a></td>
                            <td><a class="btn btn-danger" href="categorias.php?excluir=s&codigo=<?= $categoria['codigo']; ?>">Deletar</a></td>
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