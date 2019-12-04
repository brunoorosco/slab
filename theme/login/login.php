<?php $v->layout("layout",['title' => 'User Profile']); ?>

<title>teste</title>
<div id="principal">
    <span class="subtitulo2" id="aut_tit1"><?php echo ('Área de acesso'); ?></span>

    <!-- FORMULï¿½RIO DE AUTENTICAï¿½ï¿½O -->
    <div class="row">
        <form name="frm_autenticacao" method="post" action="<?= url().'/autenticar';?>">
            <span class="texto3" id="aut_tit4"><?php echo ('Versão 1.0.0'); ?></span>
            <div class="form-group">
                <span class="texto" id="aut_tit2"><?php echo ('Usuário:'); ?></span>
                <input class="cx_texto1 form-control" id="tx_aut1" name="txt_usuario" type="text" />
            </div>
            <div class="form-group">
                <span class="texto" id="aut_tit3">Senha:</span>
                <input class="cx_texto1 form-control" id="tx_aut2" name="txt_senha" type="password" />
            </div>
            <div class="form-group">
                <button class="texto2 form-control btn btn-primary" id="aut_enviar" type="submit">Entrar</button>
                <a href="#" id="aut_lk" class="texto">Esqueci a minha senha</a>
            </div>

        </form>
    </div>
    <!--////////////////////////// -->

</div>