<?php
session_start();

/*
    Processando a lógica de login para acesso ao dashboard. O dashboard, só poderá ser acessível caso a sessão esteja preenchida. 
    Dessa forma, caso seja passada a url direta do dashboard, não será possível ser acessada. Somente através do login.
    TODAS AS PÁGINAS DO DASHBOARD DEVEM IMPLEMENTAR ESSA VALIDAÇÃO.
*/

if(empty($_SESSION["user-data"]["user"])){
    header("Location: ./401.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Dashboard - SF Sistema Fit</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="dashboard.html">SF - Sistema Fit</a>
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Início</li>
                        </ol>
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div style="text-align: center;" class="card-body">Alunos ativos</div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <h2 class="mt-4">20</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div style="text-align: center;" class="card-body">Alunos desmatriculados</div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <h2 class="mt-4">20</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div style="text-align: center;" class="card-body">Alunos em atraso</div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <h2 class="mt-4">20</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div style="text-align: center;" class="card bg-danger text-white mb-4">
                                    <div class="card-body">Novos alunos</div>
                                    <div class="card-footer d-flex align-items-center justify-content-center">
                                        <h2 class="mt-4">20</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-dumbbell me-1"></i>
                                        Próximas atividades
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                              <tr>
                                                <th scope="col">Modalidade</th>
                                                <th scope="col">Horário</th>
                                                <th scope="col">Check in</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>Fit Dance</td>
                                                <td>12:00 a 13:00</td>
                                                <td>23</td>
                                              </tr>
                                              <tr>
                                            
                                                <td>Jiu jitsu</td>
                                                <td>14:00 a 15:00</td>
                                                <td>40</td>
                                              </tr>
                                              <tr>
                                                
                                                <td>Muay thai</td>
                                                <td>09:00 a 10:30</td>
                                                <td>10</td>
                                              </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card">
                                    <div class="card-header">
                                        <i class="fas fa-money-bill me-1"></i>
                                        Contas da academia
                                    </div>
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                              <tr>
                                              
                                                <th scope="col">Conta</th>
                                                <th scope="col">Status</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <tr>
                                                <td>Conta de água</td>
                                                <td>Em atraso</td>
                                              </tr>
                                              <tr>
                                                <td>Conta de energia</td>
                                                <td>Pago</td>
                                              </tr>
                                              <tr>
                                                <td>Conta de gás</td>
                                                <td>Pendente</td>
                                              </tr>
                                            </tbody>
                                          </table>
                                    </div>
                                    
                                </div>
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
