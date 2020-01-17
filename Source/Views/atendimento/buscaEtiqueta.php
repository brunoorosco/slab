<?php $v->layout("theme/layout2"); ?>


<?php $v->start("css"); ?>
<link rel="stylesheet" href="<?= asset('etiqueta.css'); ?>">
<?php $v->end(); ?>

<div class="container-fluid">
    <div class="form-transparente ">
        <span class="header-text text-center" id="ini_tit4">
            <h3>Consulta e Impressão de Etiquetas</h3>
        </span>
        <div class="form_ajax" style="display:none"></div>
        <form action="" method="POST">
            <div class="form-group row">
                <label for="planoAtendimento" class="col-sm-12 ">Plano de Atendimento Nº</label>
                <div class="col-sm-12">
                    <input type="email" class="" id="planoAtendimento" placeholder="Nº do Plano de Atendimento">
                </div>
            </div>
            <div class="form-group row">
                <label for="inputPassword3" class="col-sm-12 ">Etiquetas</label>
                <div class="col-sm-12">
                    <select name="ensaio" id="ensaio">
                        <option disable selected>Choose...</option>
                        <option>...</option>
                    </select>
                    <input type="password" class="" id="inputPassword3" placeholder="Ensaio">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <button type="submit">Imprimir</button>
                </div>
            </div>
        </form>


    </div>
</div>

<?php $v->start("js"); ?>
<script>
    $(function() {
        function load(action) {
            var load_div = $("ajax_load");
            if (action === "open") {
                load_div.fadeIn().css("display", "flex");
            } else {

            }
        }
    })
    //constriur o ajax aqui
</script>
<?php $v->end(); ?>