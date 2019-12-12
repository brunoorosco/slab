<?php $v->layout("_theme"); ?>

<?php $v->start("css"); ?>

<?php $v->end(); ?>

<section id="cover" class="min-vh-200">
    <div id="cover-caption">
        <div class="container" style="margin-top: 10vh;">
            <div class="row text-white">
                <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                    <h4 class="display-4 py-2 text-truncate">Acesso ao S-Lab</h4>
                    <h4 class="display-4 py-2 text-truncate"><?= $autentic ?></h4>
                    <div class="px-2">
                        <form action="<?= url("login")?>" method="post" class="justify-content-center">
                            <div class="form-group">
                                <label class="sr-only">Usuário</label>
                                <input type="text" name="user"class="form-control" placeholder="Usuário">
                            </div>
                            <div class="form-group">
                                <label class="sr-only">Senha</label>
                                <input type="password" name="senha" class="form-control" placeholder="Senha">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 
<div class="container">
    <div class="row">
        <form class="login">
            <div class="card" style="width: 25rem;">
                <img src="../assests/img/lab.jpg" class="card-img-top" width="50" alt="...">
                <div class="form-group">
                    <h5 class="card-title">Login</h5>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="text-left">Usuário</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha</label>
                        <input type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-primary">Submit</button>

                        <div class="col s8 right-align">
                            <a href="#" class="">Esqueci a senha</a>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div> -->


<?php $v->start("js"); ?>
<!--Import jQuery before materialize.js-->
<?php $v->end(); ?>