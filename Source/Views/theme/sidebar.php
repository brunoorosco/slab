<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="<?= asset('Favicon.ico') ?>" type="image/x-icon">
  <link href='<?= asset('bootstrap/css/bootstrap.min.css') ?>' rel="stylesheet">
  <link href='<?= asset('font-awesome/css/font-awesome.css') ?>' rel="stylesheet">
  <link href="<?= asset('css/sidebar.css') ?>" rel="stylesheet">
  <!-- Toastr style -->
  <link href="<?= asset('css/plugins/toastr/toastr.min.css') ?>" rel="stylesheet">

  <!-- Gritter -->
  <link href="<?= asset('js/plugins/gritter/jquery.gritter.css') ?>" rel="stylesheet">

  <link href="<?= asset('css/animate.css') ?>" rel="stylesheet">
  <?= $v->section("css"); ?>
  <title><?= $v->e($title) ?></title>
</head>

<body>
  <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
      <i class="fas fa-bar"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="#" class="text-white">System Lab</a>
          <div id="close-sidebar">
            <i class="fa fa-times"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic">
            <img alt="image" class="img-circle" src="<?= asset('img/avatar-2.png') ?>" width="45" />
          </div>
          <div class="user-info">
            <span class="user-name">
              <strong class="text-white"><?= $_SESSION['userName'] ?></strong>
            </span>
            <span class="user-role text-white">Administrator</span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
            </span>
          </div>
        </div>
        <!-- sidebar-header  -->
        <div class="sidebar-search">
          <div>
            <div class="input-group">
              <input type="text" class="form-control search-menu" placeholder="Search...">
              <div class="input-group-append">
                <span class="input-group-text">
                  <i class="fa fa-search" aria-hidden="true"></i>
                </span>
              </div>
            </div>
          </div>
        </div>
        <!-- sidebar-search  -->
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span class="text-black-50">Geral</span>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fa fa-plus"></i>
                <span>Cadastro</span>
                <span class="badge badge-pill badge-warning">New</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li><a href="<?= url("comp/add"); ?>">Composições</a></li>
                  <li><a href="<?= url("empresa/add"); ?>">Empresas</a></li>
                  <li><a href="<?= url("func/add"); ?>">Funcionários</a></li>
                  <li><a href="#">Normas</a> </li>
                  <li><a href="../produtos/" class="lk_lista">Produtos</a></li>
                  <li><a href="../ensaios/" class="lk_lista">Tipos de Ensaios</a></li>
                  <li><a href="../tiposTecido/" class="lk_lista">Tipos de Tecidos</a></li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fa fa-search"></i>
                <span>Consulta</span>
                <span class="badge badge-pill badge-danger">3</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li><a href="<?= url("comp"); ?>">Composições</a></li>
                  <li><a href="<?= url("empresa"); ?>">Empresas</a></li>
                  <li><a href="<?= url("ensaio"); ?>">Ensaios</a></li>
                  <li><a href="<?= url("equipamento"); ?>">Equipamentos</a></li>
                  <li><a href="<?= url("func"); ?>">Funcionários</a></li>
                  <li><a href="<?= url("atendimento/plano"); ?>">Plano de Atendimento</a></li>
                  <li><a href="<?= url("norma"); ?>">Normas</a></li>
                  <li><a href="<?= url("orcamento"); ?>">Orçamentos</a></li>
                  <li>
                    <a href="#">Outros</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fa fa-gem"></i>
                <span>Components</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="#">General</a>
                  </li>
                  <li>
                    <a href="#">Panels</a>
                  </li>
                  <li>
                    <a href="#">Tables</a>
                  </li>
                  <li>
                    <a href="#">Icons</a>
                  </li>
                  <li>
                    <a href="#">Forms</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fa fa-chart-line"></i>
                <span>Charts</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="#">Pie chart</a>
                  </li>
                  <li>
                    <a href="#">Line chart</a>
                  </li>
                  <li>
                    <a href="#">Bar chart</a>
                  </li>
                  <li>
                    <a href="#">Histogram</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="sidebar-dropdown">
              <a href="#">
                <i class="fa fa-globe"></i>
                <span>Maps</span>
              </a>
              <div class="sidebar-submenu">
                <ul>
                  <li>
                    <a href="#">Google maps</a>
                  </li>
                  <li>
                    <a href="#">Open street map</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="header-menu">
              <span class="text-black-50">Extra</span>
            </li>
            <li>
              <a href="<?= url("atendimento"); ?>">
                <i class="fa fa-book"></i>
                <span>Plano de Atendimento</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-calendar"></i>
                <span>Calendar</span>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-folder"></i>
                <span>Examples</span>
              </a>
            </li>
          </ul>
        </div>
        <!-- sidebar-menu  -->
      </div>
      <!-- sidebar-content  -->
      <div class="sidebar-footer ">
        <a href="#">
          <i class="fa fa-bell text-muted"></i>
          <span class="badge badge-pill badge-warning notification">3</span>
        </a>
        <a href="#">
          <i class="fa fa-envelope text-muted"></i>
          <span class="badge badge-pill badge-success notification">7</span>
        </a>
        <a href="#">
          <i class="fa fa-cog text-muted"></i>
          <span class="badge-sonar"></span>
        </a>
        <a href="<?= $router->route("app.logoff"); ?>">
          <i class="fa fa-power-off text-muted"></i>
        </a>
      </div>
    </nav>

    <!-- sidebar-wrapper  -->
    <main class="page-content">

      <?= $v->section("content"); ?>
    </main>
    <!-- page-content" -->
  </div>
  <!-- page-wrapper -->
  <!-- Mainly scripts -->
  <script src="<?= asset('js/jquery-3.4.1.js') ?>"></script>

  <script src="<?= asset('js/popper.js') ?>"></script>
  <script src="<?= asset('bootstrap/js/bootstrap.min.js') ?>"></script>

  <!-- Peity -->
  <script src="<?= asset('js/plugins/peity/jquery.peity.min.js') ?>"></script>
  <script src="<?= asset('js/demo/peity-demo.js') ?>"></script>

  <!-- Custom and plugin javascript -->
  <!-- <script src="js/inspinia.js"></script> -->
  <script src="<?= asset('js/plugins/pace/pace.min.js') ?>"></script>

  <!-- jQuery UI -->
  <script src="<?= asset('js/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>

  <!-- GITTER -->
  <script src="<?= asset('js/plugins/gritter/jquery.gritter.min.js') ?>"></script>

  <!-- Sparkline -->
  <script src="<?= asset('js/plugins/sparkline/jquery.sparkline.min.js') ?>"></script>

  <!-- Sparkline demo data  -->
  <script src="<?= asset('js/demo/sparkline-demo.js') ?>"></script>

  <!-- Toastr -->
  <script src="<?= asset('js/plugins/toastr/toastr.min.js') ?>"></script>
  <script src="<?= asset('js/sidebar.js') ?>"></script>


  <?= $v->section("js"); ?>

</body>

</html>