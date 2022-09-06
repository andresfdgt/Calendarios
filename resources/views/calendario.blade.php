@extends('layouts.core')
@section('pre-head')
    <!--calendar css-->
    <link href="{{ asset('plugins/fullcalendar/packages/core/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/fullcalendar/packages/daygrid/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/fullcalendar/packages/bootstrap/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/fullcalendar/packages/timegrid/main.css') }}" rel="stylesheet" />
    <link href="{{ asset('plugins/fullcalendar/packages/list/main.css') }}" rel="stylesheet" />
@endsection
@section('add-head')
    <link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            margin-top: 7px;
            background-color: #506ee4;
            border: 1px solid #ffffff;
            color: #fff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #fff !important;
        }

        .select2-container--default .select2-selection--multiple {
            background-color: white !important;
            border: 1px solid #e8ebf3 !important;
            border-radius: 4px !important;
            cursor: text !important;
        }

        .select2-container--default.select2-container--open.select2-container--below .select2-selection--single,
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            padding: 0 6px !important;
        }

        .select2-dropdown {
            background-color: white;
            border: 1px solid #e8ebf3;
        }

        .select2-results__option {
            padding: 6px 12px;
            user-select: none;
            -webkit-user-select: none;
        }

        .canvas {
            border: 1px solid #e8ebf3;
            border-radius: .25rem;
        }

        .toast.show {
            display: block;
            opacity: 1;
            min-width: 240px;
            max-width: 240px;
            margin-right: 0.25rem;
            min-height: 88px;
            max-height: 88px;
            overflow-y: auto;
        }
    </style>
@endsection

