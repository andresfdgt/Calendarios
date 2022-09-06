@extends('layouts.core')
@section('add-head')
@endsection
@section('contenido')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Cuentas</h4>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (auth()->user()->existPermission(101))
                            <div class="form-group">
                                <a href="/cuentas/vincular"> <button type="button"
                                        class="btn btn-primary waves-effect waves-light" _msthash="2770885"
                                        _msttexthash="118105">Vincular
                                        cuenta</button>
                                </a>
                            </div>
                        @endif
                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-sm"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Email</th>
                                    <th>id_account</th>
                                    <th>Imagen</th>
                                    <th>Email Verficado</th>
                                    <th>Fecha registro</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

    </div>
@endsection
@section('add-scripts')
    <script>
        $(document).ready(function() {
            $("#datatable").DataTable({
                "destroy": true,
                "ajax": {
                    url: "{{ route('cuentas') }}"
                },
                "deferRender": true,
                "retrieve": true,
                "processing": true,
                "responsive": true,
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
        $(document).on("click", ".eliminar", function() {
            let id = $(this).attr("id");
            Swal.fire({
                title: "Esta seguro de eliminar esta cuenta",
                text: "¡Si no lo está puede cancelar la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.value) {
                    axios.delete("{{ route('cuentas') }}/" + id)
                        .then(function(response) {
                            $("#datatable").DataTable().ajax.reload();
                            var data = response.data
                            Swal.fire({
                                icon: data.status,
                                title: data.title,
                                text: data.message,
                            });
                        })
                }
            })
        })
    </script>
@endsection
