<?php $v->layout("layout2"); ?>

<?php $v->start("css"); ?>
<style>
  .ui-autocomplete {
		position: absolute;
		z-index: 2150000000 !important;
		cursor: default;
		border: 2px solid #ccc;
		padding: 5px 0;
		border-radius: 2px;
		font-size:15px;
		font-family: 'Oswald', sans-serif;
        list-style-type: none;
        background-color: whitesmoke;
	}

.custom-control-input:checked ~ .custom-control-label::before {
		color: #fff;
		border-color: #7B1FA2;
		background-color: #7B1FA2;
	}

	.min-height-100 { 
        min-height: 50px; 
        margin: 5px 5px 5px 5px;
        border-radius: 8px;
        background-color: #0099ff;
		color:#ffffff;  
         }
  </style>

<?php $v->end(); ?>

<div class="container">
    <h3 class="form-group">Plano de Atendimento</h3>
    <form id="formPlano" method="POST" action="<?= url('atendimento/plano') ?>" enctype="multipart/form-data">
        <div class=" input-group">
            <div class="form-group col-2">
                <span for="message-text" class="control-span">Nº Proposta/Sequencial:</span>
                <input name="nProposta" type="text" class="form-control col" disabled id="" onkeypress="DataHora(event, this)" placeholder="Nº Proposta">
            </div>
            <div class="form-group col-2">
                <span for="recipient-name" class="control-span">CNPJ:</span>
                <input name="cnpj" type="text" class="form-control text-right" id="cnpj" placeholder="00.000.000/0000-00" maxlength="18">
            </div>
            <div class="form-group col">
                <span for="empresa" class="control-span">Empresa:</span>
                <input name="empresa" type="text" class="form-control" id="empresa" placeholder="Razão Social">
            </div>
            <div class="form-group col-2">
                <span for="message-text" class="control-span">Data da Solicitação:</span>
                <input name="solicitacao" type="text" class="form-control date" id="" placeholder="Quando Solicitado">
            </div>
        </div>
        <div class="input-group">

            <div class="form-group col-4">
                <span for="message-text" class="control-span">Endereço:</span>
                <input name="endereco" type="text" class="form-control" disabled id="" placeholder="Endereço">
            </div>
            <div class="form-group col-2">
                <span for="message-text" class="control-span">Contato:</span>
                <input name="contato" type="text" class="form-control" disabled id="" placeholder="Resp. Empresa">
            </div>
            <div class="form-group col">
                <span for="message-text" class="control-span">Email:</span>
                <input name="email" type="text" class="form-control" disabled id="" placeholder="Email">
            </div>

        </div>

        <div class="input-group">
            <div class=" col-3">
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
            <div class="col-3">
                <span for="cem" class="control-span">Resp. p/ Atendimento:</span>
                <input name="cem_bat" class="form-control" id="cem_bat" Type="text" placeholder="Login em nome de:">
            </div>
            <div class="form-group col-2">
                <span for="recipient-name" class="control-span">Previsão da Realização:</span>
                <input name="nome" type="text" class="form-control date" id="name_bat" placeholder="00/00/0000" maxlength="10">
            </div>
            <div class="form-group col-2">
                <span for="message-text" class="control-span">Resposta ao Cliente:</span>
                <input name="niver" type="text" class="form-control col date" disabled id="" onkeypress="DataHora(event, this)" placeholder="00/00/0000">
            </div>
            <div class="form-group col-2">
                <span for="message-text" class="control-span">Resp. Análise Crítica:</span>
                <input name="niver" type="text" class="form-control" disabled id="" onkeypress="DataHora(event, this)" placeholder="Nome">
            </div>
        </div>


        <div class="input-group">
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
</div>

<?php $v->start("js"); ?>
<script src="js/sweetalert.min.js"></script>
<script src="js/jquery.mask.min.js"></script>
<script src="js/maskara.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
   $( function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    $( "#empresa" ).autocomplete({
      source: availableTags
    });
  } );

    $(this).find('#formPlano')[0].reset();
    $('#cem_bat').autocomplete({
        source: 'retornaCEM.php'
    });
    $('#name_bat').autocomplete({
        source: 'retornaMembro.php',
        minLength: 3
    });
</script>
<?php $v->end(); ?>