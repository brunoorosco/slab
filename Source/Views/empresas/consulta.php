<?php $v->layout("theme/sidebar"); ?>

<div class="container-fluid">
  <div class="card">
    <div class="card-header">
      <h4 class="text-center"> Lista de Empresas</h4>
    </div>
  </div>


    <a href="create.php" class="btn btn-success">Adicionar</a>


    <div class="empresas">
      <?php if ($empresas) : ?>
         <table class="table table-striped text-left border" id="tabela_membros">
          <thead>
            <tr>
              <th scope="col">Cód.</th>
              <th scope="col">Empresa</th>
              <th scope="col">Email</th>
              <th scope="col">Telefone</th>
              <th scope="col-2">CNPJ</th>
              <th scope="col">Ação</th>
            </tr>
          </thead>
          <tbody>
            <?php
              foreach ($empresas as $empresa) :
                $array = explode('/', $empresa->Email);// função para pegar só o primeiro email
                     ?>

              <tr>
                <td class="text-left" scope="row"><?= $empresa->Codigo ?></td>
                <td class="text-left" scope="row"><?= $empresa->Nome ?></td>
                <td class="text-left" scope="row"><?= $array[0]?></td>
                <td class="text-left" scope="row"><?= $empresa->Telefone ?></td>
                <td class="text-left" scope="row"><?= $empresa->CNPJ ?></td>
                <td class="text-left" scope="row">Excluir-Editar-Visualizar</td>
              </tr>

            <?php
              endforeach; ?>
          </tbody>
        </table>
      <?php else :
        ?>
        <h4>Não existem usuários cadasatrados!</h4>
      <?php
      endif;
      ?>
    </div>
  </div>
