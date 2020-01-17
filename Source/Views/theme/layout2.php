<!DOCTYPE html>
<html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?= asset('Favicon.ico') ?>" type="image/x-icon">
   
    <link href='<?= asset('bootstrap/css/bootstrap.min.css') ?>' rel="stylesheet">
    <link href='<?= asset('font-awesome/css/font-awesome.css') ?>' rel="stylesheet">
    
    <!-- Toastr style -->
    <link href="<?= asset('css/plugins/toastr/toastr.min.css') ?>" rel="stylesheet">

    <!-- Gritter -->
    <link href="<?= asset('js/plugins/gritter/jquery.gritter.css') ?>" rel="stylesheet">

    <link href="<?= asset('css/animate.css') ?>" rel="stylesheet">
    <link href="<?= asset('css/style.css') ?>" rel="stylesheet">
    <link href="<?= asset('css/_style.css') ?>" rel="stylesheet">
    <?= $v->section("css"); ?>
    <title><?= $v->e($title) ?></title>
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default  navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img alt="image" class="img-circle" src="<?= asset('img/avatar-2.png')?>" width="45" />
                            </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?= $user->Nome ?></strong>
                                    </span>
                                    <span class="text-light">Assistente de Ensaios <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu profile animated fadeInRight m-t-xs">
                                <li><a href="<?= url('func/conta')?>">Minha Conta</a></li>
                                <li><a href="mailbox.html">Email</a></li>
                                <li class="divider"></li>
                                <li><a href="<?= $router->route("app.logoff"); ?>">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                </ul>


                <nav id="sidebar">





                
                    <ul class="list-unstyled components" id="menumetis">
                        <li>
                            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-th-large"></i> Cadastro</a>
                            <ul class="collapse list-unstyled" id="pageSubmenu">
                                <li><a href="<?= url("comp/add"); ?>">Composições</a></li>
                                <li><a href="<?= url("empresa/add"); ?>">Empresas</a></li>
                                <li><a href="<?= url("func/add"); ?>">Funcionários</a></li>
                                <li><a href="#">Normas</a> </li>
                                <li><a href="../produtos/" class="lk_lista">Produtos</a></li>
                                <li><a href="../ensaios/" class="lk_lista">Tipos de Ensaios</a></li>
                                <li><a href="../tiposTecido/" class="lk_lista">Tipos de Tecidos</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-th-large"></i> Consulta</a>
                            <ul class="collapse list-unstyled" id="homeSubmenu">
                                <li><a href="<?= url("comp"); ?>">Composições</a></li>
                                <li><a href="<?= url("empresa"); ?>">Empresas</a></li>
                                <li><a href="<?= url("ensaio"); ?>">Ensaios</a></li>
                                <li><a href="<?= url("equipamento"); ?>">Equipamentos</a></li>
                                <li><a href="<?= url("func"); ?>">Funcionários</a></li>
                                <li><a href="<?= url("atendimento/plano"); ?>">Plano de Atendimento</a></li>
                                <li><a href="<?= url("norma"); ?>">Normas</a></li>
                                <li><a href="<?= url("orcamento"); ?>">Orçamentos</a></li>
                                <li>
                                    <a href="#">Outros</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?= url("atendimento"); ?>">Plano de Atendimento</a>
                        </li>

                        <li>
                            <a href="<?= url("etiqueta/busca"); ?>">Impressão de Etiquetas</a>
                        </li>

                        <li>
                            <a href="#">Liberação de Pedidos</a>
                        </li>
                        <li>
                            <a href="#relatorioSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"><i class="fa fa-th-large"></i> Relatórios</a>
                            <ul class="collapse list-unstyled" id="relatorioSubmenu">
                                <li><a href="../relatorios/planoAtendimento/" class="lk_lista">Plano de atendimento</a></li>
                                <li><a href="../relatorios/etiquetas/" class="lk_lista">Etiquetas para amostras</a></li>
                                <li><a href="../relatorios/recebimentoItens/" class="lk_lista">Recebimento de itens para ensaio</a></li>
                            </ul>
                        </li>
                    </ul>

                    <ul class="list-unstyled CTAs">
                        <li>
                            <a href="#" class="download">Settings</a>
                        </li>
                    </ul>
                </nav>

                <!-- <li class="">
                        <a href="./empresa/"><i class="fa fa-th-large"></i> <label class="nav-label">Empresas</label> <label class="fa arrow"></label></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="<?= url("empresa"); ?>">Listar</a></li>
                            <li><a href="<?= url("empresa/add"); ?>">Incluir</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="./empresa/"><i class="fa fa-th-large"></i> <label class="nav-label">Composições</label> <label class="fa arrow"></label></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="./empresa/">Listar</a></li>
                            <li><a href="./empresa/incluir/">Incluir</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="./empresa/"><i class="fa fa-th-large"></i> <label class="nav-label">Produtos</label> <label class="fa arrow"></label></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="<?= url("empresa"); ?>">Listar</a></li>
                            <li><a href="<?= url("empresa/add"); ?>">Incluir</a></li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="./empresa/"><i class="fa fa-th-large"></i> <label class="nav-label">Serviços</label> <label class="fa arrow"></label></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="./empresa/">Listar</a></li>
                            <li><a href="./empresa/incluir/">Incluir</a></li>
                        </ul>
                    </li>
                </ul> -->
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
            <div class="row border-bottom">
                <nav class="navbar col" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        <form role="search" class="navbar-form-custom" action="search_results.html">
                            <div class="form-group">
                                <input type="text" placeholder="Procurando algo..." class="form-control" name="top-search" id="top-search">
                            </div>
                        </form>
                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>
                            <span class="m-r-sm text-muted welcome-message">Bem Vind@ ao System LAB-S</span>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-envelope"></i> <span class="label label-warning">16</span>
                            </a>
                            <ul class="dropdown-menu dropdown-messages">
                                <li class="divider"></li>
                                <li>
                                    <div class="text-center link-block">
                                        <a href="mailbox.html">
                                            <i class="fa fa-envelope"></i> <strong>Ler todas as mensagens</strong>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                <i class="fa fa-bell"></i> <span class="label label-primary">8</span>
                            </a>
                            <ul class="dropdown-menu dropdown-alerts">
                                <li>
                                    <a href="mailbox.html">
                                        <div>
                                            <i class="fa fa-envelope fa-fw"></i> você tem XX mensagens
                                            <span class="pull-right text-muted small">4 minutes ago</span>
                                        </div>
                                    </a>
                                </li>
                                <li class="divider"></li>
                            </ul>
                        </li>


                        <li>
                            <a href="<?= $router->route("app.logoff"); ?>">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>
                        <li>
                            <a class="right-sidebar-toggle">
                                <i class="fa fa-tasks"></i>
                            </a>
                        </li>
                    </ul>

                </nav>
            </div>


            <div class="row border-bottom dashboard-header">
                <?= $v->section("content"); ?>
            </div>

        </div>

        <div id="small-chat">

            <span class="badge badge-warning pull-right">5</span>
            <a class="open-small-chat">
                <i class="fa fa-comments"></i>

            </a>
        </div>
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">

                    <li class="active"><a data-toggle="tab" href="#tab-1">
                            Notes
                        </a></li>
                    <li><a data-toggle="tab" href="#tab-2">
                            Projects
                        </a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">
                            <i class="fa fa-gear"></i>
                        </a></li>
                </ul>

                <div class="tab-content">


                    <div id="tab-1" class="tab-pane active">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                            <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                        </div>

                        <div>

                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="img/a1.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">

                                        Exemplo para uso futuro
                                        <br>
                                        <small class="text-muted">hoje 16:21 </small>
                                    </div>
                                </a>
                            </div>



                        </div>

                    </div>

                    <div id="tab-2" class="tab-pane">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <ul class="sidebar-list">


                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Orçamento para Empresa XYZ</h4>
                                    Desenvolvendo plano de atendimento!

                                    <div class="small">Progresso: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>


                        </ul>

                    </div>

                    <div id="tab-3" class="tab-pane">

                        <div class="sidebar-title">
                            <h3><i class="fa fa-gears"></i> Settings</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <div class="setings-item">
                            <span>
                                Show notifications
                            </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                    <label class="onoffswitch-label" for="example">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>
                                Disable Chat
                            </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                                    <label class="onoffswitch-label" for="example2">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>
                                Enable history
                            </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                    <label class="onoffswitch-label" for="example3">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>
                                Show charts
                            </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                    <label class="onoffswitch-label" for="example4">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>
                                Offline users
                            </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                    <label class="onoffswitch-label" for="example5">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>
                                Global search
                            </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                    <label class="onoffswitch-label" for="example6">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                            <span>
                                Update everyday
                            </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                    <label class="onoffswitch-label" for="example7">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>

            </div>

        </div>

    </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?= asset('js/jquery-3.4.1.js')?>"></script>

    <script src="<?= asset('js/popper.js')?>"></script>
    <script src="<?= asset('bootstrap/js/bootstrap.min.js')?>"></script>


    <script src="<?= asset('js/plugins/metisMenu/jquery.metisMenu.js')?>"></script>
    <script src="<?= asset('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>

    <!-- Peity -->
    <script src="<?= asset('js/plugins/peity/jquery.peity.min.js')?>"></script>
    <script src="<?= asset('js/demo/peity-demo.js')?>"></script>

    <!-- Custom and plugin javascript -->
    <!-- <script src="js/inspinia.js"></script> -->
    <script src="<?= asset('js/plugins/pace/pace.min.js')?>"></script>

    <!-- jQuery UI -->
    <script src="<?= asset('js/plugins/jquery-ui/jquery-ui.min.js')?>"></script>

    <!-- GITTER -->
    <script src="<?= asset('js/plugins/gritter/jquery.gritter.min.js')?>"></script>

    <!-- Sparkline -->
    <script src="<?= asset('js/plugins/sparkline/jquery.sparkline.min.js')?>"></script>

    <!-- Sparkline demo data  -->
    <script src="<?= asset('js/demo/sparkline-demo.js')?>"></script>

    <!-- Toastr -->
    <script src="<?= asset('js/plugins/toastr/toastr.min.js')?>"></script>

    <?= $v->section("js"); ?>


    <script>
        $(document).ready(function() {
          

            // Add body-small class if window less than 768px
            if ($(this).width() < 769) {
                $('body').addClass('body-small')
            } else {
                $('body').removeClass('body-small')
            }



            // $('#menumetis').metisMenu({
            //     toggle: true // disable the auto collapse. Default: true.
            // });

        });
    </script>
</body>

</html>