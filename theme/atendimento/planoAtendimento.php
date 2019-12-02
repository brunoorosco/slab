<?php $v->layout("layout"); ?>
<div class="container">
    <h3 class="form-group">Plano de Atendimento</h3>
    <form id="formPlano" method="POST" action="<?= url('atendimento/plano')?>" enctype="multipart/form-data">
        <div class="form-group input-group">
            <div class="form-group col">
                <span for="recipient-name" class="control-span">Empresa:</span>
                <input name="nome" type="text" class="form-control" id="name_bat" placeholder="Razão Social">
            </div>
            <div class="form-group col-3">
                <span for="message-text" class="control-span">Data da Solicitação:</span>
                <input name="niver" type="text" class="form-control col data" id="" onkeypress="DataHora(event, this)" placeholder="Quando Solicitado" maxlength="10">
            </div>
        </div>
        <div class="form-group input-group">
            <div class="form-group col-3">
                <span for="recipient-name" class="control-span">CNPJ:</span>
                <input name="nome" type="text" class="form-control text-right" id="name_bat" placeholder="00.000.000/0000-00" maxlength="18">
            </div>
            <div class="form-group col-4">
                <span for="message-text" class="control-span">Endereço:</span>
                <input name="niver" type="text" class="form-control col data" disabled id="" onkeypress="DataHora(event, this)" placeholder="Endereço">
            </div>
            <div class="form-group col-2">
                <span for="message-text" class="control-span">Contato:</span>
                <input name="niver" type="text" class="form-control col data" disabled id="" onkeypress="DataHora(event, this)" placeholder="Resp. Empresa">
            </div>
            <div class="form-group col">
                <span for="message-text" class="control-span">Email:</span>
                <input name="niver" type="text" class="form-control col" disabled id="" onkeypress="DataHora(event, this)" placeholder="Email">
            </div>

        </div>

        <div class="form-group input-group">
           

            <div class="form-group col-3">
                <span for="message-text" class="control-span">Forma da Solicitação:</span>
                <div class="custom-control custom-radio custom-control-inline" style="margin-top:0px">
                    <input type="radio" id="customRadioInline1" checked name="tipoSolicitacao" value="email" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline1">E-mail</Label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline2" name="tipoSolicitacao" value="fax" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline2">Fax</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline" style="margin-top:0px">
                    <input type="radio" id="customRadioInline3" name="tipoSolicitacao" value="fone" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline3">Fone</Label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                    <input type="radio" id="customRadioInline4" name="tipoSolicitacao" value="outros" class="custom-control-input">
                    <label class="custom-control-label" for="customRadioInline4">Outros</label>
                </div>
                <div class="form-group">
                    <input type="text" hidden id="customRadioInline4" name="tipoSolicitacao" class="form-control"/>
                </div>

            </div>
            <div class="form-group col-3">
                <span for="cem" class="control-span">Resp. p/ Atendimento:</span>
                <input name="cem_bat" class="form-control" id="cem_bat" Type="text" placeholder="Login em nome de:">
            </div>
        </div>
        <div class="form-group input-group">

        </div>
        <h5>Serviço a ser Realizado</h5>
        <div class="form-group input-group">
            <div class="col-auto">
                <span class="mr-sm-2" for="inlineFormCustomSelect">Normas</span>
                <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                    <option selected>NBR's</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="form-group col-2">
                <span for="cem" class="control-span">Nº de Amostras:</span>
                <input name="quantamostra" class="form-control" id="quantAmostras" Type="text" placeholder="número de amostras">
            </div>
        </div>
        <div class="form-group input-group">
            <div class="form-group col-2">
                <span for="recipient-name" class="control-span">Previsão da Realização:</span>
                <input name="nome" type="text" class="form-control text-right" id="name_bat" placeholder="00/00/0000" maxlength="10">
            </div>
            <div class="form-group col-2">
                <span for="message-text" class="control-span">Responsável Análise Crítica:</span>
                <input name="niver" type="text" class="form-control col data" disabled id="" onkeypress="DataHora(event, this)" placeholder="Nome">
            </div>
            <div class="form-group col-2">
                <span for="message-text" class="control-span">Resposta ao Cliente:</span>
                <input name="niver" type="text" class="form-control col data" disabled id="" onkeypress="DataHora(event, this)" placeholder="00/00/0000">
            </div>
            <div class="form-group col-2">
                <span for="message-text" class="control-span">Nº Proposta/Sequencial:</span>
                <input name="niver" type="text" class="form-control col" disabled id="" onkeypress="DataHora(event, this)" placeholder="Email">
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
</div>

<script>
    $(this).find('#formPlano')[0].reset();
    $('#cem_bat').autocomplete({
        source: 'retornaCEM.php'
    });
    $('#name_bat').autocomplete({
        source: 'retornaMembro.php',
        minLength: 3
    });
</script>