<?php $v->layout("layout2");?>

<div class="users">
    <?php if ($users):
        foreach($users as $user):
            ?>
        <article class="users_user">
            <h3><?= $user->first_name," ",$user->last_name;?></h3>
        </article>
        <?php
        endforeach;
    else:
        ?>
        <h4>Não existem usuários cadasatrados!</h4>
        <?php
        endif;
        ?>

</div>