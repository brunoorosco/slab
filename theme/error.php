<?php $v->layout("_theme");?>

<div class="error">
    <h2>Oooops erro <?= $error;?> !</h2>
      

</div>
<?php $v->start("sidebar"); ?>
<a href="<?=url();?>">Voltar</a>
<?php $v->end(); ?>