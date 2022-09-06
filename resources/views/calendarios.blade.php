@extends('layouts.core')
@section('add-head')
@endsection
@section('contenido')
    <div class="container-fluid">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Calendarios</h4>
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
                        <div class="form-group">
                            <button type="button" data-toggle="modal" data-target="#modalCrearCalendario"
                                class="btn btn-primary waves-effect waves-light" _msthash="2770885"
                                _msttexthash="118105">Nuevo
                                calendario</button>
                        </div>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-sm"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Nombre</th>
                                    <th width="300" style="width: 300px !important">Descripción</th>
                                    <th>Color</th>
                                    <th>Eventos</th>
                                    <th>Fecha registro</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <thead>
                                <tr id="filterRow">
                                    <th class="filterColumn">item</th>
                                    <th class="filterColumn">nombre</th>
                                    <th class="filterColumn" width="300" style="width: 300px !important">descripción</th>
                                    <th class="filterColumn">color</th>
                                    <th class="filterColumn">eventos</th>
                                    <th class="filterColumn">fecha registro</th>
                                    <th class="filterColumn">opciones</th>
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
    <div class="modal fade" id="modalCrearCalendario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="needs-validation" novalidate id="nuevoCalendario" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="exampleModalLabel">Crear calendario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" class="form-control" id="" required>
                            <div class="invalid-feedback">
                                ¡El nombre es obligatorio!
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="validationCustom01">Color</label>
                                <select class="form-control" name="color" required>
                                    @foreach ($colores as $color)
                                        <option value="{{ $color->id }}"
                                            style="color: {{ $color->hexadecimal }};font-weight:bold">
                                            {{ $color->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    ¡El color es obligatorio!
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea name="descripcion" class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="registrarCalendario" class="btn btn-success">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEditarCalendario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form class="needs-validation" novalidate id="editarCalendario" method="post">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title mt-0" id="exampleModalLabel">Editar calendario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="hidden" name="id" id="id" required>
                            <input type="text" name="nombre" class="form-control" id="nombre" required>
                            <div class="invalid-feedback">
                                ¡El nombre es obligatorio!
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label for="validationCustom01">Color</label>
                                <select class="form-control" name="color" id="color" required>
                                    @foreach ($colores as $color)
                                        <option value="{{ $color->id }}"
                                            style="color: {{ $color->hexadecimal }};font-weight:bold">
                                            {{ $color->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    ¡El color es obligatorio!
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control"></textarea>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="actualizarCalendario" class="btn btn-success">Editar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="exampleModalLabel">Eventos del calendario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="eventos">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered mb-0">
                            <thead>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Color</th>
                                <th>Archivos</th>
                                <th>Colaboradores</th>
                            </thead>
                            <tbody>
                                <tr v-if="eventos.length==0">
                                    <td colspan="7" class="text-center">No hay eventos en el momento</td>
                                </tr>
                                <template v-else>
                                    <tr v-for="eve,index in eventos">
                                        <td>@{{ index + 1 }}</td>
                                        <td>@{{ eve.nombre }}</td>
                                        <td>@{{ eve.descripcion }}</td>
                                        <td>@{{ eve.fecha_inicio }}</td>
                                        <td>@{{ eve.fecha_fin }}</td>
                                        <td>@{{ eve.color }}</td>
                                        <td v-html="eve.archivos"></td>
                                        <td v-html="eve.colaboradores"></td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('add-scripts')
    <script>
        var vue_app = new Vue({
            el: "#eventos",
            data: {
                eventos: [],
            }
        });

        $(document).ready(function() {
            var table = $("#datatable").DataTable({
                initComplete: function () {
                    var api = this.api();
                    console.log('this.api(): ', "#filterRow");
                    $('.filterColumn', "#filterRow").each( function () {
                        var title = $(this).text();
                        $(this).html('<input type="text" placeholder="Buscar '+title+'" class="form-control form-control-sm column-search"/>');
                    });
                },
                "destroy": true,
                "ajax": {
                    url: "{{ route('calendarios') }}"
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

            $(document).on('keyup', ".column-search",function () {
                table.column( $(this).parent().index()).search(this.value).draw();
            });
        });

        $(document).on("click", ".editar", function() {
            let id = $(this).attr("id");
            $.ajax({
                type: "get",
                url: "/calendarios/editar/" + id,
                dataType: "json",
                success: function(response) {
                    $("#id").val(response.id);
                    $("#nombre").val(response.nombre);
                    $("#color").val(response.color_id);
                    $("#descripcion").val(response.descripcion);
                    $("#modalEditarCalendario").modal("show");
                }
            });
        })

        $(document).on("click", ".eliminar", function() {
            let id = $(this).attr("id");
            Swal.fire({
                title: "Esta seguro de eliminar esta calendario",
                text: "¡Si no lo está puede cancelar la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.value) {
                    axios.delete("{{ route('calendarios') }}/" + id).then(function(response) {
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

        $(document).on("click", ".eventos", function() {
            @if (auth()->user()->existPermission(153))
                let id = $(this).attr("id");
                $.ajax({
                    type: "get",
                    url: "/calendarios/eventos/" + id,
                    dataType: "json",
                    success: function(response) {
                        vue_app.eventos = response;
                        $("#modalEventos").modal("show");
                    }
                });
            @else
                Swal.fire({
                    icon: "error",
                    title: "Acceso denegado",
                    text: "No tienes permisos para ver eventos"
                });
            @endif
        });

        $("#nuevoCalendario").submit(function(e) {
            e.preventDefault();
            $('#nuevoCalendario').addClass('was-validated');
            if ($('#nuevoCalendario')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                $.ajax({
                    type: "post",
                    url: "{{ route('calendarios.store') }}",
                    data: new FormData($('#nuevoCalendario')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#registrarCalendario").html(
                            "<i class='fa fa-spinner fa-pulse'></i><span class='sr-only'> Registrando...</span>Registrando..."
                        );
                        $("#registrarCalendario").attr("disabled", true);
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#registrarCalendario").html("Crear");
                        $("#registrarCalendario").removeAttr("disabled");
                        if (data.status == "success") {
                            $("#modalCrearCalendario").modal("hide");
                            $("#datatable").DataTable().ajax.reload();
                            $('#nuevoCalendario').removeClass('was-validated');
                            $("#nuevoCalendario")[0].reset();
                        }
                        Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.message
                        });
                    }
                });
            }
        });

        $("#editarCalendario").submit(function(e) {
            e.preventDefault();
            $('#editarCalendario').addClass('was-validated');
            if ($('#editarCalendario')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                $.ajax({
                    type: "post",
                    url: "{{ route('calendarios.update') }}",
                    data: new FormData($('#editarCalendario')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#actualizarCalendario").html(
                            "<i class='fa fa-spinner fa-pulse'></i><span class='sr-only'> Guardando...</span>Registrando..."
                        );
                        $("#actualizarCalendario").attr("disabled", true);
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#actualizarCalendario").html("Editar");
                        $("#actualizarCalendario").removeAttr("disabled");
                        if (data.status == "success") {
                            $("#modalEditarCalendario").modal("hide");
                            $("#datatable").DataTable().ajax.reload();
                            $('#editarCalendario').removeClass('was-validated');
                            $("#editarCalendario")[0].reset();
                        }
                        Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.message
                        });
                    }
                });
            }
        });
    </script>
@endsection
