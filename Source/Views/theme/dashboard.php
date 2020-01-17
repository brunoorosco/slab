<?php $v->layout("theme/sidebar"); ?>

<div class="page">
    <?php if ($user->photo): ?>
        <img class="page_user_photo" src="<?= $user->photo; ?>" alt="<?= $user->Nome; ?>" title="<?= $user->Nome; ?>"/>
    <?php endif; ?>
    <h1>Olá <?= $user->Nome; ?>,</h1>
    <p>Aqui é sua conta no projeto, mas por enquanto a única coisa que você pode fazer é sair dela :P</p>
    <p><a class="btn btn-green" href="<?= $router->route("app.logoff"); ?>" title="Sair agora">SAIR AGORA :)</a></p>
</div>
