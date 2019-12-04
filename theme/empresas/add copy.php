<?php $v->layout("layout2"); ?>
<!-- CADASTRO DE EMPRESAS -->


<div class="row">
    <div class="col-lg-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>
                    Incluir Empresa
                    <?php //echo ($incluindo ? "Incluir" : "Editar") . " Empresa"; ?>
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
                <form class="form-horizontal" id="form_cadEmpresas" name="frm_cadEmpresas" action="php/cadastro.php" method="post">
                    <span class="subtitulo2 text-left p-2" id="ini_tit4">
                        <h4>Incluir Empresas</h4>
                    </span>
                    <div class="form-group">
                        <label class="col-lg-1 control-label text-center">Cód. do Cliente</label>
                        <div class="col-lg-1">
                            <input type="text" name="razao_social" value="<?= ($codCliente ? null : $codCliente); ?>" placeholder="" class="form-control">
                        </div>

                        <label class="col-lg-1 control-label">Razão Social</label>
                        <div class="col-lg-4">
                            <input type="text" name="razao_social" value="<?php //($incluindo ? null : $dados->razao_social); 
                                                                            ?>" placeholder="" class="form-control">
                        </div>

                        <label class="col-lg-1 control-label">CNPJ</label>
                        <div class="col-lg-2">
                            <input type="text" name="razao_social" value="<?php //($incluindo ? null : $dados->razao_social); 
                                                                            ?>" placeholder="" class="form-control">
                        </div>
                    </div>
                    <!-- FORMULÁRIO DE CADASTRO DE EMPRESA -->
                    <div class="row">
                        <div class="col-2">
                            <span id="cadEmpresa_tit1" class="texto">Cód. do Cliente</span>

                            <input type="text" name="txt_codcliente" onclick="cor(this);" class="cx_numeros form-control text-right" maxlength="10" id="cx1_CadEmpresas" value="<?php if (isset($codCliente)) {
                                                                                                                                                                                    echo $codCliente;
                                                                                                                                                                                } ?>" />
                        </div>
                        <div class="col">
                            <span id="cadEmpresa_tit2" class="texto">Empresa</span>

                            <input type="text" name="txt_nome" onclick="cor(this);" maxlength="100" class="cx_texto2 form-control" id="cx2_CadEmpresas" value="<?php if (isset($empresa)) {
                                                                                                                                                                    echo $empresa;
                                                                                                                                                                } ?>" />
                        </div>
                        <div class="col-3">

                            <span id="cadEmpresa_tit3" class="texto">CNPJ</span>

                            <input type="text" name="txt_cnpj" onclick="cor(this);" maxlength="18" class="cx_cnpj form-control" id="cx3_CadEmpresas" value="<?php if (isset($cnpj)) {
                                                                                                                                                                echo $cnpj;
                                                                                                                                                            } ?>" />

                        </div>
                        <div class="col-2">
                            <span id="cadEmpresa_tit4" class="texto">Inscrição Estadual</span>

                            <input type="text" name="txt_ie" onclick="cor(this);" class="cx_texto2 form-control" id="cx4_CadEmpresas " value="<?php if (isset($ie)) {
                                                                                                                                                    echo $ie;
                                                                                                                                                } ?>" />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span id="cadEmpresa_tit5" class="texto">E-mail</span>

                            <input type="text" name="txt_email" onclick="cor(this);" maxlength="200" class="cx_texto2 form-control" id="cx5_CadEmpresas" value="<?php if (isset($email)) {
                                                                                                                                                                    echo $email;
                                                                                                                                                                } ?>" />

                            <!-- ----------------------------------------------------------------------- -->

                        </div>
                        <div class="col-2">
                            <span id="cadEmpresa_tit11" class="texto">CEP</span>

                            <input type="text" name="txt_cep" onclick="cor(this);" maxlength="9" class="cx_cep form-control" id="cx11_CadEmpresas" value="<?php if (isset($cep)) {
                                                                                                                                                                echo $cep;
                                                                                                                                                            } ?>" />

                        </div>
                        <div class="col">
                            <span id="cadEmpresa_tit6" class="texto">Endereço</span>

                            <input type="text" name="txt_endereco" onclick="cor(this);" maxlength="100" class="cx_texto2 form-control" id="cx6_CadEmpresas" value="<?php if (isset($endereco)) {
                                                                                                                                                                        echo $endereco;
                                                                                                                                                                    } ?>" />


                        </div>
                        <div class="col-1">
                            <span id="cadEmpresa_tit7" class="texto">Número</span>

                            <input type="text" name="txt_numero" onclick="cor(this);" maxlength="10" class="cx_numeros form-control" id="cx7_CadEmpresas" value="<?php if (isset($numero)) {
                                                                                                                                                                        echo $numero;
                                                                                                                                                                    } ?>" />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <span id="cadEmpresa_tit8" class="texto">Cidade</span>

                            <input type="text" name="txt_cidade" onclick="cor(this);" maxlength="50" class="cx_texto2 form-control" id="cx8_CadEmpresas" value="<?php if (isset($cidade)) {
                                                                                                                                                                    echo $cidade;
                                                                                                                                                                } ?>" />

                        </div>
                        <div class="col">
                            <span id="cadEmpresa_tit9" class="texto">Bairro</span>

                            <input type="text" name="txt_bairro" onclick="cor(this);" maxlength="50" class="cx_texto2 form-control" id="cx9_CadEmpresas" value="<?php if (isset($bairro)) {
                                                                                                                                                                    echo $bairro;
                                                                                                                                                                } ?>" />

                        </div>
                        <div class="col-1"><span id="cadEmpresa_tit10" class="texto">Estado</span>

                            <input type="text" name="txt_estado" onclick="cor(this);" class="cx_texto2 form-control" id="cx10_CadEmpresas" maxlength="2" value="<?php if (isset($estado)) {
                                                                                                                                                                    echo $estado;
                                                                                                                                                                } ?>" />

                            <!-- ------------------------------------------------------------------------- -->
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-2">
                            <span id="cadEmpresa_tit12" class="texto">Telefone 1</span>

                            <input type="text" name="txt_telefone" onclick="cor(this);" maxlength="14" class="cx_telefone form-control" id="cx12_CadEmpresas" value="<?php if (isset($telefone)) {
                                                                                                                                                                            echo $telefone;
                                                                                                                                                                        } ?>" />


                        </div>
                        <div class="col-1">
                            <span id="cadEmpresa_tit13" class="texto">Ramal</span>

                            <input type="text" name="txt_ramal" onclick="cor(this);" maxlength="10" class="cx_numeros form-control" id="cx13_CadEmpresas" value="<?php if (isset($ramal)) {
                                                                                                                                                                        echo $ramal;
                                                                                                                                                                    } ?>" />

                        </div>
                        <div class="col-2">
                            <span id="cadEmpresa_tit14" class="texto">FAX</span>

                            <input type="text" name="txt_fax" onclick="cor(this);" class="cx_texto2  form-control" id="cx14_CadEmpresas" value="<?php if (isset($fax)) {
                                                                                                                                                    echo $fax;
                                                                                                                                                } ?>" />

                        </div>
                        <div class="col">
                            <span id="cadEmpresa_tit15" class="texto">Contato</span>

                            <input type="text" name="txt_contato" onclick="cor(this);" maxlength="200" class="cx_texto2 form-control" id="cx15_CadEmpresas" value="<?php if (isset($contato)) {
                                                                                                                                                                        echo $contato;
                                                                                                                                                                    } ?>" />


                        </div>
                        <div class="col">
                            <span id="cadEmpresa_tit16" class="texto">Cód. SGSET</span>

                            <input type="text" name="txt_sgset" onclick="cor(this);" maxlength="10" class="cx_numeros form-control" id="cx16_CadEmpresas" value="<?php if (isset($sgset)) {
                                                                                                                                                                        echo $sgset;
                                                                                                                                                                    } ?>" />

                        </div>
                        <div class="col-2">
                            <span id="cadEmpresa_tit25" class="texto">Telefone 2</span>

                            <input type="text" name="txt_telefone2" onclick="cor(this);" maxlength="14" class="cx_telefone form-control" id="cx20_CadEmpresas" value="<?php if (isset($telefone2)) {
                                                                                                                                                                            echo $telefone2;
                                                                                                                                                                        } ?>" />


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <span id="cadEmpresa_tit26" class="texto">Celular</span>

                            <input type="text" name="txt_celular" onclick="cor(this);" maxlength="15" class="cx_celular form-control" id="cx21_CadEmpresas" value="<?php if (isset($celular)) {
                                                                                                                                                                        echo $celular;
                                                                                                                                                                    } ?>" />
                        </div>
                        <div class="col-2">
                            <span id="cadEmpresa_tit24" class="texto">CPF / RG</span>

                            <input type="text" name="txt_cpf" onclick="cor(this);" maxlength="14" class="cx_texto2 form-control" id="cx19_CadEmpresas" value="<?php if (isset($cpf)) {
                                                                                                                                                                    echo $cpf;
                                                                                                                                                                } ?>" />

                        </div>
                    </div>
                    </br>
                    <div class="row">
                        <div class="col ">
                            <!-- --------------------------------- -->
                            <input type="button" onclick="validar();" class="subtitulo2 btn btn-success" id="bt_cadastrou" name="btn_cadastrar" value="Cadastrar" />
                            <!--<input type="button" onclick="validar();" class="subtitulo2" id="bt_cadastrar" name="btn_cadastrar" value="Cadastrar" />-->
                            <input type="hidden" name="txt_cad" />


                            <input type="button" onclick="validar();" class="subtitulo2 btn btn-warning" id="bt_cadastrou" name="btn_atualizar" value="Atualizar" />

                            <input type="button" onclick="validar();" class="btn btn-primary" id="bt_ncadastro_compl" name="btn_atualizar" value="Novo" />


                            <a href="index.php">
                                <div id="bt_ncadastro" class="subtitulo2 btn"><span id="bt_ncadastro_compl">Novo</span></div>
                            </a>
                        </div>
                    </div>



                </form>
            </div>
        </div>
    </div>
</div>
<script src="./App/Views/empresas/js/validacao.js"></script>
<script src="./App/Views/empresas/js/cep.js"></script>
<script>
    $(function() {
        $("#txt_cep").on("focus", function() {
                alert("focus")
            })
            .on("blur", function() {
                alert('1');
            });
    });
</script>