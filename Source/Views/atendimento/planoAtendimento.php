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
                    <input name="nProposta" type="text" class="form-control col" disabled id="" onkeypress="DataHora(event, this)" placeholder="Nº Proposta">
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
                        <input type="radio" id="customRadioInline1" checked name="tipoSolicitacao" value="email" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline1">E-mail</Label>
                    </div>
                    <div class="custom-control custom-radio ">
                        <input type="radio" id="customRadioInline2" name="tipoSolicitacao" value="fax" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline2">Fax</label>
                    </div>
                    <div class="custom-control custom-radio " style="margin-top:0px">
                        <input type="radio" id="customRadioInline3" name="tipoSolicitacao" value="fone" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline3">Fone</Label>
                    </div>
                    <div class="custom-control custom-radio ">
                        <input type="radio" id="customRadioInline4" name="tipoSolicitacao" value="outros" class="custom-control-input">
                        <label class="custom-control-label" for="customRadioInline4">Outros</label>
                    </div>
                    <div class="form-group">
                        <input type="text" hidden id="customRadioInline4" name="tipoSolicitacao" class="form-control" />
                    </div>

                </div>
                <div class="col-2">
                    <label for="cem" class="control-span">Resp. p/ Atendimento</label>
                    <input name="responsavel" class="form-control" id="responsavel" Type="text" placeholder="Login em nome de:">
                </div>
                <div class="form-group col">
                    <label for="recipient-name" class="control-span">Previsão da Inicial</label>
                    <input name="dataRealiza" type="text" class="form-control date text-right" id="dataInicial" placeholder="00/00/0000" maxlength="10">
                </div>
                <div class="form-group col">
                    <label for="recipient-name" class="control-span">Previsão da Final</label>
                    <input name="dataRealiza" type="text" class="form-control date text-right" id="dataFinal" placeholder="00/00/0000" maxlength="10">
                </div>
                <div class="form-group col">
                    <label for="message-text" class="control-span">Resposta ao Cliente</label>
                    <input name="dataResposta" type="text" class="form-control col text-right" id="dataResposta" placeholder="00/00/0000">
                </div>
                <div class="form-group col">
                    <label for="message-text" class="control-span">Resp. Análise Crítica</label>
                    <input name="niver" type="text" class="form-control" disabled id="" onkeypress="DataHora(event, this)" placeholder="Nome">
                </div>
            </div>


            <div class="input-group">
                <h5>Serviço a ser Realizado</h5>
                <div class="form-group input-group">
                    <div class="col-auto">
                        <label class="mr-sm-2" for="inlineFormCustomSelect">Normas</label>
                        <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                            <option selected>NBR's</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="form-group col-2">
                        <label for="cem" class="control-span">Nº de Amostras:</label>
                        <input name="quantamostra" class="form-control" id="quantAmostras" Type="text" placeholder="número de amostras">
                    </div>
                </div>
                <div class="input-group">


                </div>

            </div>
            <input name="id_bat" type="hidden" class="form-control" id="id-batizado" value="">
            <div class="modal-footer btn-group " role="group">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-ligth btn-block" data-dismiss="modal">Cancelar</button>
                </div>
                <div class="btn-group" role="group">
                    <button type="submit" class="btn btn-success btn-block" name="formulario" value="editar">Salvar</button>
                </div>
            </div>
        </form>
    </div></div>
</div>

<?php $v->start("js"); ?>
<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script src="js/maskara.js"></script>
<script src="js/moment.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function() {

        var option = {
            uiLibrary: 'bootstrap4',
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
            dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
            monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'
        };


        $("#dataRealiza").datepicker(option).val();
        $("#dataSolicitacao").datepicker(option).val();
        $("#dataInicial").datepicker(option).val();
        $("#datafinal").datepicker(option).val();

        var hoje = moment().format('L');

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
                    url: window.location.pathname,
                    method: 'POST',
                    data: {
                        cnpj: cnpj
                    },
                    dataType: 'json', // Em requisições AJAX para outro domínio é necessário usar o formato "jsonp" que é o único aceito pelos navegadores por questão de segurança
                    complete: function(xhr) {

                        // Aqui recuperamos o json retornado
                        response = xhr.responseJSON;
                        // console.log(response);
                        if (response != null) {

                            // Na documentação desta API tem esse campo status que retorna "OK" caso a consulta tenha sido efetuada com sucesso
                            if (xhr.statusText == 'OK') {

                                // Agora preenchemos os campos com os valores retornados
                                $('#empresa').val(response.Nome);
                                $('#endereco').val(response.Endereco + ', ' + response.Numero);
                                $('#email').val(response.Email);
                                $('#contato').val(response.Contato);

                                $("#dataInicial").val(hoje);
                                $("#dataFinal").val(hoje);
                                $("#dataSolicitacao").val(hoje);

                                // Aqui exibimos uma mensagem caso tenha ocorrido algum erro
                            } else {
                                swal(response.message, "", "error"); // Neste caso estamos imprimindo a mensagem que a própria API retorna
                            }
                        } else {
                            swal("CNPJ Não Encontrado!", "", "error");
                        }
                    }
                });

                // Tratativa para caso o CNPJ não tenha 14 caracteres
            } else {
                swal("CNPJ Inválido!", "", "error");
            }
        });




        // $('#empresa').autocomplete({ source: "../../busca/"});       

        // Dispara o Autocomplete a partir do segundo caracter
        $("#empresa").autocomplete({
                minLength: 2,
                source: function(request, response) {
                    $.ajax({
                        type: "post",
                        url: "../../autocomplete/",
                        dataType: "json",
                        data: {
                            acao: $('#empresa').val()
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                focus: function(event, ui) {
                    $("#empresa").val(ui.item.titulo);
                    carregarDados();
                    return false;
                },
                select: function(event, ui) {
                    $("#empresa").val(ui.item.titulo);
                    return false;
                }
            })
            .autocomplete("instance")._renderItem = function(ul, item) {
                return $("<li>")
                    .append("<a><b>Código de Barra: </b>" + item.codigo_barra + "<br><b>Título: </b>" + item.titulo + " - <b> Categoria: </b>" + item.categoria + "</a><br>")
                    .appendTo(ul);
            };


        $(this).find('#formPlano')[0].reset();

        $('#cem_bat').autocomplete({
            source: 'retornaCEM.php'
        });

        $('#name_bat').autocomplete({
            source: 'retornaMembro.php',
            minLength: 3
        });
    });
</script>
<?php $v->end(); ?>