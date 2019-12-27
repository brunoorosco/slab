<?php $v->layout("layout2"); ?>
<!-- EDIÇÃO DE ENSAIOS -->

<div class="container">
     <div class=" row">
        <div class="col-md-6 offset-md-3">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>
                        Editar Equipamento - <?= $equipamento->Nome  ?>
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
                <div class="ibox-content content-center">
                    <div class="ajax_load" style="display: none"></div>
                    <form class="form-horizontal" id="formEquip" action="<?= url('equipamento/edit') ?>" method="post">
                        <input hidden name="Codigo" value="<?= $equipamento->Codigo  ?>" />
                        <div class="row form-group">
                            <div class="form-group col">
                                <label for="message-text" class="control-span">Equipamento:</label>
                                <div class="input-group">
                                    <input name="norma" type="text" class="form-control" id="norma" value="<?= $equipamento->Nome ?>">
                                    <input name="anoNorma" type="text" class="form-control col-4" value="<?= $equipamento->ano ?>" placeholder="Ano">
                                </div>
                            </div>

                        </div>
                        <!-- FORMULÁRIO DE CADASTRO DE EMPRESA -->
                        <div class="row form-group">
                            <div class="form-group col">
                                <select class="form-control" id="statusNorma" name="statusNorma">
                                    <option selected disabled>Status</option>
                                    <option value="1">Ativa</option>
                                    <option value="0">Desativa</option>
                                </select>
                            </div>
                        </div> </br>
                        <div class="row form-group">
                            <div class="col">
                                <button class="btn btn-primary" id="bt_atualizar" name="btn_atualizar">Atualizar</button>
                                <input type="button" class="btn btn-success" id="bt_novo" name="bt_novo" value="Novo" />
                                <input type="button" class="btn btn-secondary" id="bt_cancelar" name="btn_cancelar" value="Voltar" onclick="document.location ='<?= url('equipamento') ?>'" />
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

        // $.ajax({
        //     url: "edit",
        //     method: 'post',
        //     dataType: 'jsonp', // Em requisições AJAX para outro domínio é necessário usar o formato "jsonp" que é o único aceito pelos navegadores por questão de segurança
        //     complete: function(xhr) {

        //         // Aqui recuperamos o json retornado
        //         response = xhr.responseJSON;
        //         console.log(xhr)
        //         // Na documentação desta API tem esse campo status que retorna "OK" caso a consulta tenha sido efetuada com sucesso
        //         if (response.status == 'OK') {

        //             // Agora preenchemos os campos com os valores retornados
        //             $('#razao').val(response.nome);
        //             $('#txt_email').val(response.email);
        //             $('#txt_endereco').val(response.logradouro);

        //             $('#txt_numero').val(response.numero);
        //             $('#txt_bairro').val(response.bairro);

        //             $('#txt_estado').val(response.uf);
        //             $('#logradouro').val(response.logradouro);
        //             cep = response.cep;
        //             $('#txt_cep').val(cep.replace('.', ''));


        //             $('#txt_estado').val(response.uf);
        //             $('#txt_cidade').val(response.municipio);

        //             tel = response.telefone;
        //             tels = tel.split("/");
        //             tels.sort();
        //             $('#txt_telefone1').val(tels[0]);
        //             $('#txt_telefone2').val(tels[1]);

        //             // Aqui exibimos uma mensagem caso tenha ocorrido algum erro
        //         } else {
        //             swal(response.message, "", "error"); // Neste caso estamos imprimindo a mensagem que a própria API retorna
        //         }
        //     }
        // })


        $("#formEquip").submit(function(e) {
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
                        icon: callback.action,
                        timer: 3000
                    });
                    // $('#form_cadEmpresas')[0].reset();

                }).fail(function(callback) {
                    swal({
                        title: callback.message,
                        text: " ",
                        icon: callback.action,
                        timer: 3000
                    });
                })

        })

        $('#bt_novo').on('click', function(e) {
            console.log("teste");
            document.getElementById("formEquip").reset(); //funciona

            //     // Apesar do botão estar com o type="button", é prudente chamar essa função para evitar algum comportamento indesejado
            //     e.preventDefault();
            //  //   window.location.href = __DIR__;
            //     document.location='/www/slab/ensaio';
        })

    });
</script>
<?php $v->end(); ?>