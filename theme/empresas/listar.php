<?php $v->layout("layout2"); ?>

<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Empresas</h5>

                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#">Config option 1</a>
                        </li>
                        <li><a href="#">Config option 2</a>
                        </li>
                    </ul>
                    <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content">

                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Empresa</th>
                            <th>Telefone</th>
                            <th>CNPJ</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($empresas as $empresa) :
                            $array = explode('/', $empresa->Email); // função para pegar só o primeiro email
                            ?>

                            <tr>
                                <td class="text-left" scope="row"><?= $empresa->Codigo ?></td>
                                <td class="text-left" scope="row"><?= $empresa->Nome ?></td>
                                <!--<td class="text-left" scope="row"><?= $array[0] ?></td>-->
                                <td class="text-left" scope="row"><?= $empresa->Telefone ?></td>
                                <td class="text-left" scope="row"><?= $empresa->CNPJ ?></td>
                                <td>
                                    <a href="./admin/empresa/<?= $empresa->Codigo ?>/editar/">
                                        <i class="fa fa-pencil text-navy"></i>
                                    </a>
                                    <a href="./admin/empresa/<?= $empresa->Codigo ?>/excluir/">
                                        <i class="fa fa-trash text-navy"></i>
                                    </a>
                                </td>
                            </tr>

                        <?php
                        endforeach; ?>
                        
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>