<?php $v->layout("layout2"); ?>
<!-- EDIÇÃO DE ENSAIOS -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">

            <?php $v->layout("title"); ?>
            
                <div class="ibox-content">
                    <div class="ajax_load" style="display: none"></div>
                    <form class="form-horizontal" id="form_cadEnsaio" action="<?= url('ensaio/edit') ?>" method="post">
                        <input hidden name="Codigo" value="<?= $ensaio->Codigo  ?>" />
                        <div class="row form-group">
                            <div class="col-2">
                                <label class="">Cód. Ensaio</label>
                                <input type="text" name="codEnsaio" id="codEnsaio" value="<?= $ensaio->CodEnsaio  ?>" placeholder="" class="form-control ">
                            </div>
                            <div class="col">
                                <label class="">Ensaio</label>
                                <input type="text" name=ensaio id="razao" value="<?= $ensaio->Nome  ?>" placeholder="" class="form-control">
                            </div>
                            <div class="col-2">
                                <label class="">Qt. Horas</label>
                                <input type="text" name="qtHoras" value="<?= $ensaio->Carga  ?>" placeholder="" class="form-control">
                            </div>


                        </div>
                        <!-- FORMULÁRIO DE CADASTRO DE EMPRESA -->
                        <div class="row form-group">
                            <div class="col-2">
                                <label class="control-label">Preço - R$</label>
                                <input type="text" name="preco" class="form-control money2" id="cx4_CadEmpresas " value="<?= $ensaio->Preco ?>" />

                            </div>
                            <div class="col-1">
                                <label class=" control-label">Status</label>
                                <input type="text" name="status" maxlength="200" class="form-control" id="txt_email" value="<?= $ensaio->Status ?>" />
                            </div>

                            <div class="col-2">
                                <label class="control-label">Norma</label>

                                <div class="input-group">
                                    <div class="input-group-append">
                                        <input type="text" name="nomeNorma" class="form-control" id="nomeNorma" value="<?= $norma->Nome  ?>" placeholder="Sem Norma"/>
                                    </div>
                                </div>
                            </div>


                        </div>
                        </br>
                        <div class="row">
                            <div class="col ">
                                <button class="btn btn-primary" id="bt_atualizar" name="btn_atualizar">Atualizar</button>
                                <input type="button" class="btn btn-success" id="bt_novo" name="bt_novo" value="Novo" />
                                <input type="button" class="btn btn-secondary" id="bt_cancelar" name="btn_cancelar" value="Voltar" onclick="document.location ='<?= url('ensaio') ?>'" />
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


        $("#form_cadEnsaio").submit(function(e) {
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
            document.getElementById("form_cadEnsaio").reset();//funciona
          
            //     // Apesar do botão estar com o type="button", é prudente chamar essa função para evitar algum comportamento indesejado
            //     e.preventDefault();
            //  //   window.location.href = __DIR__;
            //     document.location='/www/slab/ensaio';
        })

    });
</script>
<?php $v->end(); ?>