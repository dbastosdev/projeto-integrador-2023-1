<?php
session_start();

// Valida se o usuário está logado.
if(empty($_SESSION["user-data"]["user"])){
    header("Location: ./401.php");
    exit;
}

// Importação da classe Student para listar os usuários
require_once('./backend/db-config.php');
require_once('./backend/Student.class.php');
$student = new Student($pdo);

// Atribui o resultado da consulta ao banco a lista d estudantes
$studentsLists = $student->index();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="dashboard.php">SF - Sistema Fit</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Menu</div>
                            <a class="nav-link" href="dashboard.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Início
                            </a>
                            <a class="nav-link" href="students.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Alunos
                            </a>
                            <a class="nav-link" href="teachers.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Professores
                            </a>
                            <a class="nav-link" href="classes.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-dumbbell"></i></div>
                                Modalidades
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                    <div class="small">Usuário logado:</div>
                        <!--Pegando o dado que vem por meio da action de login por meio da seção.-->
                        <?php echo $_SESSION["user-data"]["user"];?>
                        <br>
                        <br>
                        <!-- <a class="btn btn-dark" href="#">logout</a> -->
                        <form method="post" action="./backend/login.action.php">
                            <input type="hidden" name="action_type" value="logout"/>
                            <button class="btn btn-dark">Sair</button>
                        </form>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Alunos</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Alunos</li>
                        </ol>
                        <div class="card mb-4">
                        </div>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-user me-1"></i>
                                Alunos cadastrados
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Dia do pagamento</th>
                                        <th scope="col">Status de pagamento</th>
                                        <th scope="col">Modalidade</th>
                                        <th scope="col">Editar aluno</th>
                                        <th scope="col">Excluir aluno</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <!--
                                            Início do foreach que passa por cada dado da lista de estudantes e os exibe dentro da lista
                                        -->
                                      <?php foreach($studentsLists as $s){ ?>
                                      <tr>
                                        <td><?php echo $s["name"];?></td>
                                        <td><?php echo $s["email"];?></td>
                                        <td><?php echo implode("/",array_reverse(explode("-",$s["start"])));?></td>
                                        <td><?php echo $s["payment-status"];?></td>
                                        <td><?php echo $s["sport"];?></td>
                                        <td><a href="./backend/student.action.php?action_type=edit&id=<?php echo $s['id']; ?>" class="btn btn-dark">Editar</a></td>
                                        <td><a href="./backend/student.action.php?action_type=delete&id=<?php echo $s['id'];?>" onclick="return confirm('Você confirma a ação de deletar o registro?');" class="btn btn-danger">Deletar</a></td>
                                      </tr>
                                      <?php } ?>
                                      <!--
                                            fim do foreach
                                        -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-user me-1"></i>
                                Cadastro de novos alunos
                            </div>
                            <div class="card-body">
                                <form action="./backend/student.action.php" method="post">
                                    <input type="hidden" name="action_type" value="create"/>
                                    <div style="margin-bottom: 20px;" class="form-row">
                                      <div class="form-group col-md-6">
                                        <label for="name">Nome Completo</label>
                                        <input type="text" class="form-control" name="inputName" id="name" placeholder="Nome e Sobrenome">
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" name="inputEmail" id="email" placeholder="e-mail">
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="modalidae">Modalidade</label>
                                        <input type="text" class="form-control" name="inputSport" id="modalidae" placeholder="Esporte">
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="date">Dia de pagamento</label>
                                        <input type="date" class="form-control" name="inputStart" id="date" placeholder="Data">
                                      </div>
                                      <div class="form-group col-md-6">
                                        <label for="status">Status pagamento</label>
                                        <select id="status" name="inputPayment" class="form-control">
                                          <option selected>Selecione</option>
                                          <option value="pago">Pago</option>
                                          <option value="atrasado">Atrasado</option>
                                          <option value="em dia">Em dia</option>
                                        </select>
                                      </div>
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                                  </form>
                            </div>

                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Sistema Fit &copy; Todos os direitos reservados 2023</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
