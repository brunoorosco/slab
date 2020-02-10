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
                    <h5>Planos de Atendimento</h5>

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

                    <table class="table" id="tabelaPlano">
                        <thead>
                            <tr>
                                <th>Sequencial</th>
                                <th>Empresa</th>
                                <th>Entrada</th>
                                <th>Valor</th>
                                <th>Situação</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($planos as $plano) :
                                // var_dump($plano->data());
                                //foreach ($atendimento as $norma) :
                                // var_dump($address->data());
                            ?>

                                <tr>
                                    <td class="text-left" scope="row"><?= $plano->Sequencial ?></td>
                                    <td class="text-left" scope="row"><?= $plano->CodNomeEmpr ?></td>
                                    <td class="text-left" scope="row"><?= $plano->DataCadastro ?></td>
                                    <td class="text-left" scope="row"><?= $plano->Status ?></td>
                                    <td class="text-left" scope="row"><?= $plano->Status ?></td>

                                    <td class="text-center">
                                        <a data-id=<?= $plano->Codigo ?> data-toggle="modal" data-target="#orcamentoModal">
                                            <i class="fa fa-eye text-navy"></i>
                                        </a>
                                        <a data-action="<?= url("plano/edit") ?>" data-id=<?= $plano->Codigo ?> data-func="edit">
                                            <i class="fa fa-pencil text-navy"></i>
                                        </a>
                                        <a data-action="<?= url("plano/excluir") ?>" data-id=<?= $plano->Codigo ?> data-func="exc">
                                            <i class="fa fa-trash text-navy"></i>
                                        </a>
                                    </td>
                                </tr>

                            <?php
                            //    endforeach;
                            endforeach; ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="orcamentoModal" tabindex="-1" role="dialog" aria-labelledby="orcamentoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"> </h5>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <thead>
                    <tr class="row justify-content-md-center" style="margin-right: 0px">
                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-3">Descricao do Ensaio</th>
                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-2">Norma</th>
                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-1">Amostras</th>
                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-1">Valor Unitário</th>
                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-1">Valor Total</th>
                        <th class="col-xs-2 col-sm-2 col-md-2 col-lg-1">Desc. (%)</th>
                    </tr>
                </thead>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php $v->start("js"); ?>
<script src="<?= asset('js/sweetalert.min.js') ?>"></script>
<script src="<?= asset('js/datatables.min.js') ?>"></script>

<script>
    $(document).ready(function() {
        $('#tabelaPlano').DataTable({
            "order": [
                [2]
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

        //tratamento do modal 
        $('#orcamentoModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var id = button.data('id') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            modal.find('.modal-title').text('Plano de Atendimento: ' + id)

        })

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
            console.log(data);
            // alert(data.action); //returna -> https://localhost/www/SLAB/empresa/editar
            if (func === "exc") {
                swal({
                        title: "Deseja realmente excluir este plano?",
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
                                type: 'DELETE',

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