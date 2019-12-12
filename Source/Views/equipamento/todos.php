<?php $v->layout("layout2"); ?>

<?php $v->start("css"); ?>
<link rel="stylesheet" href="<?= url('Source/assests/css/datatables.css'); ?>">

<?php $v->end(); ?>

<div class="container">
    <div class="ajax_load"></div>

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Equipamentos</h5>

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

                    <table class="table" id="tabelaEquipamento">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nome</th>
                                <th>Nº Equip.</th>
                                <th>Fabricante</th>
                                <th>Per. calibração</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php
                          
                            foreach ($equips as $equi) :

                                ?>
                             
                                <tr>
                                    <td class="text-left" scope="row"><?= $equi->Codigo ?></td>
                                    <td class="text-left" scope="row"><?= $equi->Nome ?></td>
                                   <td class="text-left" scope="row"><?= $equi->Nequipamento ?></td>
                                    <td class="text-left" scope="row"><?= $equi->Fabricante ?></td>
                                    <td class="text-left" scope="row"><?= $equi->PeriodCalibracao ?></td>
                                    <td>
                                        <!--<a href="<?= url("empresa/") . $equi->Codigo ?>/editar">
                                        <i class="fa fa-pencil text-navy"></i>
                                    </a>-->
                                        <a data-action="<?= url("empresa/") ?>/editar" data-id=<?= $equi->Codigo ?>>
                                            <i class="fa fa-pencil text-navy"></i>
                                        </a>
                                        <a data-action="<?= url("empresa/excluir") ?>" data-id=<?= $equi->Codigo ?> data-nome=<?= $func->Nome ?>>
                                            <i class="fa fa-trash text-navy"></i>
                                        </a>
                                        <!-- <a href="<?= url("empresa/") . $func->Codigo ?>/excluir">
                                        <i class="fa fa-trash text-navy"></i>
                                    </a> -->
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
<script src="js/sweetalert.min.js"></script>
<script src="js/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tabelaEquipamento').DataTable({
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
        })


    })
</script>

<?php $v->end(); ?>