<?php $v->layout("layout2"); ?>
<!-- CADASTRO DE EMPRESAS -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>
                        Editar Empresa -  <?=   $empresa->Nome        ?>
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
                    <div class="ajax_load" style="display: none"></div>
                    <form class="form-horizontal" id="form_cadEmpresas" action="<?= url('empresa/add') ?>" method="post">

                        <div class="row form-group">
                            <div class="col-2 input-group">
                                <label class="">CNPJ</label>
                                <div class="input-group">
                                    <input type="text" name="cnpj" id="cnpj" value="<?php //($incluindo ? null : $dados->razao_social); 
                                                                                    ?>" placeholder="00.000.000/0001-00" class="form-control ">
                                    <div class="input-group-append">
                                        <button class="btn btn-success" id="pesquisar" type="button"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-1">
                                <label class="">Cód. Cliente</label>

                                <input type="text" name="codCliente" value="" placeholder="" class="form-control">
                            </div>

                            <div class="col">
                                <label class="">Razão Social</label>

                                <input type="text" name="razao_social" id="razao" value="<?php //($incluindo ? null : $dados->razao_social); 
                                                                                            ?>" placeholder="" class="form-control">
                            </div>


                        </div>
                        <!-- FORMULÁRIO DE CADASTRO DE EMPRESA -->
                        <div class="row form-group">
                            <div class="col-2">
                                <label class="control-label">Insc. Estadual</label>

                                <input type="text" name="txt_ie" class="form-control" id="cx4_CadEmpresas " value="<?php if (isset($ie)) {
                                                                                                                        echo $ie;
                                                                                                                    } ?>" />

                            </div>
                            <div class="col-3">
                                <label class=" control-label">E-mail</label>

                                <input type="text" name="txt_email" maxlength="200" class="form-control" id="txt_email" value="<?php if (isset($email)) {
                                                                                                                                    echo $email;
                                                                                                                                } ?>" />

                                <!-- ----------------------------------------------------------------------- -->

                            </div>
                            <div class="col-2">
                                <label class="control-label">CEP</label>

                                <input type="text" name="txt_cep" class="form-control cep" id="txt_cep" value="<?php if (isset($cep)) {
                                                                                                                    echo $cep;
                                                                                                                } ?>" />

                                <!-- ----------------------------------------------------------------------- -->

                            </div>



                            <div class="col">
                                <label id="cadEmpresa_tit6" class="">Endereço</label>

                                <input type="text" name="txt_endereco" maxlength="100" class="form-control" id="txt_endereco" value="<?php if (isset($endereco)) {
                                                                                                                                            echo $endereco;
                                                                                                                                        } ?>" />


                            </div>
                            <div class="col-1">
                                <label id="cadEmpresa_tit7" class="texto">Número</label>

                                <input type="text" name="txt_numero" maxlength="10" class="form-control" id="txt_numero" value="<?php if (isset($numero)) {
                                                                                                                                    echo $numero;
                                                                                                                                } ?>" />

                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-3">
                                <label id="cadEmpresa_tit8" class="texto">Cidade</label>

                                <input type="text" name="txt_cidade" maxlength="50" class="form-control" id="txt_cidade" value="<?php if (isset($cidade)) {
                                                                                                                                    echo $cidade;
                                                                                                                                } ?>" />

                            </div>
                            <div class="col-3">
                                <label id="cadEmpresa_tit9" class="texto">Bairro</label>

                                <input type="text" name="txt_bairro" maxlength="50" class="form-control" id="txt_bairro" value="<?php if (isset($bairro)) {
                                                                                                                                    echo $bairro;
                                                                                                                                } ?>" />

                            </div>
                            <div class="col-1"><label id="cadEmpresa_tit10" class="texto">Estado</label>

                                <input type="text" name="txt_estado" class="form-control" id="txt_estado" maxlength="2" value="<?php if (isset($estado)) {
                                                                                                                                    echo $estado;
                                                                                                                                } ?>" />

                                <!-- ------------------------------------------------------------------------- -->
                            </div>
                            <div class="col">
                                <label id="cadEmpresa_tit15" class="texto">Contato</label>

                                <input type="text" name="txt_contato" maxlength="200" class="form-control" id="cx15_CadEmpresas" value="<?php if (isset($contato)) {
                                                                                                                                            echo $contato;
                                                                                                                                        } ?>" />


                            </div>

                        </div>
                        <div class="row form-group">
                            <div class="col-2">
                                <label id="cadEmpresa_tit12" class="texto">Telefone 1</label>

                                <input type="text" name="txt_telefone" maxlength="14" class="form-control" id="txt_telefone1" value="<?php if (isset($telefone)) {
                                                                                                                                            echo $telefone;
                                                                                                                                        } ?>" />


                            </div>
                            <div class="col-1">
                                <label id="cadEmpresa_tit13" class="texto">Ramal</label>

                                <input type="text" name="txt_ramal" maxlength="10" class="form-control" id="cx13_CadEmpresas" value="<?php if (isset($ramal)) {
                                                                                                                                            echo $ramal;
                                                                                                                                        } ?>" />

                            </div>
                            <div class="col-2">
                                <label id="cadEmpresa_tit14" class="texto">FAX</label>

                                <input type="text" name="txt_fax" class="form-control" id="cx14_CadEmpresas" value="<?php if (isset($fax)) {
                                                                                                                        echo $fax;
                                                                                                                    } ?>" />

                            </div>


                            <div class="col-2">
                                <label id="cadEmpresa_tit25" class="texto">Telefone 2</label>

                                <input type="text" name="txt_telefone2" maxlength="15" class="form-control" id="txt_telefone2" value="<?php if (isset($telefone2)) {
                                                                                                                                            echo $telefone2;
                                                                                                                                        } ?>" />


                            </div>
                            <div class="col-2">
                                <label id="cadEmpresa_tit26" class="texto">Celular</label>

                                <input type="text" name="txt_celular" maxlength="15" class="form-control cel" id="cx21_CadEmpresas" value="<?php if (isset($celular)) {
                                                                                                                                                echo $celular;
                                                                                                                                            } ?>" />
                            </div>
                        </div>
                        <div class="row form-group">

                            <div class="col-2">
                                <label id="cadEmpresa_tit24" class="texto">CPF / RG</label>

                                <input type="text" name="txt_cpf" maxlength="14" class="form-control" id="cpf" value="<?php if (isset($cpf)) {
                                                                                                                            echo $cpf;
                                                                                                                        } ?>" />

                            </div>
                            <div class="col-1">
                                <label id="cadEmpresa_tit16" class="texto">Cód. SGSET</label>

                                <input type="text" name="txt_sgset" maxlength="10" class="form-control" id="cx16_CadEmpresas" value="<?php if (isset($sgset)) {
                                                                                                                                            echo $sgset;
                                                                                                                                        } ?>" />

                            </div>
                        </div>
                        </br>
                        <div class="row">
                            <div class="col ">
                                <!-- --------------------------------- -->
                                <button class="btn btn-success" id="bt_cadastrou" name="btn_cadastrar">Cadastrar</button>
                                <!--<input type="button" onclick="validar();" class="subtitulo2" id="bt_cadastrar" name="btn_cadastrar" value="Cadastrar" />-->

                                <input type="button" class="btn btn-warning" id="bt_cadastrou" name="btn_atualizar" value="Atualizar" />

                            </div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $v->start("js"); ?>
