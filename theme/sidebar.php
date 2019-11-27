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
              <li>
                <a href="<?= url().'/add';?>">Empresa</a>
              </li>
              <li>
                <a href="#">Normas</a>
              </li>
              <li>
                <a href="#">RH</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Consulta</a>
            <ul class="collapse list-unstyled" id="homeSubmenu">
              <li>
                <a href="<?= url();?>">Empresas</a>
              </li>
              <li>
                <a href="./ensaio">Ensaios</a>
              </li>
              <li>
                <a href="#">Orçamentos</a>
              </li>
              <li>
                <a href="#">Outros</a>
              </li>
            </ul>
          </li>

          <li>
            <a href="#">Orçamento</a>
          </li>

          <li>
            <a href="#">Impressão de Etiquetas</a>
          </li>

          <li>
            <a href="#">Liberação de Pedidos</a>
          </li>
          <li>
            <a href="#">Outros</a>
          </li>
        </ul>

        <ul class="list-unstyled CTAs">
          <li>
            <a href="#" class="download">Settings</a>
          </li>
        </ul>
    </nav>