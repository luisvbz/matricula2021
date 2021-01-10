@section('title')
    Estado de Cuenta
@endsection
<div class="container" style="padding-bottom: 50px">
    <div class="loading-matricula"  wire:loading wire:target="consultarMatricula" style="display: none;">
        <div class="loading-matricula-body" style="margin: 100px auto;">
            <div class="spinner" style="text-align: center;">
                <img src="{{ asset('images/loader.svg') }}"/>
            </div>
            <div class="mensaje">
                Consultando.....
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
                        <p class="is-size-5">Estado de cuenta</p>
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
                                <label class="label">DNI DEL ALUMNO</label>
                                <div class="control">
                                    <input type="text" onkeyup="mayus(this);" id="cod-matricula" class="input  @error('codigo') is-danger @enderror" style="text-align: center;" wire:model.defer="codigo"/>
                                    @error('codigo')
                                    <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <hr>
                                <div class="notification">
                                   Ingrese el DNI del alumno, sin separaciones ni guiones. Tampoco debe agregar el codigo verificador
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
                <div class="estado-pensiones">
                    <div class="pension-cabecera">
                        <div class="pension-cabecera-orden">ORDEN</div>
                        <div class="pension-cabecera-concepto">CONCEPTO</div>
                        <div class="pension-cabecera-monto">MONTO</div>
                        <div class="pension-cabecera-vencimiento">FECH. VENCIMIENTO</div>
                        <div class="pension-cabecera-pagada">PAGADA</div>
                        <div class="pension-cabecera-comprobante">COMPROBANTE</div>
                        <div class="pension-cabecera-fecha-pago">FECH. PAGO</div>
                    </div>
                    @foreach($misPensiones as $pension)
                        <div class="pension @if($pension->vencido && $pension->estado == null) pension-vencida @endif">
                            <div class="pension-orden">{{ $pension->orden }}</div>
                            <div class="pension-concepto">{{ $pension->nombre }}</div>
                            <div class="pension-monto">S./ {{ $pension->costo }}</div>
                            <div class="pension-vencimiento">{{ $pension->fecha_vencimiento | dateFormat }}</div>
                            <div class="pension-pagada">
                                @if($pension->estado != null)
                                    @if($pension->estado == 1)
                                        <span class="has-text-success"><i class="fas fa-check-double"></i></span>
                                     @elseif($pension->estado == 0)
                                        <span class="has-text-grey"><i class="fas fa-check-double"></i></span>
                                     @endif
                                @else
                                    @if($pension->vencido)
                                        <span class="has-text-danger"><i class="fas fa-times"></i></span>
                                    @else
                                        <span class="has-text-grey-dark"><i class="fas fa-clock"></i></span>
                                    @endif
                                @endif
                            </div>
                            <div class="pension-comprobante">
                                @if($pension->estado != null)
                                    <span class="has-text-success"><i class="fas fa-file-invoice"></i></span>
                                @else
                                    <span class="has-text-grey-dark"><i class="fas fa-clock"></i></span>
                                @endif
                            </div>
                            <div class="pension-fecha-pago">
                                @if($pension->estado != null)
                                    {{ $pension->fecha_pago | dateFormat }}
                                @else
                                    <span class="has-text-grey-dark"><i class="fas fa-clock"></i></span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
                <hr>
                <div class="field">
                    <div class="columns">
                        <div class="column has-text-left">
                            <a class="button is-primary" href="{{ route('estado.cuenta') }}">Salir <i class="fas fa-sign-in" style="margin-left: 5px;"></i></a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