<script src="./App/Views/empresas/js/validacao.js"></script>
<script src="./App/Views/empresas/js/cep.js"></script>
<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script src="js/maskara.js"></script>

<script>
    $(document).ready(function() {

        $.ajax({
            url: "edit",
            method: 'post',
            dataType: 'jsonp', // Em requisições AJAX para outro domínio é necessário usar o formato "jsonp" que é o único aceito pelos navegadores por questão de segurança
            complete: function(xhr) {

                // Aqui recuperamos o json retornado
                response = xhr.responseJSON;
                console.log(xhr)
                // Na documentação desta API tem esse campo status que retorna "OK" caso a consulta tenha sido efetuada com sucesso
                if (response.status == 'OK') {

                    // Agora preenchemos os campos com os valores retornados
                    $('#razao').val(response.nome);
                    $('#txt_email').val(response.email);
                    $('#txt_endereco').val(response.logradouro);

                    $('#txt_numero').val(response.numero);
                    $('#txt_bairro').val(response.bairro);

                    $('#txt_estado').val(response.uf);
                    $('#logradouro').val(response.logradouro);
                    cep = response.cep;
                    $('#txt_cep').val(cep.replace('.', ''));


                    $('#txt_estado').val(response.uf);
                    $('#txt_cidade').val(response.municipio);

                    tel = response.telefone;
                    tels = tel.split("/");
                    tels.sort();
                    $('#txt_telefone1').val(tels[0]);
                    $('#txt_telefone2').val(tels[1]);


                    // Aqui exibimos uma mensagem caso tenha ocorrido algum erro
                } else {
                    swal(response.message, "", "error"); // Neste caso estamos imprimindo a mensagem que a própria API retorna
                }
            }
        })


        $("#form_cadEmpresas").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                    url: form.attr("action"),
                    data: form.serialize(),
                    type: "POST",
                    dataType: "json",
                })
                .done(function(callback) {

                    swal({
                        title: callback.message,
                        text: " ",
                        icon: 'success',
                        timer: 3000
                    });
                    $('#form_cadEmpresas')[0].reset();

                }).fail(function(callback) {
                    console.log("chegou em fail")
                })
            //     beforeSend:function(callback){
            //          load("open");
            //     },
            //     success:function(callback){
            //         swal(callback.message, "", callback.action); // Neste caso estamos imprimindo a mensagem que a própria API retorna
            //       console.log(callback);
            //        if(callback.message){
            //            $('.ajax_load').html(callback.message).fadeIn();
            //        }else{
            //         ajax_load.fadeOut(function(){
            //             $(this).html("");
            //        });
            //        }
            //     },
            //     complete:function(){
            //          load("close");
            //     }
            // })

        })

        $('#pesquisar').on('click', function(e) {

            // Apesar do botão estar com o type="button", é prudente chamar essa função para evitar algum comportamento indesejado
            e.preventDefault();

            // Aqui recuperamos o cnpj preenchido do campo e usamos uma expressão regular para limpar da string tudo aquilo que for diferente de números
            var cnpj = $('#cnpj').val();
            cnpj = cnpj.replace(/\D/g, '');

            // Fazemos uma verificação simples do cnpj confirmando se ele tem 14 caracteres
            if (cnpj.length == 14) {

                // Aqui rodamos o ajax para a url da API concatenando o número do CNPJ na url
                $.ajax({
                    url: 'https://www.receitaws.com.br/v1/cnpj/' + cnpj,
                    method: 'GET',
                    dataType: 'jsonp', // Em requisições AJAX para outro domínio é necessário usar o formato "jsonp" que é o único aceito pelos navegadores por questão de segurança
                    complete: function(xhr) {

                        // Aqui recuperamos o json retornado
                        response = xhr.responseJSON;

                        // Na documentação desta API tem esse campo status que retorna "OK" caso a consulta tenha sido efetuada com sucesso
                        if (response.status == 'OK') {

                            // Agora preenchemos os campos com os valores retornados
                            $('#razao').val(response.nome);
                            $('#txt_email').val(response.email);
                            $('#txt_endereco').val(response.logradouro);

                            $('#txt_numero').val(response.numero);
                            $('#txt_bairro').val(response.bairro);

                            $('#txt_estado').val(response.uf);
                            $('#logradouro').val(response.logradouro);
                            cep = response.cep;
                            $('#txt_cep').val(cep.replace('.', ''));


                            $('#txt_estado').val(response.uf);
                            $('#txt_cidade').val(response.municipio);

                            tel = response.telefone;
                            tels = tel.split("/");
                            tels.sort();
                            $('#txt_telefone1').val(tels[0]);
                            $('#txt_telefone2').val(tels[1]);


                            // Aqui exibimos uma mensagem caso tenha ocorrido algum erro
                        } else {
                            swal(response.message, "", "error"); // Neste caso estamos imprimindo a mensagem que a própria API retorna
                        }
                    }
                });

                // Tratativa para caso o CNPJ não tenha 14 caracteres
            } else {
                swal("CNPJ Inválido!", "", "error");
            }
        });
    });
</script>
<?php $v->end(); ?>