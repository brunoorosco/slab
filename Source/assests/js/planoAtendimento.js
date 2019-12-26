var pathname = window.location.pathname; // Retorna só o path
var url = window.location.href;     // Retorna a url completa

$(document).ready(function () {

    var pathname = window.location.pathname; // Retorna só o path
    var url = window.location.href;     // Retorna a url completa
    // console.log("url: " + url)

    $(".calculo").bind("keyup", Calcular);

    /**VARIAVEIS DE LEITURA E CONFIGURAÇÃO DO SCRIPT */
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
    $("#dataFinal").datepicker(option).val();
    $("#dataResposta").datepicker(option).val();

    var hoje = moment().format('DD/MM/YYYY');

    $('form input').on('keypress', function (e) {
        return e.which !== 13;
    });

    $('#adicionar').bind('click', Adicionar);
    $(".btnEditar").bind("click", Editar);
    $(".btnSalvar").bind("click", Salvar);
    $(".btnExcluir").bind("click", Excluir);

    $('.ensaio').on('change', function (e) {
        e.preventDefault();
        var form = $(this).val();
        var celula = $(this).parent().index('td');
        var tr = $(this).parent().parent().index('tr');
        carregarNorma(form, celula);
    })


    $('#pesquisar').on('click', function (e) {

        // Apesar do botão estar com o type="button", é prudente chamar essa função para evitar algum comportamento indesejado
        e.preventDefault();

        // Aqui recuperamos o cnpj preenchido do campo e usamos uma expressão regular para limpar da string tudo aquilo que for diferente de números
        var cnpj = $('#cnpj').val();
        cnpj = cnpj.replace(/\D/g, '');

        // Fazemos uma verificação simples do cnpj confirmando se ele tem 14 caracteres
        if (cnpj.length == 14) {

            // Aqui rodamos o ajax para a url da API concatenando o número do CNPJ na url
            $.ajax({
                url: url + '/empresa',
                type: 'POST',
                data: {
                    cnpj: cnpj
                },
                dataType: 'json', // Em requisições AJAX para outro domínio é necessário usar o formato "jsonp" que é o único aceito pelos navegadores por questão de segurança
                complete: function (xhr) {

                    // Aqui recuperamos o json retornado
                    response = xhr.responseJSON;
                    // console.log(response);
                    if (response != null) {

                        // Na documentação desta API tem esse campo status que retorna "OK" caso a consulta tenha sido efetuada com sucesso
                        if (xhr.statusText == 'OK') {

                            dataFinal = moment().add(7, 'days').format('DD/MM/YYYY');
                            // Agora preenchemos os campos com os valores retornados
                            $('#empresa').val(response.Nome);
                            $('#codEmpresa').val(response.Codigo);
                            $('#endereco').val(response.Endereco + ', ' + response.Numero);
                            $('#email').val(response.Email);
                            $('#contato').val(response.Contato);

                            $("#dataInicial").val(hoje);
                            $("#dataFinal").val(dataFinal);
                            $("#dataSolicitacao").val(hoje);
                            $("#dataResposta").val(hoje);

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
        source: function (request, response) {
            $.ajax({
                type: "post",
                url: url + "autocomplete/",
                dataType: "json",
                data: {
                    acao: $('#empresa').val()
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        focus: function (event, ui) {
            $("#empresa").val(ui.item.titulo);
            carregarDados();
            return false;
        },
        select: function (event, ui) {
            $("#empresa").val(ui.item.titulo);
            return false;
        }
    })
        .autocomplete("instance")._renderItem = function (ul, item) {
            return $("<li>")
                .append("<a><b>Código de Barra: </b>" + item.codigo_barra + "<br><b>Título: </b>" + item.titulo + " - <b> Categoria: </b>" + item.categoria + "</a><br>")
                .appendTo(ul);
        };


    $(this).find('#formPlano')[0].reset();

    $('#norma').autocomplete({
        source: 'retornaCEM.php'
    });

    $('#name_bat').autocomplete({
        source: 'retornaMembro.php',
        minLength: 3
    });

    function Adicionar() {
        var id = $('#tb_pedidos tbody tr').length;
        id++;
        $("#tb_pedidos tbody").append(
            '<tr class="row justify-content-md-center" style="margin-right: 0px">' +
            '<td class="col-xs-2 col-sm-2 col-md-2 col-lg-3 ">' +
            '<select class="custom-select mr-sm-2 resultEnsaio" id="selLinha_' + id + '">' +
            '</select>' +
            '<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >' +
            '<select class="custom-select mr-sm-2" id="tpNorma_' + id + '" ></select>' +
            '</td>' +
            '<td class="col-xs-2 col-sm-2 col-md-2 col-lg-1"><input name="quantAmostra" class="form-control text-center number calculo" id="quantAmostra_' + id + '" Type="text"></td>' +
            '<td class="col-xs-2 col-sm-2 col-md-2 col-lg-1"><input name="precoUnit" class="form-control text-right calculo money2" id="precoUnit_' + id + '" Type="text"></td>' +
            '<td class="col-xs-2 col-sm-2 col-md-2 col-lg-1"><input name="precoTotal" class="form-control money text-right" id="precoTotal_' + id + '" Type="text" placeholder="R$ 0.00" disabled></td>' +
            '<td class="col-xs-2 col-sm-2 col-md-2 col-lg-1"><input type="text" name="desc" id="desc_' + id + '" class="form-control"></td>' +
            '<td class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-center p-3">' +
            '<i class="fa fa-save text-navy mr-2 btnSalvar" style="cursor:pointer"></i>' +
            '<i class="fa fa-trash text-navy btnExcluir" style="cursor:pointer"></i>' +
            '</td>' +
            '</tr>');

        $(".btnSalvar").bind("click", Salvar);
        $(".calculo").bind("keyup", Calcular);
        $(".btnExcluir").bind("click", Excluir);
        $(".resultEnsaio").bind('change', Ensaio);

        $.ajax({
            url: url + '/autoEnsaio',
            type: "POST",
            dataType: "json",
        })
            .done(function (callback) {
                for (i = 0; i < callback.length; i++) {
                    $('.resultEnsaio').append('<option value=' + callback[i].Codigo + '>' + callback[i].nome + '</option>');
                }
                //teste();
            })

        // console.log('O valor de' + total);
        //$('#precoTotal_' + id).val(total);
        var linhas = $('#tb_pedidos tbody tr').length;
        valorTotal = 0;
        // console.log("linhas: " + linhas)
        for (var i = linhas; linhas <= i; i--) {
            // console.log($('#precoTotal_' + id).val())
            var valorTotal = + parseInt($('#precoTotal_' + id).val());
        }

        $('#valorTotal').val(valorTotal);
    }

    function Editar() {
        console.log("função editar")
        var par = $(this).parent().parent(); //tr
        var tdEnsaio = par.children("td:nth-child(1)");
        var tdNorma = par.children("td:nth-child(2)");
        var tdAmostra = par.children("td:nth-child(3)");
        var tdPreco = par.children("td:nth-child(4)");
        var tdTotal = par.children("td:nth-child(5)");
        var tdDesconto = par.children("td:nth-child(6)");
        var tdBotoes = par.children("td:nth-child(7)");

        tdEnsaio.children("Select").prop('disabled', false);
        tdNorma.html(tdNorma.children("Select").prop('disabled', false));
        tdAmostra.children("input[type=text]").prop('disabled', false);
        tdPreco.children("input[type=text]").prop('disabled', false);
        tdDesconto.children("input[type=text]").prop('disabled', false);

        // tdEnsaio.html("<select type='text' id='txtEnsaio' value='" + tdEnsaio.html() + "'/>");
        // tdNorma.html("<select class='custom-select mr-sm-2' id='tpNorma' name='tpNorma'><option Selected>" + tdNorma.html() + "</option></select>");
        // tdAmostra.html("<input type='text' class='form-control text-center number calculo' id='txtAmostra' value='" + tdAmostra.html() + "'/>");
        // tdPreco.html("<input type='text'   class='form-control money text-right' id='txtPreco' value='" + tdPreco.html() + "'/>");
        // tdTotal.html("<input type='text'   class='form-control money text-right  id='txtTotal' value = '" + tdTotal.html() + "' /  disabled> ");
        // tdDesconto.html("<input type='text' class='form-control' id='txtDesconto'  value='" + tdDesconto.html() + "'/>");
        tdBotoes.html('<i class="fa fa-save text-navy mr-2 btnSalvar" style="cursor:pointer"></i>' +
            '<i class="fa fa-trash text-navy btnExcluir" style="cursor:pointer"></i>');

        $(".btnSalvar").bind("click", Salvar);
        $(".btnEditar").bind("click", Editar);
        $(".btnExcluir").bind("click", Excluir);
    }

    function Salvar() {
        var par = $(this).parent().parent(); //tr
        var tdEnsaio = par.children("td:nth-child(1)");
        var tdNorma = par.children("td:nth-child(2)");
        var tdAmostra = par.children("td:nth-child(3)");
        var tdPreco = par.children("td:nth-child(4)");
        var tdTotal = par.children("td:nth-child(5)");
        var tdDesconto = par.children("td:nth-child(6)");
        var tdBotoes = par.children("td:nth-child(7)");

        tdEnsaio.children("Select").prop('disabled', true);
        tdNorma.html(tdNorma.children("Select").prop('disabled', true));
        tdAmostra.children("input[type=text]").prop('disabled', true);
        tdPreco.children("input[type=text]").prop('disabled', true);
        tdDesconto.children("input[type=text]").prop('disabled', true);

        console.log("ensaio:" + tdEnsaio.children('Select').val()) //mostra valor codigo de Ensaio
        console.log("Norma:" + tdNorma.children('Select').val()) //mostra valor codigo da NOrma
        console.log("Numero de Amostra:" + tdAmostra.children('input').val()) //mostra valor codigo da NOrma
        console.log("Numero de Preco:" + tdPreco.children('input').val()) //mostra valor codigo da NOrma
        //tdEnsaio.html(tdEnsaio.children("Select").val());
        //tdNorma.html(tdNorma.children("Select").val());
        //tdAmostra.html(tdAmostra.children("input[type=text]").val());
        //tdPreco.html(tdPreco.children("input[type=text]").val());
        //tdTotal.html(tdTotal.children("input[type=text]").val());
        // tdDesconto.html(tdDesconto.children("input[type=text]").val());
        tdBotoes.html('<i class="fa fa-pencil text-navy mr-2 btnEditar"></i>' +
            '<i class="fa fa-trash text-navy btnExcluir"></i>');

        $(".btnEditar").bind("click", Editar);
        $(".btnExcluir").bind("click", Excluir);
        $(".btnSalvar").bind("click", Salvar);
    };

    function Excluir() {
        var par = $(this).parent().parent(); //tr
        par.remove();
    };

    function Ensaio() {
        var par = $(this).parent().parent(); //tr
        var tdEnsaio = par.children("td:nth-child(1)");
        var tdNorma = par.children("td:nth-child(2)");
        var tdAmostra = par.children("td:nth-child(3)");
        var tdPreco = par.children("td:nth-child(4)");
        var tdTotal = par.children("td:nth-child(5)");
        var tdDesconto = par.children("td:nth-child(6)");
        var tdBotoes = par.children("td:nth-child(7)");

        var valor = tdEnsaio.children('Select').val();


        $.ajax({
            url: url + '/auto',
            data: {
                'data': valor
            },
            type: "POST",
            dataType: "json",
        })
            .done(function (callback) {
                norma = callback.nome+'/'+callback.ano;
                precoUnitario = callback.valor;

                console.log(callback)

                // };
            })
            .fail(function (callback) {

            })
        //LIMPA AS OPÇÕES PARA INSERIR NOVAS
        tdNorma.children('Select').html('');
        tdPreco.children('input').html('');
        
        //INSERI NOVAS OPÇÕES PARA INSERIR NOVAS
        tdNorma.children('Select').append($("<option selected></option>").text(norma));
        tdPreco.children('input').val(precoUnitario) //mostra valor codigo da NOrma
        
        console.log("linha: " + par)
        console.log("ensaio:" + valor) //mostra valor codigo de Ensaio
        console.log("Numero de Amostra:" + tdAmostra.children('input').val()) //mostra valor codigo da NOrma
    

    }

});

function teste(select, val) {
    console.log(val)
    let td = val.index('td');
    let tr = val.parent().index('tr');
    let trvalor = val;
    var quant = parseInt(td) + 1;

    //console.log((document.getElementById("tb_pedidos").rows[tr].cells[0].innerHTML));
    //    var x = document.getElementById("tb_pedidos").rows[tr].cells;
    //    x[1].innerHTML = "teste";

    //console.log('linha: ' + tr + '  celula:' + quant + '  valor:' + select);
    carregarNorma(select, tr);
}

function carregarNorma(valor, celula) {
    var id = $('#tb_pedidos tbody tr').length;
    // console.log(id)
    $.ajax({
        url: url + '/auto',
        data: {
            'data': valor
        },
        type: "POST",
        dataType: "json",
    })
        .done(function (callback) {
            //console.log(callback.nome + '- ' + celula);
            // $('td[celula] select').val('teste');
            //  $("#tb_pedidos tbody tr[2] td[2]:input").val(callback.nome);
            //          var x = document.getElementById("tb_pedidos").rows[celula].cells;
            //        x[1].innerHTML = callback.nome + '/' + callback.ano;

            $("#tpNorma_" + id).html('');
            $("#precoUnit_" + id).val('');
            // $('#tpNorma').val(callback.nome);           
            $("#tpNorma_" + id).append($("<option selected></option>").text(callback.nome).val(callback.Codigo));
            $("#precoUnit_" + id).val(callback.valor);

            // };
        })
        .fail(function (callback) {
            $("#tpNorma_" + id).html('');
            $("#precoUnit_" + id).val('');
            //  console.log("falha");
        })
    Calcular();
}

// function carregaEnsaio() {
//     $.ajax({
//         url: url + '/autoEnsaio',
//         type: "POST",
//         dataType: "json",
//     })
//         .done(function (callback) {
//             // console.log(callback.nome);
//             $("#tpNorma_1").html('');
//             // $('#tpNorma').val(callback.nome);           
//             $("#tpNorma_1").append($("<option selected></option>").text(callback.nome).val(callback.Codigo));
//             $("#precoUnit_1").val(callback.valor);

//             // };
//         })
//         .fail(function (callback) {
//             $("#tpNorma_1").html('');
//         })
// }

function Calcular() {

    var par = $(this).parent().parent(); //tr
    var tdEnsaio = par.children("td:nth-child(1)");
    var tdNorma = par.children("td:nth-child(2)");
    var tdAmostra = par.children("td:nth-child(3)");
    var tdPreco = par.children("td:nth-child(4)");
    var tdTotal = par.children("td:nth-child(5)");
    var tdDesconto = par.children("td:nth-child(6)");
    var tdBotoes = par.children("td:nth-child(7)");

    console.log("linha: " + par)
    console.log("ensaio:" + tdEnsaio.children('Select').val()) //mostra valor codigo de Ensaio
    console.log("Norma:" + tdNorma.children('Select').val()) //mostra valor codigo da NOrma
    console.log("Numero de Amostra:" + tdAmostra.children('input').val()) //mostra valor codigo da NOrma
    console.log("Numero de Preco:" + tdPreco.children('input').val()) //mostra valor codigo da NOrma

    var id = $(this).attr('id');

    if (id != null) {

        // id = id.filter(Number).join("");
        // id = id.replace(/[^\d]+/g,'')
        var somente_numeros = id.replace(/\D+/g, "");

        console.log('calcular: ' + somente_numeros)

        var unitario = $('#precoUnit_' + id).val();
        //   unitario.toString().replace("." , ",");

        unitario = parseInt(unitario.replace(/\D/g, ''));
        console.log(unitario);

        var quant = parseInt($('#quantAmostra_' + id).val());
        console.log(quant);

        if (isNaN(unitario))
            unitario = 0

        if (isNaN(quant))
            quant = 0


        var total = (unitario * quant) / 100;


        var total = total.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
    }
}