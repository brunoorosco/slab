<?php $v->layout("layout2"); ?>

<?php $v->start("css"); ?>
<link rel="stylesheet" href="<?= url('Source/assests/css/datatables.css'); ?>">

<?php $v->end(); ?>

<div class="alert-info">
    <h1>
        Minha Conta
    </h1>
    <input class="form-control" type="text" id="text" />
    <button class="btn btn-danger" id="btn">
        TESTE
    </button>
</div>

<?php $v->start("js"); ?>
<script>
    $(document).ready(function() {

              $('#btn').on('click', function(){
                var valor = $('#text').val();
                  alert(valor+ '  | PRAIA');
              })
            })
</script>

<?php $v->end(); ?>