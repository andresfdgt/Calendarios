<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <!-- App favicon -->
    <link rel="icon" href="{{ asset('images/logoXS.png') }} " id="light-scheme-icon" />

    {{-- <title>{{ ucfirst($receta->nombre) }}</title> --}}
    <title>Imprimir albarán</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- App css -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/jquery-ui.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css">
    <style>
        [v-cloak] {
            display: none;
        }

        .left-sidenav-menu li {
            margin-top: 0px !important;
        }

        body.enlarge-menu .page-wrapper {
            min-height: auto !important;
        }

        .hexagono {
            position: relative;
            width: 3rem;
            height: 4rem;
            margin: auto;
            background-color: peachpuff;
        }

        .hexagono:before {
            content: '';
            display: block;
            position: absolute;
            width: 0;
            height: 0;
            right: 3rem;
            border-width: 2rem 1rem;
            border-style: solid;
            border-color: transparent peachpuff transparent transparent;
        }

        .hexagono:after {
            content: '';
            display: block;
            position: absolute;
            width: 0;
            height: 0;
            left: 3rem;
            border-width: 2rem 1rem;
            border-style: solid;
            border-color: transparent transparent transparent peachpuff;
            top: 0;
        }

        .table-xs th,
        .table-xs td {
            padding: .1rem;
        }

        .b-round {
            border-radius: 10px;
        }

        .bg-gray {
            background-color: #9ba7ca !important;
            border: 1px solid #9ba7ca;
        }

        .alert-outline-gray {
            border: 1px solid #9ba7ca;
            background-color: transparent;
            color: #9ba7ca;
        }

        .border-gray {
            border: 1px solid #9ba7ca !important;
            background-color: transparent;
            color: #9ba7ca !important;
        }

        .col-1-5 {
            -webkit-box-flex: 0;
            -ms-flex: 0 0 12.499999995%;
            flex: 0 0 12.499999995%;
            max-width: 12.499999995%;
        }

        pre {
            line-height: 1.6;
            font-family: "Roboto", sans-serif;
            font-size: .845rem;
            font-weight: 400;
            color: #9ba7ca;
        }
    </style>
</head>

