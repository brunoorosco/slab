<?php $v->layout("theme/_theme"); ?>

<?php $v->start("css"); ?>
<link href="<?= asset('css/style.css') ?>" rel="stylesheet">

<?php $v->end(); ?>

<section id="cover" class="min-vh-200">
    <div id="cover-caption">
        <div class="container" style="margin-top: 10vh;">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h4 class="display-4 py-2 text-truncate">Acesso ao S-Lab </h4>

                    <div class="px-2">
                        <div class="login_form_callback">
                            <?= flash(); ?>
                        </div>
                        <form class="form" action="<?= $router->route("auth.login"); ?>" class="justify-content-center" method="post" autocomplete="off">
                            <div class="form-group">
                                <label class="sr-only">Usuário</label>
                                <input type="text" name="user" class="form-control" placeholder="Usuário">
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Senha</label>
                                <input type="password" name="passwd" class="form-control" placeholder="Senha">
                            </div>
                            <button type="submit" class="btn btn-success btn-lg">Entrar</button>
                            <div class="rec">
                                <a href="<?= $router->route("web.forget"); ?>" title="Recuperar Senha">Recuperar Senha</a>
                            </div>
                        </form>
                        <br>
                        <!-- <div class="text-danger " id="error"><?= $error ?></div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php $v->start("scripts"); ?>
<script src="<?= asset("js/form.js"); ?>"></script>

<?php $v->end(); ?>