@section('contenido')
    <div class="container-fluid" id="calendario">
        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Calendario</h4>
                </div>
                <!--end page-title-box-->
            </div>
            <!--end col-->
        </div>
        <!-- end page title end breadcrumb -->
        <div class="row">
            <div class="col-lg-3">
                <div class="row" style="position: sticky; top: 93px;">
                    <div class="col-sm-12 col-md-6 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title m-0">Calendarios</h5>
                                <hr class="my-1 mx-0">
                                <div id='calendarios'>
                                    <div class="checkbox" :class="calendario.color"
                                        v-for="(calendario, index) in calendarios" v-cloak>
                                        <input :id="calendario.id" type="checkbox" name="calendarios[]"
                                            :value="calendario.id" :checked="calendario.estado" v-model="calendario.estado"
                                            v-cloak>
                                        <label :for="calendario.id" v-cloak>@{{ calendario.nombre }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($olano)
                        <div class="col-sm-12 col-md-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title m-0">Sin muelles</h5>
                                    <hr class="my-1 mx-0">
                                    <div id='eventos-futuros'>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-1"
                                                v-for="(evento, index) in sin_muelles" v-cloak>
                                                <b class="text-warning" v-cloak> @{{ evento.nombre }}</b>

                                                {{-- <span class="badge badge-primary badge-pill"
                                                v-cloak>@{{ evento.fecha_inicio | tiempo }}</span> --}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title m-0">Con muelles</h5>
                                    <hr class="my-1 mx-0">
                                    <div id='eventos-futuros'>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-1"
                                                v-for="(evento, index) in con_muelles" v-cloak>
                                                <b class="text-warning" v-cloak> @{{ evento.nombre }}</b>

                                                {{-- <span class="badge badge-primary badge-pill"
                                                v-cloak>@{{ evento.fecha_inicio | tiempo }}</span> --}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title m-0">Seguimiento</h5>
                                    <hr class="my-1 mx-0">
                                    <div id='eventos-futuros'>
                                        <ul class="list-group">
                                            <li class="list-group-item d-flex justify-content-between align-items-center p-1"
                                                v-for="(evento, index) in seguimiento" v-cloak>
                                                <b class="text-blue" v-cloak> @{{ evento.nombre }}</b>
                                                {{-- <span class="badge badge-primary badge-pill"
                                                v-cloak>@{{ evento.fecha_inicio | tiempo }}</span> --}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <select class="select2 form-control">

                                </select>
                            </div>
                        </div>
                        <div id='calendar'></div>
                        <div style='clear:both'></div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

        <div class="modal fade" id="modalAgregarEvento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form class="needs-validation" novalidate id="nuevoEvento" method="post">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="exampleModalLabel">Agregar evento</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="col-md-6 form-group">
                                    <label for="validationCustom01">Calendario</label>
                                    <select class="form-control" name="calendario_id" required>
                                        <template v-for="calendario in calendarios">
                                            <option v-if="calendario.estado == 1" :value="calendario.id">
                                                @{{ calendario.nombre }}</option>
                                        </template>
                                    </select>
                                    <div class="invalid-feedback">
                                        ¡El calendario es obligatorio!
                                    </div>
                                </div>
                                <div class="col-md-6 form-group">
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
                                <div class="col-md-12 form-group">
                                    <label for="validationCustom01">Título</label>
                                    <input class="form-control" name="titulo" v-model="titulo" type="text" required>
                                    <div class="invalid-feedback">
                                        ¡El título del evento es obligatorio!
                                    </div>
                                </div>
                                <div class="col-lg-12 form-group">
                                    <div class="custom-control custom-switch switch-secondary">
                                        <input type="checkbox" class="custom-control-input" id="todo_dia"
                                            v-model="all_day_add">
                                        <label class="custom-control-label" for="todo_dia">Evento todo el día</label>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="example-input2-group1">Fecha y hora de inicio</label>
                                    <div class="input-group">
                                        <input class="form-control" name="fecha_inicio" v-model="fecha_inicio"
                                            v-on:blur="changeHour('inicio_add')" type="date" required>
                                        <div class="input-group-append">
                                            <input class="form-control" name="hora_inicio" v-model="hora_inicio_add"
                                                v-on:blur="changeHour('inicio_add')" v-if="!all_day_add" type="time">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 form-group">
                                    <label for="example-input2-group1">Fecha y hora de fin</label>
                                    <div class="input-group">
                                        <input class="form-control" name="fecha_fin" v-model="fecha_fin" type="date"
                                            v-on:blur="changeHour('fin_add')" required>
                                        <div class="input-group-append">
                                            <input class="form-control" name="hora_fin" v-model="hora_fin_add"
                                                v-if="!all_day_add" v-on:blur="changeHour('fin_add')" type="time">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 form-group">
                                    <label for="validationCustom01">Descripcion</label>
                                    <textarea class="form-control" name="descripcion" type="text"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="registrarEvento" class="btn btn-success">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditarEvento" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form class="needs-validation" novalidate id="editarEvento" method="post">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="exampleModalLabel">Editar evento </h5>
                            <button type="button" class="close" v-on:click="modalHide('modalEditarEvento')"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-row">
                                <div class="col-md-6 mb-2">
                                    <label for="validationCustom01">Calendario</label>
                                    <input type="text" readonly class="form-control" id="nombre_calendario">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="validationCustom01">Color</label>
                                    <select class="form-control form-control-sm" id="color" name="color" required>
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
                                <div class="col-md-12 form-group">
                                    <label for="validationCustom01">Título</label>
                                    <input class="form-control" name="titulo" v-model="titulo_edit" type="text"
                                        required>
                                    <input name="id" type="hidden" id="id">
                                    <div class="invalid-feedback">
                                        ¡El título del evento es obligatorio!
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="example-input2-group1">Fecha y hora de inicio</label>
                                    <div class="input-group">
                                        <input class="form-control form-control-sm" name="fecha_inicio"
                                            v-on:blur="changeHour('inicio_edit')" v-model="fecha_inicio_edit"
                                            type="date" required>
                                        <div class="input-group-append">
                                            <input class="form-control form-control-sm" name="hora_inicio"
                                                v-model="hora_inicio" v-on:blur="changeHour('inicio_edit')"
                                                type="time">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="example-input2-group1">Fecha y hora de fin</label>
                                    <div class="input-group">
                                        <input class="form-control form-control-sm" name="fecha_fin"
                                            v-on:blur="changeHour('fin_edit')" v-model="fecha_fin_edit" type="date"
                                            required>
                                        <div class="input-group-append">
                                            <input class="form-control form-control-sm" name="hora_fin"
                                                v-on:blur="changeHour('fin_edit')" v-model="hora_fin" type="time">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <label for="validationCustom01">Descripcion</label>
                                    <textarea class="form-control form-control-sm" name="descripcion" id="descripcion" type="text"></textarea>
                                </div>
                                @if ($olano)
                                    <div class="col-md-12">

                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#ordenes_entrada"
                                                    role="tab" aria-selected="true">Ordenes de entrada
                                                    @{{ ordenes_entrada.length }}/@{{ entradas_firmas }}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link " data-toggle="tab" href="#ordenes_salida"
                                                    role="tab" aria-selected="true">Ordenes de salida
                                                    @{{ ordenes_salida.length }}/@{{ salidas_firmas }}</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane  active" id="ordenes_entrada" role="tabpanel">
                                                <div class="row">
                                                    <div class="mb-2 mt-2 col-md-12">
                                                        @if (auth()->user()->existPermission(161))
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal" data-target="#modalPrepEntrada"
                                                                id="albaran_entrada">Nuevo</button>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div style="max-height: 256px; overflow-y: auto;">
                                                            <table class="table table-sm table-bordered mb-0"
                                                                style="max-height: 120px; overflow-y: auto;">
                                                                <thead>
                                                                    <th># </th>
                                                                    <th>Tipo</th>
                                                                    <th>Número</th>
                                                                    <th>*</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-if="ordenes_entrada.length==0">
                                                                        <td colspan="4" class="text-center">No hay
                                                                            datos de
                                                                            entradas
                                                                            hasta ahora</td>
                                                                    </tr>
                                                                    <tr v-else
                                                                        v-for="orden_entrada,index in ordenes_entrada">
                                                                        <td>@{{ index + 1 }}</td>
                                                                        <td><span v-if="orden_entrada.tipo==1">Albarán de
                                                                                entrada</span><span v-else>Equipo
                                                                                de frío</span></td>
                                                                        <td>@{{ orden_entrada.numero }}</td>
                                                                        <td>
                                                                            <button type="button"
                                                                                style="width: 25px;height: 25px; padding: 0.2px"
                                                                                id="editar_orden_entrada" title="Editar"
                                                                                class="btn btn-sm btn-secondary mr-1"
                                                                                v-on:click="editarOrdenEntrada(orden_entrada.id)">
                                                                                <svg viewBox="0 0 24 24" width="14"
                                                                                    height="14" stroke="currentColor"
                                                                                    stroke-width="2" fill="none"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="css-i6dzq1">
                                                                                    <path
                                                                                        d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                                                    </path>
                                                                                    <path
                                                                                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                                                    </path>
                                                                                </svg>
                                                                            </button>
                                                                            <a type="button"
                                                                                style="width: 25px;height: 25px; padding: 0.2px"
                                                                                id="imprimir_entrada" title="Imprimir"
                                                                                class="btn  btn-sm btn-success"
                                                                                target="_blank"
                                                                                :href="'/calendarios/imprimir/' + orden_entrada
                                                                                    .id">
                                                                                <svg viewBox="0 0 24 24" width="14"
                                                                                    height="14" stroke="currentColor"
                                                                                    stroke-width="2" fill="none"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="css-i6dzq1">
                                                                                    <polyline points="6 9 6 2 18 2 18 9">
                                                                                    </polyline>
                                                                                    <path
                                                                                        d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                                                                    </path>
                                                                                    <rect x="6" y="14"
                                                                                        width="12" height="8">
                                                                                    </rect>
                                                                                </svg>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="ordenes_salida" role="tabpanel">
                                                <div class="row">
                                                    <div class="mb-2 mt-2 col-md-12">
                                                        @if (auth()->user()->existPermission(161))
                                                            <button type="button" class="btn btn-primary btn-sm"
                                                                data-toggle="modal" data-target="#modalPrepSalida"
                                                                id="albaran_salida">Nuevo</button>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div style="max-height: 256px; overflow-y: auto;">
                                                            <table class="table table-sm table-bordered mb-0"
                                                                style="max-height: 120px; overflow-y: auto;">
                                                                <thead>
                                                                    <th># </th>
                                                                    <th>Tipo</th>
                                                                    <th>Número</th>
                                                                    <th>*</th>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-if="ordenes_salida.length==0">
                                                                        <td colspan="4" class="text-center">No hay
                                                                            datos de
                                                                            salidas hasta ahora</td>
                                                                    </tr>
                                                                    <tr v-else
                                                                        v-for="orden_salida,index in ordenes_salida">
                                                                        <td v-cloak>@{{ index + 1 }}</td>
                                                                        <td>
                                                                            <span v-if="orden_salida.tipo==1"
                                                                                v-cloak>Albarán
                                                                                de
                                                                                salida</span>
                                                                            <span v-else v-cloak>Equipo de frío</span>
                                                                        </td>
                                                                        <td>@{{ orden_salida.numero }}</td>
                                                                        <td>
                                                                            <button type="button"
                                                                                style="width: 25px;height: 25px; padding: 0.2px"
                                                                                id="editar_orden_salida" title="Editar"
                                                                                class="btn btn-sm btn-secondary mr-1"
                                                                                v-on:click="editarOrdenSalida(orden_salida.id)">
                                                                                <svg viewBox="0 0 24 24" width="14"
                                                                                    height="14" stroke="currentColor"
                                                                                    stroke-width="2" fill="none"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="css-i6dzq1">
                                                                                    <path
                                                                                        d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                                                    </path>
                                                                                    <path
                                                                                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                                                    </path>
                                                                                </svg>
                                                                            </button>
                                                                            <a type="button"
                                                                                style="width: 25px;height: 25px; padding: 0.2px"
                                                                                id="imprimir_salida" title="Imprimir"
                                                                                class="btn btn-sm btn-success"
                                                                                target="_blank"
                                                                                :href="'/calendarios/imprimir/' + orden_salida
                                                                                    .id">
                                                                                <svg viewBox="0 0 24 24" width="14"
                                                                                    height="14" stroke="currentColor"
                                                                                    stroke-width="2" fill="none"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round"
                                                                                    class="css-i6dzq1">
                                                                                    <polyline points="6 9 6 2 18 2 18 9">
                                                                                    </polyline>
                                                                                    <path
                                                                                        d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2">
                                                                                    </path>
                                                                                    <rect x="6" y="14"
                                                                                        width="12" height="8">
                                                                                    </rect>
                                                                                </svg>
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            @if (auth()->user()->existPermission(156))
                                <button type="button" id="eliminar" class="btn btn-danger">Eliminar</button>
                            @endif

                            <button type="submit" id="actualizarEvento" class="btn btn-success">Editar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal fade" id="modalPrepEntrada" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form class="needs-validation" novalidate id="ordenEntrada" method="post">
                            @csrf
                            <input type="hidden" name="evento_id" id="orden_entrada_evento_id">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="exampleModalLabel">Orden prep entrada</h5>
                                <button type="button" class="close" v-on:click="modalHide('modalPrepEntrada')"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-5 form-group">
                                        <label for="validationCustom01">Tipo</label>
                                        <select name="tipo" class="form-control form-control-sm tipo_busqueda"
                                            id="entrada_tipo_busqueda" required>
                                            <option value="">Selecciones</option>
                                            <option value="1">Albarán de entrada</option>
                                            <option value="0">Equipo de frío</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label for="validationCustom01">Número</label>
                                        <input class="form-control form-control-sm numero_busqueda" name="numero"
                                            id="entrada_numero" type="text" required>
                                    </div>
                                    <div class="col-md-2 form-group pt-md-1">
                                        <button class="btn btn-sm btn-block btn-blue mt-md-4 buscar_albaran"
                                            type="button">Buscar</button>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="validationCustom01"><b class="mr-1">Cliente y Ref cliente:
                                            </b></label><span id="cliente_ref"></span>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="validationCustom01"><b class="mr-1">Albarán entrada OLANO PDA:
                                            </b></label><span id="olano_pda"></span>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="validationCustom01"><b class="mr-1">Hora prevista: </b></label><span
                                            id="hora_prevista"></span>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="validationCustom01"><b class="mr-1">Muelle: </b></label><span
                                            id="muelle"></span>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="validationCustom01"><b class="mr-1">N° pallets: </b></label><span
                                            id="n_pallets"></span>
                                    </div>
                                    <div class="col-md-12 form-group table-responsive">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-sm"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Tª (entre cajas):</th>
                                                    <th>Nombre operario</th>
                                                    <th>Firma <i data-feather="refresh-cw" id="limpiar_firma_entrada"
                                                            style="cursor: pointer;height: 18px;width: 18px"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="130">
                                                        <input type="text" name="entre_cajas" id="entrada_entre_cajas"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="nombre_operario"
                                                            id="entrada_nombre_operario" class="form-control">
                                                    </td>
                                                    <td>
                                                        <canvas id="canvas" class="canvas"></canvas>
                                                        <img src="" id="url_entrada" style="display: none"
                                                            height="80" width="400" alt="">
                                                        <input type='hidden' name='clasificacion' value="1" />
                                                        <input type='hidden' name='imagen'
                                                            id='entrada_imagen_hidden' />
                                                        <input type='hidden' name='cliente'
                                                            id='entrada_cliente_hidden' />
                                                        <input type='hidden' name='abreviatura'
                                                            id='entrada_abreviatura_hidden' />
                                                        <input type='hidden' name='referencia'
                                                            id='entrada_referencia_hidden' />
                                                        <input type='hidden' name='olano_pda'
                                                            id='entrada_olano_pda_hidden' />
                                                        <input type='hidden' name='albaran_preparacion_playa'
                                                            id='entrada_albaran_preparacion_playa_hidden' />
                                                        <input type='hidden' name='cita_previa'
                                                            id='entrada_cita_previa_hidden' />
                                                        <input type='hidden' name='fecha_real'
                                                            id='entrada_fecha_real_hidden' />
                                                        <input type='hidden' name='fecha_entrega'
                                                            id='entrada_fecha_entrega_hidden' />
                                                        <input type='hidden' name='fecha_sal_prev'
                                                            id='entrada_fecha_sal_prev_hidden' />
                                                        <input type='hidden' name='tipo_carga'
                                                            id='entrada_tipo_carga_hidden' />
                                                        <input type='hidden' name='muelle'
                                                            id='entrada_muelle_hidden' />
                                                        <input type='hidden' name='muelle_adic'
                                                            id='entrada_muelle_adic_hidden' />
                                                        <input type='hidden' name='n_pallets'
                                                            id='entrada_n_pallets_hidden' />
                                                        <input type='hidden' name='numeros'
                                                            id='entrada_numeros_hidden' />
                                                        <input type='hidden' name='albaran_id'
                                                            id='entrada_albaran_id' />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" name="observaciones" id="entrada_observacion" type="text"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info"
                                    v-on:click="modalHide('modalPrepEntrada')">Cerrar</button>
                                <button v-if="entrada_leido" type="button" class="btn btn-blue" id="leido_entrada">Leido</button>
                                <button v-else type="button" id="leido_entrada" class="btn btn-warning"
                                    v-on:click="leido_entrada()">Marcar
                                    leido</button>
                                <button type="submit" id="registrarOrdenEntrada"
                                    class="btn btn-success">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modalPrepSalida" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <form class="needs-validation" novalidate id="ordenSalida" method="post">
                            @csrf
                            <input type="hidden" name="evento_id" id="orden_salida_evento_id">
                            <div class="modal-header">
                                <h5 class="modal-title mt-0" id="exampleModalLabel">Orden prep salida</h5>
                                <button type="button" class="close" v-on:click="modalHide('modalPrepSalida')"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-row">
                                    <div class="col-md-5 form-group">
                                        <label for="validationCustom01">Tipo</label>
                                        <select name="tipo" class="form-control form-control-sm tipo_busqueda"
                                            id="salida_tipo_busqueda" required>
                                            <option value="">Selecciones</option>
                                            <option value="1">Albarán de salida</option>
                                            <option value="0">Equipo de frío</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5 form-group">
                                        <label for="validationCustom01">Número</label>
                                        <input class="form-control form-control-sm numero_busqueda" name="numero"
                                            id="salida_numero" type="text" required>
                                    </div>
                                    <div class="col-md-2 form-group pt-md-1">
                                        <button class="btn btn-sm btn-block btn-blue mt-md-4 buscar_albaran"
                                            type="button">Buscar</button>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="validationCustom01"><b>Camión / Destino: </b></label><span
                                            id="camion_destino"></span>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="validationCustom01"><b class="mr-1">Cliente y Ref cliente:
                                            </b></label><span id="cliente_ref_salida"></span>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="validationCustom01"><b class="mr-1">Albarán salida OLANO PDA:
                                            </b></label><span id="olano_pda_salida"></span>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="validationCustom01"><b class="mr-1">Camaras: </b></label><span
                                            id="camaras"></span>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="validationCustom01"><b class="mr-1">Hora prevista: </b></label><span
                                            id="hora_prevista_salida"></span>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="validationCustom01"><b class="mr-1">Muelle: </b></label><span
                                            id="muelle_salida"></span>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="validationCustom01"><b class="mr-1">N° pallets: </b></label><span
                                            id="n_pallets_salida"></span>
                                    </div>
                                    <div class="col-md-12 form-group table-responsive">
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap table-sm"
                                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Tª (entre cajas):</th>
                                                    <th>Nombre operario</th>
                                                    <th>Firma <i data-feather="refresh-cw" id="limpiar_firma_salida"
                                                            style="cursor: pointer;height: 18px;width: 18px;"></i></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td width="130">
                                                        <input type="text" name="entre_cajas" id="salida_entre_cajas"
                                                            class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="nombre_operario"
                                                            id="salida_nombre_operario" class="form-control">
                                                    </td>
                                                    <td>
                                                        <canvas id="canvas_salida" class="canvas"></canvas>
                                                        <img src="" id="url_salida" style="display: none"
                                                            height="80" width="400" alt="">
                                                        <input type='hidden' name='clasificacion' value="0" />
                                                        <input type='hidden' name='imagen' id='salida_imagen_hidden' />
                                                        <input type='hidden' name='cliente'
                                                            id='salida_cliente_hidden' />
                                                        <input type='hidden' name='camion_destino'
                                                            id='salida_camion_destino_hidden' />
                                                        <input type='hidden' name='abreviatura'
                                                            id='salida_abreviatura_hidden' />
                                                        <input type='hidden' name='referencia'
                                                            id='salida_referencia_hidden' />
                                                        <input type='hidden' name='olano_pda'
                                                            id='salida_olano_pda_hidden' />
                                                        <input type='hidden' name='camaras' id='camaras_hidden' />
                                                        <input type='hidden' name='albaran_preparacion_playa'
                                                            id='salida_albaran_preparacion_playa_hidden' />
                                                        <input type='hidden' name='cita_previa'
                                                            id='salida_cita_previa_hidden' />
                                                        <input type='hidden' name='fecha_real'
                                                            id='salida_fecha_real_hidden' />
                                                        <input type='hidden' name='fecha_entrega'
                                                            id='salida_fecha_entrega_hidden' />
                                                        <input type='hidden' name='fecha_sal_prev'
                                                            id='salida_fecha_sal_prev_hidden' />
                                                        <input type='hidden' name='tipo_carga'
                                                            id='salida_tipo_carga_hidden' />
                                                        <input type='hidden' name='muelle' id='salida_muelle_hidden' />
                                                        <input type='hidden' name='muelle_adic'
                                                            id='salida_muelle_adic_hidden' />
                                                        <input type='hidden' name='n_pallets'
                                                            id='salida_n_pallets_hidden' />
                                                        <input type='hidden' name='numeros'
                                                            id='salida_numeros_hidden' />
                                                        <input type='hidden' name='albaran_id' id='salida_albaran_id' />
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-12 form-group">
                                        <label for="observaciones">Observaciones</label>
                                        <textarea class="form-control" name="observaciones" id="salida_observacion" type="text"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-info"
                                    v-on:click="modalHide('modalPrepSalida')">Cerrar</button>
                                <button v-if="salida_leido" type="button" class="btn btn-blue"  id="leido_salida">Leido</button>
                                <button v-else type="button" id="leido_salida" class="btn btn-warning"
                                    v-on:click="leido_salida()">Marcar
                                    leido</button>
                                <button type="submit" id="registrarOrdenSalida" class="btn btn-success">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('add-scripts')
    <script src="{{ asset('plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/packages/core/main.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/packages/daygrid/main.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/packages/timegrid/main.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/packages/interaction/main.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/packages/list/main.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/packages/list/main.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/packages/list/locales-all.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2es.min.js') }}"></script>
    <script>
        var olano = "{{ $olano }}";
        var crear_albaran_permiso = "{{ auth()->user()->existPermission(161) }}"
        var nombre_usuario = "{{ auth()->user()->nombre }}"
        const fecha = "{{ date('Y-m-d') }}"
        moment.locale('es', {});
        const calendar_id = "{{ $id }}"
        var existe_firma_entrada = false;
        var existe_firma_salida = false;

        var calendar;
        var select2;
        var evento;
        const cargarEventos = (calendarios = "ver") => {
            if (calendar != undefined) {
                calendar.destroy();
            } else {
                var calendarEl = document.getElementById('calendar');
            }

            calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                locale: 'es',
                plugins: ['interaction', 'dayGrid', 'timeGrid'],
                defaultView: 'timeGridDay',
                header: {
                    left: 'prev,next,today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Lista'
                },
                defaultDate: fecha,
                firstDay: 1,
                weekNumbers: true,
                eventStartEditable: {{ $arrastrable }},
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,
                select: function(arg) {
                    console.log(arg);
                    @if (auth()->user()->existPermission(154))
                        $("#modalAgregarEvento").modal("show");

                        let existe_dia = arg.startStr.indexOf("T");
                        if (existe_dia == -1) {
                            vue_app.hora_inicio_add = moment().format('HH:mm');
                            vue_app.hora_fin_add = (moment().add(1, 'hours').format('HH:mm'));
                        } else {
                            let fecha_dia = arg.startStr.substring(0, 10) + " " + arg.startStr.substring(11,
                                19)
                            vue_app.hora_inicio_add = moment(fecha_dia).format('HH:mm');
                            vue_app.hora_fin_add = (moment(fecha_dia).add(1, 'hours').format('HH:mm'));
                        }
                        vue_app.fecha_inicio = moment(arg.startStr).format('YYYY-MM-DD');

                        let fecha_fin = (arg.startStr.length == 10) ? moment(arg.endStr).subtract(1,
                            'days') : arg.endStr;
                        vue_app.fecha_fin = moment(fecha_fin).add(1, 'hours').format('YYYY-MM-DD');
                        calendar.unselect()
                    @else
                        Swal.fire({
                            icon: "error",
                            title: "Acceso denegado",
                            text: "No tienes permisos para crear eventos"
                        });
                    @endif
                },
                editable: true,
                eventLimit: true, // allow "more" link when too many events
                events: "/calendarios/eventos/" + calendar_id + "/" + calendarios,
                eventClick: function(arg) {
                    @if (auth()->user()->existPermission(155))
                        evento = arg;
                        cargarEditarEvento(arg.event.id);
                    @else
                        Swal.fire({
                            icon: "error",
                            title: "Acceso denegado",
                            text: "No tienes permisos para editar eventos"
                        });
                    @endif
                },
                eventDrop: function(info) {
                    editarEvento(info.event, "arrastrar")
                },
                eventResize: function(info) {
                    editarEvento(info.event, "redimensionar")
                }
            });

            calendar.render();
        }

        const cargarSelect = (calendarios) => {
            if (select2 != undefined) {
                select2 = undefined;
            }

            select2 = $(".select2").select2({
                placeholder: 'Buscar eventos',
                allowClear: true,
                ajax: {
                    url: '/calendarios/buscar/',
                    data: function(params) {
                        var query = {
                            search: params.term,
                            type: 'public',
                            calendarios: calendarios.join(",")
                        }
                        return query;
                    }
                }
            });
        }

        const editarEvento = (Event, type) => {
            let fecha = (Event.start != null) ? moment(Event.start) : null;
            let fechaFin = (Event.end != null) ? moment(Event.end) : moment(Event.start).add(1, 'hours');
            data = {
                id: Event.id,
                fecha_inicio: (fecha != null) ? fecha.format('YYYY-MM-DD') : null,
                hora_inicio: (fecha != null) ? fecha.format('HH:mm') : null,
                fecha_fin: (fechaFin != null) ? fechaFin.format('YYYY-MM-DD') : null,
                hora_fin: (fechaFin != null) ? fechaFin.format('HH:mm') : null,
            }

            axios.put("{{ route('eventos.updateDate') }}", data)
                .then(res => {})
                .catch(err => {})
        }

        function cargarEditarEvento(id) {
            $.ajax({
                type: "get",
                url: "/calendarios/eventos/" + id + "/edit",
                dataType: "json",
                success: function(response) {
                    $("#nombre_calendario").val(response.calendario)
                    vue_app.titulo_edit = response.nombre;
                    vue_app.fecha_inicio_edit = response.fecha_inicio;
                    vue_app.hora_inicio = response.hora_inicio;
                    vue_app.fecha_fin_edit = response.fecha_fin;
                    vue_app.hora_fin = response.hora_fin;
                    vue_app.api = response.api;
                    vue_app.ordenes_entrada = response.ordenes_entrada;
                    vue_app.entradas_firmas = response.entradas_firmas;
                    vue_app.ordenes_salida = response.ordenes_salida;
                    vue_app.salidas_firmas = response.salidas_firmas;
                    $("#color").val(response.color_id);
                    $("#id").val(response.id);
                    evento_id = response.id;
                    $("#descripcion").val(response.descripcion);
                    $("#modalEditarEvento").modal("show");
                }
            });
        }

        var vue_app = new Vue({
            el: "#calendario",
            data: {
                api: 0,
                titulo: "",
                all_day_add: 0,
                fecha_inicio: "",
                fecha_fin: "",
                titulo_edit: "",
                fecha_inicio_edit: "",
                fecha_fin_edit: "",
                hora_inicio: "",
                hora_fin: "",
                hora_inicio_add: "",
                hora_fin_add: "",
                calendarios: [],
                sin_muelles: [],
                con_muelles: [],
                seguimiento: [],
                ordenes_entrada: [],
                entradas_firmas: [],
                ordenes_salida: [],
                salidas_firmas: [],
                entrada_leido: 0,
                salida_leido: 0
            },
            created: function() {
                $.ajax({
                    type: "get",
                    url: "/calendarios/verCalendarios/" + calendar_id,
                    dataType: "json",
                    success: function(response) {
                        vue_app.calendarios = response;
                    }
                });

            },
            filters: {
                tiempo: function(val) {
                    return moment(val).fromNow();
                },
            },
            methods: {
                editarOrdenEntrada: function(id) {
                    $("#ordenEntrada")[0].reset();
                    $("#cliente_ref_entrada").html("");
                    $("#olano_pda_entradaa").html("");
                    $("#camaras").html("");
                    $("#camion_destino").html("");
                    $("#hora_prevista_entrada").html("");
                    $("#muelle_entrada").html("");
                    $("#n_pallets_entrada").html("");
                    $("#url_entrada").prop("src", "");
                    contexto.clearRect(0, 0, $canvas.width, $canvas.height);
                    $.ajax({
                        type: "get",
                        url: "/calendarios/buscar_albaran_existente/" + id,
                        dataType: "json",
                        success: function(response) {
                            $("#leido_entrada").css("display", "block");
                            vue_app.entrada_leido = response.leido
                            let muelle_adic = (response.muelle_adic) ? "_" + response.muelle_adic :
                                "";
                            numero_busqueda = response.numero
                            tipo_busqueda = response.tipo
                            claficicacion_busqueda = "entradas";

                            $("#entrada_numero").val(response.numero);
                            $("#entrada_numero").attr("readonly", true);
                            $("#entrada_tipo_busqueda").val(response.tipo);
                            $("#entrada_tipo_busqueda").attr("readonly", true);
                            $("#entrada_entre_cajas").val(response.entre_cajas);
                            if (!crear_albaran_permiso) {
                                $("#entrada_nombre_operario").attr("readonly", true);
                                $("#entrada_observacion").attr("readonly", true);
                            } else {
                                $("#entrada_nombre_operario").removeAttr("readonly");
                                $("#entrada_observacion").removeAttr("readonly");
                            }

                            if (response.nombre_operario) {
                                $("#entrada_nombre_operario").val(response.nombre_operario);
                            } else {
                                $("#entrada_nombre_operario").val(nombre_usuario);
                            }
                            $("#entrada_observacion").val(response.observacion);
                            $("#entrada_albaran_id").val(response.id);

                            let clientesHtml = '';
                            response.cliente.forEach(element => {
                                clientesHtml +=
                                    '<span class="badge badge-light font-weight-bold mr-1" style="font-size:12px !important">' +
                                    element.abreviatura + '_' + element.referencia +
                                    '</span>';
                            });
                            $("#cliente_ref").html(clientesHtml);

                            let numerosHtml = '';
                            response.numeros.forEach(element => {
                                numerosHtml +=
                                    '<span class="badge badge-light font-weight-bold mr-1" style="font-size:12px !important">' +
                                    element + '</span>';
                            });
                            $("#olano_pda").html(numerosHtml);

                            $("#hora_prevista").html(response.cita_previa);
                            $("#muelle").html(response.muelle + muelle_adic);
                            $("#n_pallets").html(response.n_pallets);

                            $("#orden_entrada_evento_id").val(response.evento_id);
                            $("#entrada_cliente_hidden").val(JSON.stringify(response.cliente));
                            $("#entrada_cita_previa_hidden").val(response.cita_previa);
                            $("#entrada_fecha_real_hidden").val(response.fecha_ent_real);
                            $("#entrada_fecha_entrega_hidden").val(response.fecha_entrega);
                            $("#entrada_fecha_sal_prev_hidden").val(response.fecha_sal_prev);
                            $("#entrada_tipo_carga_hidden").val(response.tipo_carga);
                            $("#entrada_muelle_hidden").val(response.muelle);
                            $("#entrada_muelle_adic_hidden").val(response.muelle_adic);
                            $("#entrada_n_pallets_hidden").val(response.n_pallets);
                            $("#entrada_numeros_hidden").val(JSON.stringify(response.numeros));
                            if (response.firma != "" && response.firma != null) {
                                $("#canvas").css("display", "none");
                                $("#url_entrada").css("display", "block");
                                $("#url_entrada").prop("src", response.firma);
                            } else {
                              $("#canvas").css("display", "block");
                              $("#url_entrada").css("display", "none");
                              $("#url_entrada").prop("src", "")
                            }
                            existe_firma_entrada = false;
                            $("#modalPrepEntrada").modal("show")
                        }
                    });
                },
                editarOrdenSalida: function(id) {
                    $("#ordenSalida")[0].reset();
                    $("#cliente_ref_salida").html("");
                    $("#olano_pda_salida").html("");
                    $("#camaras").html("");
                    $("#camion_destino").html("");
                    $("#hora_prevista_salida").html("");
                    $("#muelle_salida").html("");
                    $("#n_pallets_salida").html("");
                    $("#url_salida").prop("src", "");
                    contexto.clearRect(0, 0, $canvas.width, $canvas.height);
                    $.ajax({
                        type: "get",
                        url: "/calendarios/buscar_albaran_existente/" + id,
                        dataType: "json",
                        success: function(response) {
                            $("#leido_salida").css("display", "block");

                            vue_app.salida_leido = response.leido

                            let muelle_adic = (response.muelle_adic) ? "_" + response.muelle_adic :
                                "";
                            numero_busqueda = response.numero
                            tipo_busqueda = response.tipo
                            claficicacion_busqueda = "salidas";
                            $("#salida_numero").val(response.numero);
                            $("#salida_numero").attr("readonly", true);
                            $("#salida_tipo_busqueda").val(response.tipo);
                            $("#salida_tipo_busqueda").attr("readonly", true);
                            $("#salida_entre_cajas").val(response.entre_cajas);
                            if (!crear_albaran_permiso) {
                                $("#salida_nombre_operario").attr("readonly", true);
                                $("#salida_observacion").attr("readonly", true);
                            } else {
                                $("#salida_nombre_operario").removeAttr("readonly");
                                $("#salida_observacion").removeAttr("readonly");
                            }

                            if (response.nombre_operario) {
                                $("#salida_nombre_operario").val(response.nombre_operario);
                            } else {
                                $("#salida_nombre_operario").val(nombre_usuario);
                            }

                            $("#salida_observacion").val(response.observacion);
                            $("#salida_albaran_id").val(response.id);

                            let camionDestinoHtml =
                                '<div class="d-flex" style="overflow-x: auto;">';
                            let destinos = Object.keys(response.camion_destino);
                            destinos.forEach(element => {
                                camionDestinoHtml += '' +
                                    '<div class="toast fade show mb-0" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">' +
                                    '<div class="toast-header">' +
                                    '<strong class="mr-auto" style="font-size: 11px;">' +
                                    element + '</strong>' +
                                    '</div>' +
                                    '<div class="toast-body pb-0" style="padding-top: 0.5rem;">' +
                                    '<ul style="padding-left: 18px;padding-top: 0px;margin-bottom: 0px;font-size: 10px;">' +
                                    '<li>' + response.camion_destino[element].nombre +
                                    '</li>' +
                                    '<li>' + response.camion_destino[element].direccion +
                                    '</li>' +
                                    '</ul>' +
                                    '</div>' +
                                    '</div>';
                            });
                            camionDestinoHtml += '</div>';

                            $("#camion_destino").html(camionDestinoHtml);

                            let clientesHtml = '';
                            response.cliente.forEach(element => {
                                clientesHtml +=
                                    '<span class="badge badge-light font-weight-bold mr-1" style="font-size:12px !important">' +
                                    element.abreviatura + '_' + element.referencia +
                                    '</span>';
                            });
                            $("#cliente_ref_salida").html(clientesHtml);

                            let numerosHtml = '';
                            response.numeros.forEach(element => {
                                numerosHtml +=
                                    '<span class="badge badge-light font-weight-bold mr-1" style="font-size:12px !important">' +
                                    element + '</span>';
                            });
                            $("#olano_pda_salida").html(numerosHtml);

                            let camarasHtml = '';
                            response.camaras.forEach(element => {
                                camarasHtml +=
                                    '<span class="badge badge-light font-weight-bold mr-1" style="font-size:12px !important">' +
                                    element.almacen + '/' + element.cantidad + '</span>';
                            });
                            $("#camaras").html(camarasHtml);

                            $("#hora_prevista").html(response.cita_previa);
                            $("#muelle_salida").html(response.muelle + muelle_adic);
                            $("#n_pallets_salida").html(response.n_pallets);

                            $("#orden_salida_evento_id").val(response.evento_id);
                            $("#salida_cliente_hidden").val(JSON.stringify(response.cliente));
                            $("#camaras_hidden").val(JSON.stringify(response.camaras));
                            $("#salida_cita_previa_hidden").val(response.cita_previa);
                            $("#salida_fecha_real_hidden").val(response.fecha_ent_real);
                            $("#salida_fecha_entrega_hidden").val(response.fecha_entrega);
                            $("#salida_fecha_sal_prev_hidden").val(response.fecha_sal_prev);
                            $("#salida_tipo_carga_hidden").val(response.tipo_carga);
                            $("#salida_muelle_hidden").val(response.muelle);
                            $("#salida_muelle_adic_hidden").val(response.muelle_adic);
                            $("#salida_n_pallets_hidden").val(response.n_pallets);
                            $("#salida_numeros_hidden").val(JSON.stringify(response.numeros));
                            $("#salida_camion_destino_hidden").val(JSON.stringify(response
                                .camion_destino));
                            if (response.firma != "" && response.firma != null) {
                                $("#canvas_salida").css("display", "none");
                                $("#url_salida").css("display", "block");
                                $("#url_salida").prop("src", response.firma);
                            } else {
                              $("#canvas_salida").css("display", "block");
                              $("#url_salida").css("display", "none");
                              $("#url_salida").prop("src", "");
                            }
                            existe_firma_salida = false;
                            $("#modalPrepSalida").modal("show")
                        }
                    });
                },
                modalHide(id) {
                    $("#" + id).modal("hide");
                },
                changeHour(type) {
                    let fecha = '';
                    switch (type) {
                        case "inicio_add":
                            fecha = moment(vue_app.fecha_inicio + " " + vue_app.hora_inicio_add).add(1, 'hours');
                            vue_app.fecha_fin = fecha.format('YYYY-MM-DD')
                            vue_app.hora_fin_add = fecha.format('HH:mm')
                            break;

                        case "fin_add":
                            let fecha_i_add = moment(vue_app.fecha_inicio + " " + vue_app.hora_inicio_add).format(
                                'YYYY-MM-DD HH:mm');
                            let fecha_f_add = moment(vue_app.fecha_fin + " " + vue_app.hora_fin_add).format(
                                'YYYY-MM-DD HH:mm');
                            if (fecha_i_add > fecha_f_add) {
                                vue_app.fecha_fin = "";
                                vue_app.hora_fin_add = "";
                                Swal.fire({
                                    icon: "error",
                                    title: "Algo ha salido mal",
                                    text: "La fecha de inicio debe ser mayor a la fecha de fin",
                                });
                            }
                            // fecha = moment(vue_app.fecha_fin+" "+vue_app.hora_fin_add).subtract(1, 'hours');
                            // vue_app.fecha_inicio = fecha.format('YYYY-MM-DD')
                            // vue_app.hora_inicio_add = fecha.format('HH:mm')
                            break;

                        case "inicio_edit":
                            fecha = moment(vue_app.fecha_inicio_edit + " " + vue_app.hora_inicio).add(1, 'hours');
                            vue_app.fecha_fin_edit = fecha.format('YYYY-MM-DD')
                            vue_app.hora_fin = fecha.format('HH:mm')
                            break;

                        case "fin_edit":
                            let fecha_i_edit = moment(vue_app.fecha_inicio_edit + " " + vue_app.hora_inicio).format(
                                'YYYY-MM-DD HH:mm');
                            let fecha_f_edit = moment(vue_app.fecha_fin_edit + " " + vue_app.hora_fin).format(
                                'YYYY-MM-DD HH:mm');
                            if (fecha_i_edit > fecha_f_edit) {
                                vue_app.fecha_fin_edit = "";
                                vue_app.hora_fin = "";
                                Swal.fire({
                                    icon: "error",
                                    title: "Algo ha salido mal",
                                    text: "La fecha de inicio debe ser mayor a la fecha de fin",
                                });
                            }
                            // fecha = moment(vue_app.fecha_fin_edit+" "+vue_app.hora_fin).subtract(1, 'hours');
                            // vue_app.fecha_inicio_edit = fecha.format('YYYY-MM-DD')
                            // vue_app.hora_inicio = fecha.format('HH:mm')
                            break;

                    }

                },
                leido_entrada() {
                    $("#leido_entrada").attr("disabled", true);
                    axios.put("/calendarios/leido/" + $("#entrada_albaran_id").val())
                        .then(response => {
                            $("#leido_entrada").removeAttr("disabled");

                            if (response.data.icon == "success") {
                                vue_app.entrada_leido = 1;
                            } else {
                                vue_app.entrada_leido = 0;
                            }
                            Swal.fire({
                                icon: response.data.icon,
                                title: response.data.title,
                                text: response.data.message
                            });
                            // $("#modalPrepEntrada").modal("hide")
                        })
                },

                leido_salida() {
                    $("#leido_salida").attr("disabled", true);
                    axios.put("/calendarios/leido/" + $("#salida_albaran_id").val())
                        .then(response => {
                            $("#leido_salida").removeAttr("disabled");

                            if (response.data.icon == "success") {
                                vue_app.salida_leido = 1;
                            } else {
                                vue_app.salida_leido = 0;
                            }
                            Swal.fire({
                                icon: response.data.icon,
                                title: response.data.title,
                                text: response.data.message
                            });
                            // $("#modalPrepSalida").modal("hide")
                        })
                }
            },
            watch: {
                calendarios: {
                    handler: function(val, oldVal) {
                        let estados = [];
                        val.forEach(element => {
                            estados.push({
                                "id": element.id,
                                "estado": (element.estado == true) ? 1 : 0
                            });
                        });

                        let calendarios = [];
                        vue_app.calendarios.forEach(element => {
                            if (element.estado == 1) {
                                calendarios.push(element.id);
                            }
                        });
                        cargarSelect(calendarios);

                        $.ajax({
                            type: "get",
                            url: "/calendarios/monitoreos/" + calendarios.join(","),
                            dataType: "json",
                            success: function(response) {
                                vue_app.sin_muelles = response.sin_muelle;
                                vue_app.con_muelles = response.con_muelle;
                                vue_app.seguimiento = response.seguimiento;
                            }
                        });

                        calendar.removeAllEventSources();
                        calendar.addEventSource("/calendarios/eventos/" + calendarios.join(",") + "/ver");
                    },
                    deep: true
                }
            }
        });

        $(document).ready(function() {
            $('.select2').on('select2:select', function(e) {
                var data = e.params.data;
                calendar.gotoDate(moment().format(data.fecha_inicio))
            });

            $(".select2").on("select2:unselecting", function(e) {
                calendar.today();
            });
            if (olano) {
                setInterval(() => {
                    let calendarios = [];
                    vue_app.calendarios.forEach(element => {
                        if (element.estado == 1) {
                            calendarios.push(element.id);
                        }
                    });
                    monitoreos(calendarios)
                }, 5000);
            }

        })

        function monitoreos(calendarios) {
            $.ajax({
                type: "get",
                url: "/calendarios/monitoreos/" + calendarios.join(","),
                dataType: "json",
                success: function(response) {
                    vue_app.sin_muelles = response.sin_muelle;
                    vue_app.con_muelles = response.con_muelle;
                    vue_app.seguimiento = response.seguimiento;
                    calendar.refetchEvents();
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            cargarEventos();
        });

        $("#nuevoEvento").submit(function(e) {
            e.preventDefault();
            $('#nuevoEvento').addClass('was-validated');
            if ($('#nuevoEvento')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                $.ajax({
                    type: "post",
                    url: "{{ route('eventos.store') }}",
                    data: new FormData($('#nuevoEvento')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#registrarEvento").html(
                            "<i class='fa fa-spinner fa-pulse'></i><span class='sr-only'> Registrando...</span>Registrando..."
                        );
                        $("#registrarEvento").attr("disabled", true);
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#registrarEvento").html("Crear");
                        $("#registrarEvento").removeAttr("disabled");
                        if (data.status == "success") {
                            vue_app.titulo = "";
                            vue_app.fecha_inicio = "";
                            vue_app.hora_inicio_add = "";
                            vue_app.fecha_fin = "";
                            vue_app.hora_fin_add = "";
                            vue_app.all_day_add = false;
                            $('#modalAgregarEvento').modal('hide');
                            $('#nuevoEvento').removeClass('was-validated');
                            $("#nuevoEvento")[0].reset();
                            calendar.refetchEvents();
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

        $("#editarEvento").submit(function(e) {
            e.preventDefault();
            $('#editarEvento').addClass('was-validated');
            if ($('#editarEvento')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                $.ajax({
                    type: "post",
                    url: "{{ route('eventos.update') }}",
                    data: new FormData($('#editarEvento')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#actualizarEvento").html(
                            "<i class='fa fa-spinner fa-pulse'></i><span class='sr-only'> Actualizando...</span>Actualizando..."
                        );
                        $("#actualizarEvento").attr("disabled", true);
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#actualizarEvento").html("Editar");
                        $("#actualizarEvento").removeAttr("disabled");
                        if (data.status == "success") {
                            // evento.event.remove()
                            calendar.refetchEvents();
                            $('#editarEvento').removeClass('was-validated');
                            $("#editarEvento")[0].reset();
                            $("#modalEditarEvento").modal("hide");
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

        $(document).on("click", "#eliminar", function() {
            Swal.fire({
                title: "Esta seguro de eliminar este evento",
                text: "¡Si no lo está puede cancelar la acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.value) {
                    axios.delete("/calendarios/eventos/" + evento.event.id)
                        .then(function(response) {
                            $("#modalEditarEvento").modal("hide");
                            evento.event.remove()
                            evento = null;
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

    <script>
        var claficicacion_busqueda = null;
        var tipo_busqueda = null;
        var numero_busqueda = null;
        var evento_id = null;
        var albaran_edit = null;
        var albaran_clasificacion_edit = null;

        const ALTURA_CANVAS = 80,
            ANCHURA_CANVAS = "400";
        const $canvas = document.querySelector("#canvas");
        canvas.width = ANCHURA_CANVAS;
        canvas.height = ALTURA_CANVAS;
        const contexto = $canvas.getContext("2d");
        const COLOR = "black";
        const GROSOR = 2;
        let xAnterior = 0,
            yAnterior = 0,
            xActual = 0,
            yActual = 0;
        const obtenerXReal = (clientX) => clientX - $canvas.getBoundingClientRect().left;
        const obtenerYReal = (clientY) => clientY - $canvas.getBoundingClientRect().top;
        let haComenzadoDibujo = false; // Bandera que indica si el usuario está presionando el botón del mouse sin soltarlo
        $canvas.addEventListener("mousedown", evento => {
            // En este evento solo se ha iniciado el clic, así que dibujamos un punto
            xAnterior = xActual;
            yAnterior = yActual;
            xActual = obtenerXReal(evento.clientX);
            yActual = obtenerYReal(evento.clientY);
            contexto.beginPath();
            contexto.fillStyle = COLOR;
            contexto.fillRect(xActual, yActual, GROSOR, GROSOR);
            contexto.closePath();
            // Y establecemos la bandera
            haComenzadoDibujo = true;
        });

        $canvas.addEventListener("mousemove", (evento) => {
            if (!haComenzadoDibujo) {
                return;
            }
            // El mouse se está moviendo y el usuario está presionando el botón, así que dibujamos todo

            xAnterior = xActual;
            yAnterior = yActual;
            xActual = obtenerXReal(evento.clientX);
            yActual = obtenerYReal(evento.clientY);
            contexto.beginPath();
            contexto.moveTo(xAnterior, yAnterior);
            contexto.lineTo(xActual, yActual);
            contexto.strokeStyle = COLOR;
            contexto.lineWidth = GROSOR;
            contexto.stroke();
            contexto.closePath();

            existe_firma_entrada = true;

        });
        ["mouseup", "mouseout"].forEach(nombreDeEvento => {
            $canvas.addEventListener(nombreDeEvento, () => {
                haComenzadoDibujo = false;
            });
        });

        const $canvas_salida = document.querySelector("#canvas_salida");
        canvas_salida.width = ANCHURA_CANVAS;
        canvas_salida.height = ALTURA_CANVAS;
        const contexto_salida = $canvas_salida.getContext("2d");
        const obtenerXRealSalida = (clientX) => clientX - $canvas_salida.getBoundingClientRect().left;
        const obtenerYRealSalida = (clientY) => clientY - $canvas_salida.getBoundingClientRect().top;
        let haComenzadoDibujoSalida =
            false; // Bandera que indica si el usuario está presionando el botón del mouse sin soltarlo
        $canvas_salida.addEventListener("mousedown", evento => {
            // En este evento solo se ha iniciado el clic, así que dibujamos un punto
            xAnterior = xActual;
            yAnterior = yActual;
            xActual = obtenerXRealSalida(evento.clientX);
            yActual = obtenerYRealSalida(evento.clientY);
            contexto_salida.beginPath();
            contexto_salida.fillStyle = COLOR;
            contexto_salida.fillRect(xActual, yActual, GROSOR, GROSOR);
            contexto_salida.closePath();
            // Y establecemos la bandera
            haComenzadoDibujoSalida = true;
        });

        $canvas_salida.addEventListener("mousemove", (evento) => {
            if (!haComenzadoDibujoSalida) {
                return;
            }
            // El mouse se está moviendo y el usuario está presionando el botón, así que dibujamos todo

            xAnterior = xActual;
            yAnterior = yActual;
            xActual = obtenerXRealSalida(evento.clientX);
            yActual = obtenerYRealSalida(evento.clientY);
            contexto_salida.beginPath();
            contexto_salida.moveTo(xAnterior, yAnterior);
            contexto_salida.lineTo(xActual, yActual);
            contexto_salida.strokeStyle = COLOR;
            contexto_salida.lineWidth = GROSOR;
            contexto_salida.stroke();
            contexto_salida.closePath();
            existe_firma_salida = true;
        });
        ["mouseup", "mouseout"].forEach(nombreDeEvento => {
            $canvas_salida.addEventListener(nombreDeEvento, () => {
                haComenzadoDibujoSalida = false;
            });
        });

        $(document).on("click", "#albaran_entrada", function() {
            existe_firma_entrada = false;
            $("#leido_entrada").css("display", "none");
            $("#entrada_albaran_id").val("");
            $("#ordenEntrada")[0].reset();
            $("#cliente_ref").html("");
            $("#olano_pda").html("");
            $("#hora_prevista").html("");
            $("#muelle").html("");
            $("#n_pallets").html("");
            $("#url_entrada").prop("src", "");
            contexto.clearRect(0, 0, $canvas.width, $canvas.height);
            $("#entrada_nombre_operario").removeAttr("readonly");
            $("#entrada_tipo_busqueda").removeAttr("readonly");
            $("#entrada_numero").removeAttr("readonly");
            $("#canvas").css("display", "block");
            $("#url_entrada").css("display", "none");

            $("#orden_entrada_evento_id").val("");
            $("#entrada_cliente_hidden").val("");
            $("#entrada_abreviatura_hidden").val("");
            $("#entrada_referencia_hidden").val("");
            $("#entrada_olano_pda_hidden").val("");
            $("#entrada_albaran_preparacion_playa_hidden").val("");
            $("#entrada_cita_previa_hidden").val("");
            $("#entrada_fecha_real_hidden").val("");
            $("#entrada_fecha_entrega_hidden").val("");
            $("#entrada_fecha_sal_prev_hidden").val("");
            $("#entrada_tipo_carga_hidden").val("");
            $("#entrada_muelle_hidden").val("");
            $("#entrada_muelle_adic_hidden").val("");
            $("#entrada_n_pallets_hidden").val("");
            $("#entrada_numeros_hidden").val("");
            $("#entrada_nombre_operario").val("");
            claficicacion_busqueda = "entradas";
        })

        $(document).on("click", "#albaran_salida", function() {
            existe_firma_salida = false;
            $("#leido_salida").css("display", "none");
            $("#salida_albaran_id").val("");
            $("#ordenSalida")[0].reset();
            $("#cliente_ref_salida").html("");
            $("#olano_pda_salida").html("");
            $("#camaras").html("");
            $("#camion_destino").html("");
            $("#hora_prevista_salida").html("");
            $("#muelle_salida").html("");
            $("#n_pallets_salida").html("");
            $("#url_salida").prop("src", "");
            contexto_salida.clearRect(0, 0, $canvas_salida.width, $canvas_salida)
            $("#salida_nombre_operario").removeAttr("readonly");
            $("#salida_tipo_busqueda").removeAttr("readonly");
            $("#salida_numero").removeAttr("readonly");
            $("#canvas_salida").css("display", "block");
            $("#url_salida").css("display", "none");
            $("#orden_salida_evento_id").val("");
            $("#salida_cliente_hidden").val("");
            $("#salida_abreviatura_hidden").val("");
            $("#salida_referencia_hidden").val("");
            $("#salida_olano_pda_hidden").val("");
            $("#salida_albaran_preparacion_playa_hidden").val("");
            $("#salida_cita_previa_hidden").val("");
            $("#salida_fecha_real_hidden").val("");
            $("#salida_fecha_entrega_hidden").val("");
            $("#salida_fecha_sal_prev_hidden").val("");
            $("#salida_tipo_carga_hidden").val("");
            $("#salida_muelle_hidden").val("");
            $("#salida_muelle_adic_hidden").val("");
            $("#salida_n_pallets_hidden").val("");
            $("#salida_numeros_hidden").val("");
            $("#salida_camion_destino_hidden").val("");
            $("#salida_nombre_operario").val("");
            claficicacion_busqueda = "salidas";
        })

        $(document).on("change", ".tipo_busqueda", function() {
            tipo_busqueda = $(this).val();
        })

        $(document).on("blur", ".numero_busqueda", function() {
            numero_busqueda = $(this).val();
        })

        $(document).on("click", ".buscar_albaran", function() {
            let botton = $(this);
            botton.html("Buscando...");
            botton.attr("disabled", true);
            if (tipo_busqueda == null || numero_busqueda == null) {
                botton.html("Buscar");
                botton.removeAttr("disabled");
                Swal.fire({
                    icon: "error",
                    title: "Algo ha salido mal",
                    text: "Se necesita el tipo de busqueda y numero para la busqueda",
                });
            } else {
                let albaran_id = "";
                if (claficicacion_busqueda == "entradas") {
                    albaran_id = $("#entrada_albaran_id").val();
                } else {
                    albaran_id = $("#salida_albaran_id").val();
                }
                $.ajax({
                    type: "get",
                    url: "/calendarios/buscar_albaran/" + claficicacion_busqueda + "/" + tipo_busqueda +
                        "/" + numero_busqueda + "?albaran_id=" + albaran_id,
                    dataType: "json",
                    success: function(response) {

                        if (response.message) {
                            Swal.fire({
                                icon: "error",
                                title: "Algo salio mal",
                                text: response.message
                            });
                        } else {
                            if (response.length != 0) {

                                let muelle_adic = (response.muelle_adic) ? "_" + response.muelle_adic :
                                    "";
                                if (claficicacion_busqueda == "entradas") {
                                    $("#olano_pda").html(response.numeros);
                                    $("#hora_prevista").html(response.cita_previa);
                                    $("#muelle").html(response.muelle + muelle_adic);
                                    $("#n_pallets").html(response.palets);

                                    let clientesHtml = '';
                                    response.clientes.forEach(element => {
                                        clientesHtml +=
                                            '<span class="badge badge-light font-weight-bold mr-1" style="font-size:12px !important">' +
                                            element.abreviatura + '_' + element.referencia +
                                            '</span>';
                                    });
                                    $("#cliente_ref").html(clientesHtml);

                                    let numerosHtml = '';
                                    response.numeros.forEach(element => {
                                        numerosHtml +=
                                            '<span class="badge badge-light font-weight-bold mr-1" style="font-size:12px !important">' +
                                            element + '</span>';
                                    });
                                    $("#olano_pda").html(numerosHtml);

                                    $("#entrada_cliente_hidden").val(JSON.stringify(response.clientes));
                                    $("#entrada_numeros_hidden").val(JSON.stringify(response.numeros));
                                    $("#orden_entrada_evento_id").val(evento_id);
                                    $("#entrada_cita_previa_hidden").val(response.cita_previa);
                                    $("#entrada_fecha_real_hidden").val(response.fecha_ent_real);
                                    $("#entrada_fecha_entrega_hidden").val(response.fecha_entrega);
                                    $("#entrada_fecha_sal_prev_hidden").val(response.fecha_sal_prev);
                                    $("#entrada_tipo_carga_hidden").val(response.tipo_carga);
                                    $("#entrada_muelle_hidden").val(response.muelle);
                                    $("#entrada_muelle_adic_hidden").val(response.muelle_adic);
                                    $("#entrada_n_pallets_hidden").val(response.palets);
                                } else {
                                    let camionDestinoHtml =
                                        '<div class="d-flex" style="overflow-x: auto;">';
                                    let destinos = Object.keys(response.destinos)
                                    destinos.forEach(element => {
                                        camionDestinoHtml += '' +
                                            '<div class="toast fade show mb-0" role="alert" aria-live="assertive" aria-atomic="true" data-toggle="toast">' +
                                            '<div class="toast-header">' +
                                            '<strong class="mr-auto" style="font-size: 11px;">' +
                                            element + '</strong>' +
                                            '</div>' +
                                            '<div class="toast-body pb-0" style="padding-top: 0.5rem;">' +
                                            '<ul style="padding-left: 18px;padding-top: 0px;margin-bottom: 0px;font-size: 10px;">' +
                                            '<li>' + response.destinos[element].nombre +
                                            '</li>' +
                                            '<li>' + response.destinos[element].direccion +
                                            '</li>' +
                                            '</ul>' +
                                            '</div>' +
                                            '</div>';
                                    });
                                    camionDestinoHtml += '</div>';

                                    $("#camion_destino").html(camionDestinoHtml);

                                    let clientesHtml = '';
                                    response.clientes.forEach(element => {
                                        clientesHtml +=
                                            '<span class="badge badge-light font-weight-bold mr-1" style="font-size:12px !important">' +
                                            element.abreviatura + '_' + element.referencia +
                                            '</span>';
                                    });
                                    $("#cliente_ref_salida").html(clientesHtml);

                                    let numerosHtml = '';
                                    response.numeros.forEach(element => {
                                        numerosHtml +=
                                            '<span class="badge badge-light font-weight-bold mr-1" style="font-size:12px !important">' +
                                            element + '</span>';
                                    });
                                    $("#olano_pda_salida").html(numerosHtml);
                                    let camarasHtml = '';
                                    response.camaras.forEach(element => {
                                        camarasHtml +=
                                            '<span class="badge badge-light font-weight-bold mr-1" style="font-size:12px !important">' +
                                            element.almacen + '/' + element.cantidad +
                                            '</span>';
                                    });
                                    $("#camaras").html(camarasHtml);

                                    $("#hora_prevista_salida").html(response.cita_previa);
                                    $("#muelle_salida").html(response.muelle + muelle_adic);
                                    $("#n_pallets_salida").html(response.palets);

                                    $("#orden_salida_evento_id").val(evento_id);
                                    $("#salida_cliente_hidden").val(JSON.stringify(response.clientes));
                                    $("#salida_camion_destino_hidden").val(JSON.stringify(response
                                        .destinos));
                                    $("#camaras_hidden").val(JSON.stringify(response.camaras));
                                    $("#salida_numeros_hidden").val(JSON.stringify(response.numeros));
                                    $("#salida_cita_previa_hidden").val(response.cita_previa);
                                    $("#salida_fecha_real_hidden").val(response.fecha_ent_real);
                                    $("#salida_fecha_entrega_hidden").val(response.fecha_entrega);
                                    $("#salida_fecha_sal_prev_hidden").val(response.fecha_sal_prev);
                                    $("#salida_tipo_carga_hidden").val(response.tipo_carga);
                                    $("#salida_muelle_hidden").val(response.muelle);
                                    $("#salida_muelle_adic_hidden").val(response.muelle_adic);
                                    $("#salida_n_pallets_hidden").val(response.palets);
                                }
                            } else {
                                Swal.fire({
                                    icon: "error",
                                    title: "Algo salio mal",
                                    text: "No se encontraron resultados"
                                });
                            }
                        }


                        botton.html("Buscar");
                        botton.removeAttr("disabled");
                    }
                });
            }
        })

        $(document).on("click", "#limpiar_firma_entrada", function() {
            existe_firma_entrada = false;
            contexto.clearRect(0, 0, $canvas.width, $canvas.height);
        })

        $(document).on("click", "#limpiar_firma_salida", function() {
            existe_firma_salida = false;
            contexto_salida.clearRect(0, 0, $canvas_salida.width, $canvas_salida.height);
        })

        $("#ordenEntrada").submit(function(e) {
            e.preventDefault();
            $('#ordenEntrada').addClass('was-validated');
            if ($('#ordenEntrada')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                if (existe_firma_entrada) {
                    var image_export = $canvas.toDataURL();
                    $("#entrada_imagen_hidden").val(image_export)
                }
                $.ajax({
                    type: "post",
                    url: "{{ route('calendarios.orden') }}",
                    data: new FormData($('#ordenEntrada')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#registrarOrdenEntrada").html(
                            "<i class='fa fa-spinner fa-pulse'></i><span class='sr-only'> Registrando...</span>Registrando..."
                        );
                        $("#registrarOrdenEntrada").attr("disabled", true);
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#registrarOrdenEntrada").html("Guardar");
                        $("#registrarOrdenEntrada").removeAttr("disabled");
                        if (data.status == "success") {
                            vue_app.ordenes_entrada = data.data.entradas;
                            vue_app.entradas_firmas = data.data.entradas_firmas;
                            albaran_clasificacion_edit = data.data.tipo;
                            albaran_edit = data.data.id
                            $('#ordenEntrada').removeClass('was-validated');
                            $("#ordenEntrada")[0].reset();
                            $("#cliente_ref").html("");
                            $("#olano_pda").html("");
                            $("#hora_prevista").html("");
                            $("#muelle").html("");
                            $("#n_pallets").html("");
                            $("#url_entrada").prop("src", "");
                            contexto.clearRect(0, 0, $canvas.width, $canvas.height);

                            $("#modalPrepEntrada").modal("hide");
                        }
                        Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.message
                        });
                    }
                });
                // } else {
                //     $("#registrarOrdenEntrada").html("Guardar");
                //     $("#registrarOrdenEntrada").removeAttr("disabled");
                //     Swal.fire({
                //         icon: "error",
                //         title: "Algo salio mal",
                //         text: "La firma es obligatoria"
                //     });
                // }
            }
        });

        $("#ordenSalida").submit(function(e) {
            e.preventDefault();
            $('#ordenSalida').addClass('was-validated');
            if ($('#ordenSalida')[0].checkValidity() === false) {
                event.stopPropagation();
            } else {
                if (existe_firma_salida) {
                    var image_export_salida = $canvas_salida.toDataURL();
                    $("#salida_imagen_hidden").val(image_export_salida)
                }
                $.ajax({
                    type: "post",
                    url: "{{ route('calendarios.orden') }}",
                    data: new FormData($('#ordenSalida')[0]),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#registrarOrdenSalida").html(
                            "<i class='fa fa-spinner fa-pulse'></i><span class='sr-only'> Registrando...</span>Registrando..."
                        );
                        $("#registrarOrdenSalida").attr("disabled", true);
                    },
                    dataType: "json",
                    success: function(data) {
                        $("#registrarOrdenSalida").html("Guardar");
                        $("#registrarOrdenSalida").removeAttr("disabled");
                        if (data.status == "success") {
                            vue_app.ordenes_salida = data.data.salidas;
                            vue_app.salidas_firmas = data.data.salidas_firmas;
                            $('#ordenSalida').removeClass('was-validated');
                            $("#ordenSalida")[0].reset();
                            $("#cliente_ref_salida").html("");
                            $("#olano_pda_salida").html("");
                            $("#camaras").html("");
                            $("#camion_destino").html("");
                            $("#hora_prevista_salida").html("");
                            $("#muelle_salida").html("");
                            $("#n_pallets_salida").html("");
                            $("#url_salida").prop("src", "");
                            contexto_salida.clearRect(0, 0, $canvas_salida.width, $canvas_salida
                                .height);

                            $("#modalPrepSalida").modal("hide");
                        }
                        Swal.fire({
                            icon: data.status,
                            title: data.title,
                            text: data.message
                        });
                    }
                });

                // } else {
                //     $("#registrarOrdenSalida").html("Guardar");
                //     $("#registrarOrdenSalida").removeAttr("disabled");
                //     Swal.fire({
                //         icon: "error",
                //         title: "Algo salio mal",
                //         text: "La firma es obligatoria"
                //     });
                // }
            }
        });
    </script>
@endsection
