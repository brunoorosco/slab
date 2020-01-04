<?php $v->layout("layout2"); ?>

<?php $v->start("css"); ?>
<link rel="stylesheet" href="<?= url('Source/assests/css/planoStyle.css'); ?>">

<?php $v->end(); ?>

<div class="container-fluid">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>
                Plano de Atendimento
                <?php //echo ($incluindo ? "Incluir" : "Editar") . " Empresa"; 
                ?>
            </h5>

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

            <form id="formPlano" method="POST" action="<?= url('atendimento/plano') ?>" enctype="multipart/form-data">
                <div class=" input-group">
                    <div class="form-group col-2">
                        <label for="message-text" class="control-span">Nº Sequencial:</label>
                        <div class="input-group">
                            <input name="nProposta"    type="text" class="form-control col" id="nProposta"   placeholder="Nº Proposta">
                            <input name="nPropostaAno" type="text" class="form-control"     id="anoProposta" value="/ <?= date('Y') ?>" disabled  >
                        </div>
                    </div>
                    <div class="form-group col-2">
                        <label for="recipient-name" class="control-span ">CNPJ:</label>
                        <!-- <input name="cnpj" type="text" class="form-control text-right" id="cnpj" placeholder="00.000.000/0000-00" maxlength="18"> -->
                        <div class="input-group">
                            <input type="text" name="cnpj" id="cnpj" value="<?php //($incluindo ? null : $dados->razao_social); 
                                                                            ?>" placeholder="00.000.000/0000-00" class="form-control text-right ">
                            <div class="input-group-append">
                                <button class="btn btn-success" id="pesquisar" type="button"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col">
                        <label for="empresa" class="control-span">Empresa:</label>
                        <input name="empresa" type="text" class="form-control" id="empresa" placeholder="Razão Social">
                        <input name="codEmpresa" type="text" hidden id="codEmpresa">
                    </div>
                    <div class="form-group col-2">
                        <label for="message-text" class="control-span">Data da Solicitação:</label>
                        <input name="dataSolicitacao" type="text" class="form-control date" id="dataSolicitacao" placeholder="Quando Solicitado">
                    </div>
                </div>
                <div class="input-group">

                    <div class="form-group col-5">
                        <label for="message-text" class="control-span">Endereço:</label>
                        <input name="endereco" type="text" class="form-control" disabled id="endereco" placeholder="Endereço">
                    </div>
                    <div class="form-group col-3">
                        <label for="message-text" class="control-span">Contato:</label>
                        <input name="contato" type="text" class="form-control" disabled id="contato" placeholder="Resp. Empresa">
                    </div>
                    <div class="form-group col">
                        <label for="message-text" class="control-span">Email:</label>
                        <input name="email" type="text" class="form-control" disabled id="email" placeholder="Email">
                    </div>

                </div>

                <div class="input-group">
                    <div class=" col-2">
                        <label for="message-text" class="control-form">Forma da Solicitação:</label>
                        <div class="custom-control custom-radio " style="margin-top:0px">
                            <input type="radio" id="customRadioInline1" checked name="tipoSolicitacao" value="EMAIL" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline1">E-mail</Label>
                        </div>
                        <div class="custom-control custom-radio ">
                            <input type="radio" id="customRadioInline2" name="tipoSolicitacao" value="FA" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline2">Fax</label>
                        </div>
                        <div class="custom-control custom-radio " style="margin-top:0px">
                            <input type="radio" id="customRadioInline3" name="tipoSolicitacao" value="FONE" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline3">Fone</Label>
                        </div>
                        <div class="custom-control custom-radio ">
                            <input type="radio" id="customRadioInline4" name="tipoSolicitacao" value="OUTROS" class="custom-control-input">
                            <label class="custom-control-label" for="customRadioInline4">Outros</label>
                        </div>

                    </div>
                    <div class="col-2">
                        <label for="cem" class="control-span">Resp. p/ Atendimento</label>
                        <input name="responsavel" class="form-control" id="responsavel" Type="text" placeholder="Login em nome de:" disabled value="<?= $_SESSION['userName'] ?>">
                    </div>
                    <div class="form-group col">
                        <label for="recipient-name" class="control-span">Previsão da Inicial</label>
                        <input name="dataInicial" type="text" class="form-control date text-right" id="dataInicial" placeholder="00/00/0000" maxlength="10">
                    </div>
                    <div class="form-group col">
                        <label for="recipient-name" class="control-span">Previsão da Final</label>
                        <input name="dataFinal" type="text" class="form-control date text-right" id="dataFinal" placeholder="00/00/0000" maxlength="10">
                    </div>
                    <div class="form-group col">
                        <label for="message-text" class="control-span">Resposta ao Cliente</label>
                        <input name="dataResposta" type="text" class="form-control col text-right" id="dataResposta" placeholder="00/00/0000">
                    </div>
                    <div class="form-group col">
                        <label for="tecnico" class="control-span">Resp. Análise Crítica</label>
                        <select class="custom-select mr-sm-2" id="tecnico" name="tecnico">
                            <option selected disabled>Técnicos</option>
                            <?php
                            foreach ($tecnicos as $tecnico) : ?>
                                <option value="<?= $tecnico->Codigo ?>"><?= $tecnico->Nome ?></option>
                            <?php
                            endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="panel panel-default" id="pn_qualidade">
                    <div class="panel-heading">
                        <h3 class="panel-title">Serviço a ser executado</h3>
                    </div>
                    <div class="panel-body ">
                        <div class="table-responsive">
                            <table class="table " tablename="tb_pedidos" id="tb_pedidos" deleteicon="/ecm_resources/resources/assets/images/delete_24_Original.png">
                                <thead>
                                    <tr class="row justify-content-md-center" style="margin-right: 0px">
                                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-3">Descricao do Ensaio</th>
                                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Norma</th>
                                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-1">Amostras</th>
                                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-1">Valor Unitário</th>
                                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-1">Valor Total</th>
                                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-1">Desc. (%)</th>
                                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center"> <a data-action="<?= url("plano/servico/edit") ?>" data-id=<?= $plano->Codigo ?> data-func="edit" id="adicionar">
                                                <i class="fa fa-plus-circle text-navy mr-2"></i>
                                            </a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- <tr class="row justify-content-md-center" style="margin-right: 0px">
                                        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-3">
                                            <select class="custom-select mr-sm-2 ensaio" id="tpEnsaio_1" name="tpEnsaio">
                                                <option selected Disabled>Tipos de ENsaio</option>
                                                <?php
                                                foreach ($ensaios as $ensaio) : ?>
                                                    <option value="<?= $ensaio->Codigo ?>"><?= $ensaio->Nome ?></option>
                                                <?php
                                                endforeach; ?>
                                            </select>
                                        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                                           
                                            <select class="custom-select mr-sm-2 tpNorma" id="tpNorma_1" name="tpNorma">


                                            </select>
                                        </td>
                                        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-1"><input name="quantAmostra_1" class="form-control text-center number calculo" id="quantAmostra_1" Type="text"></td>
                                        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-1"><input name="precoUnit_1" class="form-control text-right calculo money2" id="precoUnit_1" Type="text"></td>
                                        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-1"><input name="precoTotal_1" class="form-control money text-right" id="precoTotal_1" Type="text" placeholder="R$ 0.00" disabled></td>
                                        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-1"><input type="text" name="desc" id="desc_1" class="form-control" maxlength="100"></td>
                                        <td class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center p-3">
                                            <i class="fa fa-save text-navy mr-2 btnSalvar" style="cursor:pointer"></i>

                                            <a data-action="<?= url("plano/excluir") ?>" data-id=<?= $plano->Codigo ?> data-nome=<?= $plano->Nome ?> data-func="exc">
                                                <i class="fa fa-trash text-navy"></i>
                                            </a></td>
                                    </tr> -->

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="form-inline d-flex">
                    <div class="mr-auto p-2">
                        <div class="form-group mb-2">
                            <h3><label type="text" readonly class="form-control-plaintext text-right">Valor Total: </label></h3>
                            <input type="text" class="form-control money text-right" style="background: rgba(0, 151, 19, 0.1);" id="valorTotal" placeholder="R$ 0,00" disabled>
                        </div>
                    </div>
                    <div class="form-inline">
                        <div class="form-group flex-fill mx-sm-1">
                            <button type="reset" class="btn btn-lith mb-2">Limpar</button>
                        </div>
                        <div class="form-group flex-fill mx-sm-1">
                            <button type="submit" class="btn btn-success mb-2">Salvar</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php $v->start("js"); ?>
<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script src="js/maskara.js"></script>
<script src="js/moment.js"></script>

<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<script src="js/planoAtendimento.js"></script>

<?php $v->end(); ?>