<body class="mm-active active enlarge-menu mt-4">
    <div class="container-fluid" id="imprimir">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-body alert alert-outline-info m-0">
                        <div class="row mb-4">
                            <h3 class="m-auto" v-cloak v-if="albaran.evento != null">@{{ albaran.evento }}</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="border-0 font-14">
                                    <b>Tipo: </b>
                                    <span v-cloak v-if="albaran.tipo != null">@{{ albaran.tipo == 1 ? 'Albarán de entrada' : 'Equipo de frío' }}</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="border-0 font-14">
                                    <b>Numero: </b>
                                    <span v-cloak
                                        v-if="albaran.numero != null">@{{ albaran.numero }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row" v-cloak v-if="albaran.camion_destino != null && albaran.tipo == 0">
                            <div class="col-md-12 mb-4">
                                <div class="border-0 font-14"><b>Camión / Destino: </b>
                                    <div class="row px-2" style="overflow-x: auto;" v-cloak>
                                        <div class="toast fade show mb-0 mr-1" role="alert" aria-live="assertive"
                                            aria-atomic="true" data-toggle="toast"
                                            v-for="(destino, index) in albaran.camion_destino">
                                            <div class="toast-header"><strong class="mr-auto" style="font-size: 11px;">@{{ index }}</strong></div>
                                            <div class="toast-body pb-0" style="padding-top: 0.5rem;">
                                                <ul style="padding-left: 18px;padding-top: 0px;margin-bottom: 0px;font-size: 10px;">
                                                    <li v-cloak v-if="destino.nombre != null">@{{ destino.nombre }}
                                                    </li>
                                                    <li v-cloak v-if="destino.direccion != null">@{{ destino.direccion }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <div class="border-0 font-14"><b>Cliente y Ref cliente: </b><span v-cloak
                                        v-if="albaran.cliente != null"><span v-for="(client, index) in albaran.cliente"
                                            class="badge badge-light font-weight-bold mr-1"
                                            style="font-size:12px !important">@{{ (client.referencia) ?? '' }}_@{{ client.abreviatura ?? '' }}</span></span>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="border-0 font-14"><b>Albarán entrada OLANO PDA: </b><span v-cloak
                                        v-if="albaran.numeros != null" v-for="(numero, index) in albaran.numeros"
                                        class="badge badge-light font-weight-bold mr-1"
                                        style="font-size:12px !important">@{{ (numero) ?? '' }}</span></div>
                            </div>
                        </div>
                        <div class="row" v-cloak v-if="albaran.camaras != null && albaran.tipo == 0">
                            <div class="col-md-12 mb-4">
                                <div class="border-0 font-14"><b>Camaras: </b><span v-cloak
                                        v-if="albaran.camaras != null" v-for="(camara, index) in albaran.camaras"
                                        class="badge badge-light font-weight-bold mr-1"
                                        style="font-size:12px !important">@{{ camara.almacen }}/@{{ camara.cantidad }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-4">
                                <div class="border-0 font-14">
                                    <b>Hora prevista: </b>
                                    <span v-cloak v-if="albaran.cita_previa != null">@{{ albaran.cita_previa }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="border-0 font-14">
                                    <b>Muelle: </b>
                                    <span v-cloak v-if="albaran.muelle != null">@{{ albaran.muelle }}</span>
                                </div>
                            </div>
                            <div class="col-md-4 mb-4">
                                <div class="border-0 font-14">
                                    <b>N° pallets: </b>
                                    <span v-cloak v-if="albaran.n_pallets != null">@{{ albaran.n_pallets }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-4">
                                <table class="table table-sm table-bordered mb-0">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Tª (entre cajas)</th>
                                            <th scope="col">Nombre operario</th>
                                            <th scope="col">Firma</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left">
                                                <p class="m-0" v-cloak v-if="albaran.entre_cajas != null">
                                                    @{{ albaran.entre_cajas }}
                                                </p>
                                            </td>
                                            <td class="text-center">
                                                <div class="row">
                                                    <div class="col-6 text-right p-0 m-0">
                                                        <p class="m-0" style="text-transform:capitalize" v-cloak v-if="albaran.nombre_operario != null">
                                                            @{{ (albaran.nombre_operario) }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <img :src="albaran.firma" alt="" v-cloak v-if="albaran.firma != null">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="border-0 font-14"><b>Observaciones: </b></div>
                                <p v-cloak v-if="albaran.observacion != null" v-html="formatHtml(albaran.observacion)"></p>
                            </div>
                        </div>
                    </div>
                    <!--end card-body-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->
    </div>

    <script src="{{ asset('js/metismenu.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/waves.js') }}"></script>
    <script src="{{ asset('js/feather.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
    <script src="{{ asset('js/vue.js') }}"></script>
    <script>
        var vue_app = new Vue({
            el: "#imprimir",
            data: {
                albaran: {
                    "evento": null,
                    "id": null,
                    "numero": null,
                    "clasificacion": null,
                    "tipo": null,
                    "cliente": null,
                    "camion_destino": null,
                    "camaras": null,
                    "cita_previa": null,
                    "muelle": null,
                    "muelle_adic": null,
                    "fecha_ent_real": null,
                    "fecha_sal_prev": null,
                    "fecha_entrega": null,
                    "tipo_carga": null,
                    "firma": null,
                    "n_pallets": null,
                    "evento_id": null,
                    "nombre_operario": null,
                    "entre_cajas": null,
                    "observacion": null,
                    "olano_pda": null,
                    "created_at": null,
                    "deleted_at": null,
                    "updated_at": null,
                    "numeros": null
                },
            },
            filters: {
                redondear: function(val) {
                    return val.toFixed(vue_app.decimales);
                },
                redondearPorcentaje: function(val) {
                    let total = val.toFixed(vue_app.decimales);
                    return (total >= 100) ? 100 : total;
                }
            },
            created: function() {
                $.ajax({
                    type: "get",
                    url: "/calendarios/buscar_albaran_existente/" + @json($albaran),
                    dataType: "json",
                    success: function(response) {
                        vue_app.albaran = response;
                        setTimeout(() => {
                            window.print()
                        }, 500);
                    }
                });
            },
            watch: {},
            methods: {
                formatHtml: function(val) {
                    text = val.replace(/\n/g, "<br>");
                    return text;
                }
            }
        });
    </script>
</body>

</html>
