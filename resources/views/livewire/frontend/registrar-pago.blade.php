@section('title')
    Registrar Pago
@endsection
<div class="container" style="padding-bottom: 50px">
    <div class="loading-matricula"  wire:loading wire:target="registrarPago" style="display: none;">
        <div class="loading-matricula-body" style="margin: 100px auto;">
            <div class="spinner" style="text-align: center;">
                <img src="{{ asset('images/loader.svg') }}"/>
            </div>
            <div class="mensaje">
                Procesando.....
            </div>
        </div>
    </div>
    <div class="form-container">
        <div class="step-formulario">
            <ul class="steps has-content-centered is-balanced">
                <li class="steps-segment @if($step == 1) is-active @endif" style="margin-top: 4px;">
                    <span class="steps-marker">
                        @if($step <= 1) 1 @else <i class="fas fa-check-double"></i> @endif
                    </span>
                    <div class="steps-content">
                        <p class="is-size-5">Buscar Matrícula</p>
                    </div>
                </li>
                <li class="steps-segment @if($step == 2) is-active @endif">
                    <span class="steps-marker">
                        @if($step <= 2) 2 @else <i class="fas fa-check-double"></i> @endif
                    </span>
                    <div class="steps-content">
                        <p class="is-size-5">Concepto del pago</p>
                    </div>
                </li>
                <li class="steps-segment @if($step == 3) is-active @endif">
                    <span class="steps-marker">
                        @if($step <= 3) 3 @else <i class="fas fa-check-double"></i> @endif
                    </span>
                    <div class="steps-content">
                        <p class="is-size-5">Registrar el Pago</p>
                    </div>
                </li>
                <li class="steps-segment @if($step == 4) is-active @endif">
                    <span class="steps-marker">
                        @if($step <= 4) 4 @else <i class="fas fa-check-double"></i> @endif
                    </span>
                    <div class="steps-content">
                        <p class="is-size-5">Finalizado</p>
                    </div>
                </li>
            </ul>
        </div>
        <hr>
        <div class="contenedor-formularios">
            @if($step == 1)
                <form wire:submit.prevent="buscarMatricula">
                    <div class="field">
                        <div class="columns is-centered">
                            <div class="column is-4-desktop">
                                <label class="label">CODIGO DE MATRÍCULA</label>
                                <div class="control">
                                    <input type="text" onkeyup="mayus(this);" id="cod-matricula" class="input  @error('codigo') is-danger @enderror" style="text-align: center;" wire:model.defer="codigo"/>
                                    @error('codigo')
                                    <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <hr>
                                <div class="notification">
                                    El codigo de matrícula está en la esquina superior derecha de su ficha de matricula, se compone de la siguiente manera:<br>
                                    <b>IEPS-NUMERO_DNI_ESTUDIANTE-2021</b>(Ej: <b>IEPDS-01234567-2021</b>)
                                </div>
                            </div>
                        </div>
                    </div>
                <hr>
                <div class="field">
                    <div class="columns">
                        <div class="column has-text-right">
                            <button class="button is-primary">Continuar <i class="fas fa-arrow-alt-circle-right" style="margin-left: 5px;"></i></button>
                        </div>
                    </div>
                </div>
                </form>
            @elseif($step == 2)
                <form wire:submit.prevent="seleccionarConcepto">
                    <div class="field">
                        <div class="matricula-encontrada">
                            <div class="columns is-centered">
                                <div class="column">
                                    <div class="has-text-centered"><strong>Alumno(a)</strong></div>
                                    <div class="has-text-centered">
                                        {{ trim($matricula->alumno->apellido_paterno.' '.$matricula->alumno->apellido_materno.' '.$matricula->alumno->nombres) }}
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="has-text-centered"><strong>Grado</strong></div>
                                    <div class="has-text-centered">
                                        {{ $matricula->grado | grado }}
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="has-text-centered"><strong>Nivel</strong></div>
                                    <div class="has-text-centered">
                                        {{ $matricula->nivel == 'P' ? 'PRIMARIA' : 'SECUNDARIA' }}
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="has-text-centered"><strong>Año Lectivo</strong></div>
                                    <div class="has-text-centered">
                                        {{ $matricula->anio }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="field">
                        <div class="columns is-centered">
                            <div class="column is-4-desktop">
                                <label class="label">Seleccione el concepto:</label>
                                <div class="select is-fullwidth @error('concepto') is-danger @enderror">
                                    <select wire:model.debounce.500ms="concepto">
                                        <option value="M">Matrícula</option>
                                        <option value="P">Pensión</option>
                                    </select>
                                    @error('concepto')
                                    <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="columns">
                            <div class="column has-text-right">
                                <button class="button is-primary">Continuar <i class="fas fa-arrow-alt-circle-right" style="margin-left: 5px;"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            @elseif($step == 3 && $concepto == 'M')
                <form wire:submit.prevent="registrarPagoMatricula">
                    <div class="field">
                        <div class="matricula-encontrada">
                            <div class="columns is-centered">
                                <div class="column">
                                    <div class="has-text-centered"><strong>Alumno(a)</strong></div>
                                    <div class="has-text-centered">
                                        {{ trim($matricula->alumno->apellido_paterno.' '.$matricula->alumno->apellido_materno.' '.$matricula->alumno->nombres) }}
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="has-text-centered"><strong>Grado</strong></div>
                                    <div class="has-text-centered">
                                        {{ $matricula->grado | grado }}
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="has-text-centered"><strong>Nivel</strong></div>
                                    <div class="has-text-centered">
                                        {{ $matricula->nivel == 'P' ? 'PRIMARIA' : 'SECUNDARIA' }}
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="has-text-centered"><strong>Año Lectivo</strong></div>
                                    <div class="has-text-centered">
                                        {{ $matricula->anio }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="field">
                        <div class="columns">
                            <div class="column">
                                <label class="label">Tipo de operación:</label>
                                <div class="select is-fullwidth @error('pago.tipo_pago') is-danger @enderror">
                                    <select wire:model.debounce.500ms="pago.tipo_pago">
                                        <option value="" >Seleccione</option>
                                        <option value="A">Depósito en Agente</option>
                                        <option value="D">Depósito en banco</option>
                                        <option value="T">Transferencia bancaria</option>
                                        <option value="Y">Pago YAPE</option>
                                    </select>
                                    @error('pago.tipo_pago')
                                    <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="column">
                                <label class="label">@if($pago['tipo_pago'] === 'Y') Nombre en Yape @else Numero de operación/comprobante @endif</label>
                                <div class="control">
                                    <input type="text" wire:model.debounce.500ms="pago.numero_operacion" class="input @error('pago.numero_operacion') is-danger @enderror" />
                                    @error('pago.numero_operacion')
                                    <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="field">
                        <div class="columns">
                            <div class="column is-2-desktop">
                                <label class="label">Fecha de Pago</label>
                                <div class="control">
                                    <input type="text" wire:model.lazy="pago.fecha" class="input  @error('pago.fecha') is-danger @enderror" id="fecha-pago"/>
                                </div>
                                @error('pago.fecha')
                                    <p class="has-text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="column">
                                <label class="label">Monto Pagado</label>
                                <div class="control">
                                    <input style="text-align: right" type="text" wire:model.debounce.500ms="pago.monto_pagado" class="input  @error('pago.monto_pagado') is-danger @enderror" id="monto-pago"/>
                                </div>
                                @error('pago.monto_pagado')
                                <p class="has-text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="column">
                                <label class="label">Adjuntar comprobante (jpg,png)</label>
                                <div class="file has-name">
                                  <label class="file-label">
                                  <input class="file-input" type="file" name="comprobante" wire:model.debounce.500ms="pago.comprobante">
                                 <span class="file-cta">
                              <span class="file-icon">
                                <i class="fas fa-upload"></i>
                              </span>
                                  <span class="file-label">
                                    Seleccionar
                                  </span>
                                </span>
                                        <span class="file-name">
                                    @if($pago['comprobante'] !== null)
                                        {{ $pago['comprobante']->getClientOriginalName() }}
                                    @endif
                                </span>
                                    </label>
                                </div>
                                <p wire:loading wire:target="pago.comprobante">Cargando... <i class="fas fa-spinner fa-spin"></i></p>
                                @error('pago.comprobante')
                                    <p class="has-text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="field">
                        <div class="columns">
                            <div class="column has-text-left">
                                <a type="button" wire:click="$emit('goToStep', 1)" class="button is-primary"><i class="fas fa-arrow-alt-circle-left" style="margin-right: 5px;"></i> Anterior</a>
                            </div>
                            <div class="column has-text-right">
                                <button class="button is-primary">Registrar pago <i class="fas fa-arrow-alt-circle-right" style="margin-left: 5px;"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            @elseif($step == 3 && $concepto == 'P')
                <form wire:submit.prevent="registrarPagoPension">
                    <div class="field">
                        <div class="matricula-encontrada">
                            <div class="columns is-centered">
                                <div class="column">
                                    <div class="has-text-centered"><strong>Alumno(a)</strong></div>
                                    <div class="has-text-centered">
                                        {{ trim($matricula->alumno->apellido_paterno.' '.$matricula->alumno->apellido_materno.' '.$matricula->alumno->nombres) }}
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="has-text-centered"><strong>Grado</strong></div>
                                    <div class="has-text-centered">
                                        {{ $matricula->grado | grado }}
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="has-text-centered"><strong>Nivel</strong></div>
                                    <div class="has-text-centered">
                                        {{ $matricula->nivel == 'P' ? 'PRIMARIA' : 'SECUNDARIA' }}
                                    </div>
                                </div>
                                <div class="column">
                                    <div class="has-text-centered"><strong>Año Lectivo</strong></div>
                                    <div class="has-text-centered">
                                        {{ $matricula->anio }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="field">
                        <div class="columns">
                            <div class="column">
                                <label class="label">Pensión del mes de:</label>
                                <div class="select is-fullwidth @error('pagopension.mes') is-danger @enderror">
                                    <select wire:model.debounce.500ms="pagopension.mes">
                                        <option value="" disabled>Seleccione</option>
                                        @foreach($pensiones as $pension)
                                            <option value="{{ $pension['value'] }}" @if($pension['disabled']) disabled @endif>{{ $pension['mes'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('pagopension.mes')
                                     <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="column">
                                <label class="label">Monto a pagar:</label>
                                <div class="control">
                                    <input type="text" class="input" value="S./ {{ $pagopension['monto'] }}" disabled />
                                </div>
                            </div>
                            <div class="column is-2-desktop">
                                <label class="label">Fecha de Pago</label>
                                <div class="control">
                                    <input type="text" wire:model.lazy="pagopension.fecha_pago" class="input  @error('pagopension.fecha_pago') is-danger @enderror" id="fecha-pago-pension"/>
                                </div>
                                @error('pagopension.fecha_pago')
                                <p class="has-text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="column">
                                <label class="label">Adjuntar comprobante (jpg,png)</label>
                                <div class="file has-name">
                                    <label class="file-label">
                                        <input class="file-input" type="file" name="comprobante" wire:model.debounce.500ms="pagopension.comprobante">
                                        <span class="file-cta">
                              <span class="file-icon">
                                <i class="fas fa-upload"></i>
                              </span>
                                  <span class="file-label">
                                    Seleccionar
                                  </span>
                                </span>
                                        <span class="file-name">
                                    @if($pagopension['comprobante'] !== null)
                                                {{ $pagopension['comprobante']->getClientOriginalName() }}
                                            @endif
                                </span>
                                    </label>
                                </div>
                                <p wire:loading wire:target="pagopension.comprobante">Cargando... <i class="fas fa-spinner fa-spin"></i></p>
                                @error('pagopension.comprobante')
                                <p class="has-text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="field">
                        <div class="columns">
                            <div class="column has-text-left">
                                <a type="button" wire:click="$emit('goToStep', 2)" class="button is-primary"><i class="fas fa-arrow-alt-circle-left" style="margin-right: 5px;"></i> Anterior</a>
                            </div>
                            <div class="column has-text-right">
                                <button class="button is-primary">Registrar pago <i class="fas fa-arrow-alt-circle-right" style="margin-left: 5px;"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            @elseif($step == 4)
                paso 4
            @endif
        </div>
    </div>
</div>
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        Livewire.on('paso:tres:pago', () => {

            new Pikaday({
                field: document.getElementById('fecha-pago'),
                format: 'DD/MM/YYYY',
                yearRange: [1990,2015],
                i18n: {
                    previousMonth : 'Mes Anterior',
                    nextMonth     : 'Siguiente Mes',
                    months        : ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    weekdays      : ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
                    weekdaysShort : ['Dom','Lun','Mar','Mi','Ju','Vi','Sa']
                },
                toString(date, format) {
                    // you should do formatting based on the passed format,
                    // but we will just return 'D/M/YYYY' for simplicity
                    var day = date.getDate();
                    day = day < 10 ?`0${day}` : day;

                    var month = date.getMonth() + 1;
                    month = month < 10 ?`0${month}` : month;

                    const year = date.getFullYear();
                    return `${day}/${month}/${year}`;
                },
            });

            new Pikaday({
                field: document.getElementById('fecha-pago-pension'),
                format: 'DD/MM/YYYY',
                yearRange: [1990,2015],
                i18n: {
                    previousMonth : 'Mes Anterior',
                    nextMonth     : 'Siguiente Mes',
                    months        : ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                    weekdays      : ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'],
                    weekdaysShort : ['Dom','Lun','Mar','Mi','Ju','Vi','Sa']
                },
                toString(date, format) {
                    // you should do formatting based on the passed format,
                    // but we will just return 'D/M/YYYY' for simplicity
                    var day = date.getDate();
                    day = day < 10 ?`0${day}` : day;

                    var month = date.getMonth() + 1;
                    month = month < 10 ?`0${month}` : month;

                    const year = date.getFullYear();
                    return `${day}/${month}/${year}`;
                },
            });

            new Cleave('#monto-pago', {
                numeral: true,
                decimal: true,
                numeralThousandsGroupStyle: 'thousand'
            });
        });
    });

</script>
<script>
    /*new Cleave('#cod-matricula', {
        delimiters: ['-'],
        blocks: [5, -1, 4],
        uppercase: true
    });*/
    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
</script>
@endpush
