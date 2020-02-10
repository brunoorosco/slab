<?php $v->layout(SITE['theme']); ?>

<?php $v->start("css"); ?>

<link rel="stylesheet" href="<?= asset('css/datatables.css'); ?>">

<?php $v->end(); ?>

<div class="container-fluid">
    <div class="ajax_load"></div>

    <div class="row">
        <div class="col-lg-12">

            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Empresas</h5>

                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <table class="table" id="tabelaEmpresa">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Empresa</th>
                                <th>Telefone</th>
                                <th>CNPJ</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($empresas as $empresa) :
                                $array = explode('/', $empresa->Email); // função para pegar só o primeiro email
                                if (strlen($empresa->CNPJ) == 14) {
                                    $cnpj = vsprintf("%s%s.%s%s%s.%s%s%s/%s%s%s%s-%s%s", str_split($empresa->CNPJ));
                                } else $cnpj = $empresa->CNPJ;
                            ?>

                                <tr>
                                    <td class="text-left" scope="row"><?= $empresa->Codigo ?></td>
                                    <td class="text-left" scope="row"><?= $empresa->Nome ?></td>
                                    <!--<td class="text-left" scope="row"><?= $array[0] ?></td>-->
                                    <td class="text-left" scope="row"><?= $empresa->Telefone ?></td>
                                    <td class="text-left cnpj" id="cnpj" scope="row"><?= $cnpj ?></td>
                                    <td class="text-center">

                                        <a data-action="<?= url("empresa/edit") ?>" data-id=<?= $empresa->Codigo ?> data-func="edit">
                                            <i class="fa fa-pencil text-navy"></i>
                                        </a>
                                        <a data-action="<?= url("empresa/excluir") ?>" data-id=<?= $empresa->Codigo ?> data-nome=<?= $empresa->Nome ?> data-func="exc">
                                            <i class="fa fa-trash text-navy"></i>
                                        </a>

                                    </td>
                                </tr>

                            <?php
                            endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<?php $v->start("js"); ?>
<script src="<?= asset('js/sweetalert.min.js') ?>"></script>
<script src="<?= asset('js/datatables.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        $('#tabelaEmpresa').DataTable({
            "order": [
                [0, "desc"]
            ], //o primeiro argumento serve pra selecionar a coluna e o segundo para informa se decrecente ou crescente
            "language": {
                "lengthMenu": "Mostrar _MENU_ itens p/ Pág.",
                "zeroRecords": "Não foi possivel encontrar nenhum registro",
                "info": "Exibindo _PAGE_ de _PAGES_",
                "infoEmpty": " ",
                "infoFiltered": "",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Próximo",

                }
            },

        });

        function load(action) {
            var load_div = $(".ajax_load");
            if (action === "open") {
                load_div.fadeIn().css("display", "flex");

            } else {
                load_div.fadeOut();
            }
        }

        $("body").on("click", "[data-action]", function(e) {
            e.preventDefault();
            var data = $(this).data();
            var div = $(this).parent().parent();

            var tr = $(this).closest('tr');
            var id = $(this).data('id');

            var func = $(this).data('func');
            // console.log(func);
            // alert(data.action); //returna -> https://localhost/www/SLAB/empresa/editar
            if (func === "exc") {
                swal({
                        title: "Deseja realmente excluir a empresa?",
                        text: data.nome,
                        icon: "warning",
                        buttons: {
                            cancel: {
                                text: "Cancel",
                                value: null,
                                visible: true,
                                className: "",
                                closeModal: true,
                            },
                            confirm: {
                                text: "OK",
                                value: true,
                                visible: true,
                                className: "",
                                closeModal: true,

                            },
                        },
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            $.ajax({
                                url: data.action,
                                data: data,
                                type: 'POST',

                            }).done(function(resp) {

                                tr.fadeOut('slow', function() {});

                            }).fail(function(resp) {

                            })
                        }
                    })
            } else {
                window.location.href = data.action + '/' + data.id;
            }
        })


    })
</script>

<?php $v->end(); ?>