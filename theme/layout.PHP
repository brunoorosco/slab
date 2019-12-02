<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= url("theme/_style.css"); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
  <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="//www.shieldui.com/shared/components/latest/css/light/all.min.css" />



  <title>SLab System</title>
</head>

<body>


  <div class="wrapper">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
      <i class="fa fa-bars"></i>
    </a>

    <nav id="sidebar">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="./">System LabS</a>
          <div id="close-sidebar">
            <i class="fa fa-times"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic">
            <img class="img-fluid img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg" alt="User picture">
          </div>
          <div class="user-info">
            <span class="user-name">Funcionário
              <strong>SENAI</strong>
            </span>
            <span class="user-role">Administrator</span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
            </span>
          </div>
        </div>

        <ul class="list-unstyled components">
          <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Cadastro</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
              <li><a href="../composicoes/" class="lk_lista">Composições</a></li>
              <li><a href="<?= url("empresa/add"); ?>">Empresas</a></li>
              <li><a href="../funcionarios" class="lk_lista">Funcionários</a></li>
              <li><a href="#">Normas</a> </li>
              <li><a href="../produtos/" class="lk_lista">Produtos</a></li>
              <li><a href="../ensaios/" class="lk_lista">Tipos de Ensaios</a></li>
              <li><a href="../tiposTecido/" class="lk_lista">Tipos de Tecidos</a></li>
            </ul>
          </li>

          <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Consulta</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
              <li>
                <a href="<?= url("empresa"); ?>">Empresas</a>
              </li>
              <li>
                <a href="./ensaio">Ensaios</a>
              </li>
              <li>
                <a href="./atendimento/plano">Plano de Atendimento</a>
              </li>
              <li>
                <a href="<?= url("orcamento"); ?>">Orçamentos</a>
              </li>
              <li>
                <a href="#">Outros</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="<?= url("atendimento"); ?>">Plano de Atendimento</a>
          </li>

          <li>
            <a href="<?= url("etiqueta/busca"); ?>">Impressão de Etiquetas</a>
          </li>

          <li>
            <a href="#">Liberação de Pedidos</a>
          </li>
          <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Relatórios</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
              <li><a href="../relatorios/planoAtendimento/" class="lk_lista">Plano de atendimento</a></li>
              <li><a href="../relatorios/etiquetas/" class="lk_lista">Etiquetas para amostras</a></li>
              <li><a href="../relatorios/recebimentoItens/" class="lk_lista">Recebimento de itens para ensaio</a></li>
            </ul>
          </li>
        </ul>

        <ul class="list-unstyled CTAs">
          <li>
            <a href="#" class="download">Settings</a>
          </li>
        </ul>
    </nav>


    <main class="page-content">
      <div class="container-fluid">

        <?= $v->section("content"); ?>
      </div>
    </main>
  </div>



  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  <script>
    jQuery(function($) {
      $("#close-sidebar").click(function() {
        //$("#sidebar").removeClass("toggled");
        $('#sidebar').toggleClass('active');
        $('#show-sidebar').toggleClass('active');

      });
      $("#show-sidebar").click(function() {
        $("#sidebar").removeClass("active");
        $("#show-sidebar").removeClass("active");
      });
    });
  </script>





</body>

</html>