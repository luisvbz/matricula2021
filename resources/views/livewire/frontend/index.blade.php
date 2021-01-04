<div class="container" style="padding-bottom: 50px">
    <div class="loading-matricula"  wire:loading wire:target="guardarPaso1" style="display: none;">
        <div class="loading-matricula-body" style="margin: 100px auto;">
            <div class="spinner" style="text-align: center;">
                <img src="{{ asset('images/loader.svg') }}"/>
            </div>
            <div class="mensaje">
                Procesando.....
            </div>
        </div>
    </div>
    <div class="loading-matricula"  wire:loading wire:target="guardarPaso2" style="display: none;">
        <div class="loading-matricula-body" style="margin: 100px auto;">
            <div class="spinner" style="text-align: center;">
                <img src="{{ asset('images/loader.svg') }}"/>
            </div>
            <div class="mensaje">
                Procesando.....
            </div>
        </div>
    </div>
    <div class="loading-matricula"  wire:loading wire:target="guardarPaso3">
        <div class="loading-matricula-body" style="margin: 100px auto;">
            <div class="spinner" style="text-align: center;">
                <img src="{{ asset('images/loader.svg') }}"/>
            </div>
            <div class="mensaje">
                Procesando.....
            </div>
        </div>
    </div>
    <div class="loading-matricula"  wire:loading wire:target="guardarPaso4" style="display: none;">
        <div class="loading-matricula-body" style="margin: 100px auto;">
            <div class="spinner" style="text-align: center;">
                <img src="{{ asset('images/loader.svg') }}"/>
            </div>
            <div class="mensaje">
                Procesando.....
            </div>
        </div>
    </div>
    <div class="loading-matricula"  wire:loading wire:target="generarFicha" style="display: none;">
        <div class="loading-matricula-body" style="margin: 100px auto;">
            <div class="spinner" style="text-align: center;">
                <img src="{{ asset('images/loader.svg') }}"/>
            </div>
            <div class="mensaje">
                Generando ficha.....
            </div>
        </div>
    </div>
    <div class="form-container">
        @if($isMatriculaActive)
            <div class="step-formulario">
                <ul class="steps has-content-centered is-balanced">
                    <li class="steps-segment @if($step == 1) is-active @endif" style="margin-top: 4px;">
                    <span class="steps-marker">
                        @if($step <= 1) 1 @else <i class="fas fa-check-double"></i> @endif
                    </span>
                        <div class="steps-content">
                            <p class="is-size-5">Datos del Estudiante</p>
                        </div>
                    </li>
                    <li class="steps-segment @if($step == 2) is-active @endif">
                    <span class="steps-marker">
                        @if($step <= 2) 2 @else <i class="fas fa-check-double"></i> @endif
                    </span>
                        <div class="steps-content">
                            <p class="is-size-5">Datos de los Padres</p>
                        </div>
                    </li>
                    <li class="steps-segment @if($step == 3) is-active @endif">
                    <span class="steps-marker">
                        @if($step <= 3) 3 @else <i class="fas fa-check-double"></i> @endif
                    </span>
                        <div class="steps-content">
                            <p class="is-size-5">Datos de Salud</p>
                        </div>
                    </li>
                    <li class="steps-segment @if($step == 4) is-active @endif">
                    <span class="steps-marker">
                        @if($step <= 4) 4 @else <i class="fas fa-check-double"></i> @endif
                    </span>
                    <div class="steps-content">
                        <p class="is-size-5">Verificación de datos</p>
                    </div>
                    </li>
                    <li class="steps-segment @if($step == 5) is-active @endif">
                    <span class="steps-marker">
                         <i class="fas fa-check-double"></i>
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
                     <div class="separador-form">Datos personales</div>
                     <form wire:submit.prevent="guardarPaso1">
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="label">Tipo de documento</label>
                                     <div class="select is-fullwidth @error('estudiante.tipo_documento') is-danger @enderror">
                                         <select wire:model.debounce.500ms="estudiante.tipo_documento">
                                             <option value="DNI">DNI</option>
                                             <option value="CE">CE</option>
                                             <option value="PTP">PTP</option>
                                             <option value="PN">Partida de Nac.</option>
                                         </select>
                                         @error('estudiante.tipo_documento')
                                           <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Numero de Documento</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.numero_documento" class="input @error('estudiante.numero_documento') is-danger @enderror" />
                                         @error('estudiante.numero_documento')
                                            <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Genero</label>
                                     <div class="select is-fullwidth @error('estudiante.genero') is-danger @enderror">
                                         <select wire:model.debounce.500ms="estudiante.genero">
                                             <option value="" disabled selected>Seleccione</option>
                                             <option value="F">Femenino</option>
                                             <option value="M">Masculino</option>
                                         </select>
                                         @error('estudiante.genero')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="label">Apellido Paterno</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.apellido_paterno" class="input @error('estudiante.apellido_paterno') is-danger @enderror" />
                                         @error('estudiante.apellido_paterno')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Apellido Materno</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.apellido_materno" class="input @error('estudiante.apellido_materno') is-danger @enderror" />
                                         @error('estudiante.apellido_materno')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Nombres</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.nombres" class="input @error('estudiante.nombres') is-danger @enderror" />
                                         @error('estudiante.nombres')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="label">Nacionalidad</label>
                                     <div class="select is-fullwidth @error('estudiante.nacionalidad') is-danger @enderror">
                                         <select wire:model.debounce.500ms="estudiante.nacionalidad">
                                             <option value="" disabled selected>Seleccione</option>
                                             @foreach($paises as $pais)
                                                 <option value="{{ $pais->gentilicio }}">{{ $pais->gentilicio }}</option>
                                             @endforeach
                                         </select>
                                         @error('estudiante.nacionalidad')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Departamento</label>
                                     <div class="select is-fullwidth @error('estudiante.departamento') is-danger @enderror">
                                         <select wire:model.debounce.500ms="estudiante.departamento">
                                             <option value="">Seleccione</option>
                                             @foreach($departamentos as $departamento)
                                                 <option value="{{ $departamento->id }}">{{ $departamento->nombre }}</option>
                                             @endforeach
                                         </select>
                                         @error('estudiante.departamento')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Provincia</label>
                                     <div class="select is-fullwidth @error('estudiante.provincia') is-danger @enderror">
                                         <select wire:model.debounce.500ms="estudiante.provincia" @if(sizeof($provincias) == 0) disabled @endif>
                                             <option value="">Seleccione</option>
                                             @foreach($provincias as $provincia)
                                                 <option value="{{ $provincia->id }}">{{ $provincia->nombre }}</option>
                                             @endforeach
                                         </select>
                                         @error('estudiante.provincia')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Distrito</label>
                                     <div class="select is-fullwidth @error('estudiante.distrito') is-danger @enderror">
                                         <select wire:model.debounce.500ms="estudiante.distrito" @if(sizeof($distritos) == 0) disabled @endif>
                                             <option value="">Seleccione</option>
                                             @foreach($distritos as $distrito)
                                                 <option value="{{ $distrito->id }}">{{ $distrito->nombre }}</option>
                                             @endforeach
                                         </select>
                                         @error('estudiante.distrito')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="field">
                            <div class="columns">
                                <div class="column is-4-desktop">
                                    <label class="label">Fecha Nacimiento</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.lazy="estudiante.fecha_nac" class="input  @error('estudiante.fecha_nac') is-danger @enderror" id="fecha-nacimiento"/>
                                    </div>
                                    @error('estudiante.fecha_nac')
                                    <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="column">
                                    <label class="label">Domicilio</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.domicilio" class="input @error('estudiante.domicilio') is-danger @enderror" />
                                        @error('estudiante.domicilio')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                         </div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="label">Telefono Fijo</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.telefono_fijo" class="input @error('estudiante.telefono_fijo') is-danger @enderror" />
                                         @error('estudiante.telefono_fijo')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Telefono Celular</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.telefono_celular" class="input @error('estudiante.telefono_celular') is-danger @enderror" />
                                         @error('estudiante.telefono_celular')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Telefono Emergencia</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.telefono_emergencia" class="input @error('estudiante.telefono_emergencia') is-danger @enderror" />
                                         @error('estudiante.telefono_emergencia')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="label">Correo electrónico</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.correo_electronico" class="input @error('estudiante.correo_electronico') is-danger @enderror" />
                                         @error('estudiante.correo_electronico')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="label">Colegio de procedencia</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.colegio_procedencia" class="input @error('estudiante.colegio_procedencia') is-danger @enderror" />
                                         @error('estudiante.colegio_procedencia')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Situación final</label>
                                     <div class="select is-fullwidth">
                                         <select wire:model.debounce.500ms="estudiante.situacion_final">
                                             <option value="" selected disabled>Seleccione</option>
                                             <option value="APROBADO">APROBADO</option>
                                             <option value="REPITIENTE">REPITIENTE</option>
                                         </select>
                                         @error('estudiante.situacion_final')
                                            <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="label">Religión</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.religion" class="input @error('estudiante.religion') is-danger @enderror" />
                                         @error('estudiante.religion')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Parroquia</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.parroquia" class="input @error('estudiante.parroquia') is-danger @enderror" />
                                         @error('estudiante.parroquia')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="checkbox">
                                        Exonerado(a) de religión?
                                         <input type="checkbox"  wire:model.debounce.500ms="estudiante.exonerado_religion">
                                     </label>
                                 </div>
                                 <div class="column">
                                     <label class="checkbox">
                                         Bautizado?
                                         <input type="checkbox"  @if($estudiante['exonerado_religion']) disabled @endif wire:model.debounce.500ms="estudiante.bautizado">
                                     </label>
                                 </div>
                                 <div class="column">
                                     <label class="checkbox">
                                         1era Comunión?
                                         <input type="checkbox"  @if($estudiante['exonerado_religion']) disabled @endif  wire:model.debounce.500ms="estudiante.comunion">
                                     </label>
                                 </div>
                                 <div class="column">
                                     <label class="checkbox">
                                         Confirmación?
                                         <input type="checkbox"  @if($estudiante['exonerado_religion']) disabled @endif  wire:model.debounce.500ms="estudiante.confirmacion">
                                     </label>
                                 </div>
                             </div>
                         </div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label>
                                     <input type="checkbox"  wire:model.debounce.500ms="estudiante.nee">
                                        Necesidades Educativas Especiales (NEE) Asociadas a discapacidad?
                                     </label>
                                 </div>
                             </div>
                         </div>
                         <div class="field">
                            <div class="columns">
                                @foreach($necesidades as $necesidad)
                                    <div class="column">
                                        <label>
                                        {{ $necesidad }}
                                            <input type="checkbox"  value="{{ $necesidad }}" wire:model="nees" @if(!$estudiante['nee']) disabled @endif/>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                         </div>
                         <div class="separador-form">Desarrollo psicomotor (Ej: 7 meses, 1 año, etc.)</div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="label">Se sentó</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.se_sento" class="input @error('estudiante.se_sento') is-danger @enderror" />
                                         @error('estudiante.se_sento')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Controló sus esfinteres</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.control_esfinteres" class="input @error('estudiante.control_esfinteres') is-danger @enderror" />
                                         @error('estudiante.control_esfinteres')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Caminó</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.camino" class="input @error('estudiante.camino') is-danger @enderror" />
                                         @error('estudiante.camino')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Habló con fluidez</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.hablo_fluido" class="input @error('estudiante.hablo_fluido') is-danger @enderror" />
                                         @error('estudiante.hablo_fluido')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="label">Se paró</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.se_paro" class="input @error('estudiante.se_paro') is-danger @enderror" />
                                         @error('estudiante.se_paro')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Habló las 1eras palabras</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.primeras_palabras" class="input @error('estudiante.primeras_palabras') is-danger @enderror" />
                                         @error('estudiante.primeras_palabras')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Levantó la cabeza</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.levanto_cabeza" class="input @error('estudiante.levanto_cabeza') is-danger @enderror" />
                                         @error('estudiante.levanto_cabeza')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Gateó</label>
                                     <div class="control">
                                         <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="estudiante.gateo" class="input @error('estudiante.gateo') is-danger @enderror" />
                                         @error('estudiante.gateo')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="separador-form">Datos para la mátricula</div>
                         <div class="field">
                             <div class="columns">
                                 <div class="column">
                                     <label class="label">Nivel</label>
                                     <div class="select is-fullwidth @error('estudiante.nivel') is-danger @enderror">
                                         <select wire:model.debounce.500ms="estudiante.nivel">
                                             <option value="" disabled selected>Seleccione</option>
                                             <option value="P">Primaria</option>
                                             <option value="S">Secundaria</option>
                                         </select>
                                         @error('estudiante.nivel')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                                 <div class="column">
                                     <label class="label">Grado a matricular</label>
                                     <div class="select is-fullwidth @error('estudiante.grado') is-danger @enderror">
                                         <select wire:model.debounce.500ms="estudiante.grado" @if(sizeof($grados) == 0) disabled @endif>
                                             <option value="" disabled selected>Seleccione</option>
                                             @foreach($grados as $grado)
                                                <option value="{{ $grado->numero }}">{{ $grado->nombre }}</option>
                                             @endforeach
                                         </select>
                                         @error('estudiante.grado')
                                         <p class="has-text-danger">{{ $message }}</p>
                                         @enderror
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <hr>
                         <div class="field">
                             <div class="columns">
                                 <div class="column has-text-right">
                                     <button class="button is-primary">Siguiente <i class="fas fa-arrow-alt-circle-right" style="margin-left: 5px;"></i></button>
                                 </div>
                             </div>
                         </div>
                     </form>
                 @elseif($step === 2)
                    <form wire:submit.prevent="guardarPaso2">
                        <div class="separador-form">Datos del padre</div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Tipo de documento</label>
                                    <div class="select is-fullwidth @error('padre.tipo_documento') is-danger @enderror">
                                        <select wire:model.debounce.500ms="padre.tipo_documento">
                                            <option value="DNI">DNI</option>
                                            <option value="CE">CE</option>
                                            <option value="PTP">PTP</option>
                                        </select>
                                        @error('padre.tipo_documento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Numero de Documento</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="padre.numero_documento" class="input @error('padre.numero_documento') is-danger @enderror" />
                                        @error('padre.numero_documento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column is-4-desktop">
                                    <label class="label">Fecha Nacimiento</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.lazy="padre.fecha_nac" class="input  @error('padre.fecha_nac') is-danger @enderror" id="fecha-nacimiento-padre"/>
                                    </div>
                                    @error('padre.fecha_nac')
                                    <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="column">
                                    <label class="label">Vive?</label>
                                    <div class="select is-fullwidth  @error('padre.vive') is-danger @enderror">
                                        <select wire:model.debounce.500ms="padre.vive">
                                            <option value="true">Sí</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                    @error('padre.vive')
                                    <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Apellidos</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="padre.apellidos" class="input @error('padre.apellidos') is-danger @enderror" />
                                        @error('padre.apellidos')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Nombres</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="padre.nombres" class="input @error('padre.nombres') is-danger @enderror" />
                                        @error('padre.nombres')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Estado Civil</label>
                                    <div class="select is-fullwidth  @error('padre.estado_civil') is-danger @enderror">
                                        <select wire:model.debounce.500ms="padre.estado_civil" @if(!$padre['vive']) disabled @endif>
                                            <option value="" selected disabled>Seleccione</option>
                                            <option value="S">Soltero(a)</option>
                                            <option value="C">Casado(a)</option>
                                            <option value="D">Divorciado(a)</option>
                                            <option value="V">Viudo(a)</option>
                                        </select>
                                        @error('padre.estado_civil')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Domicilio</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$padre['vive']) disabled @endif wire:model.debounce.500ms="padre.domicilio" class="input @error('padre.domicilio') is-danger @enderror" />
                                        @error('padre.domicilio')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Celular</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$padre['vive']) disabled @endif wire:model.debounce.500ms="padre.telefono_celular" class="input @error('padre.telefono_celular') is-danger @enderror" />
                                        @error('padre.telefono_celular')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Correo electrónico</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$padre['vive']) disabled @endif wire:model.debounce.500ms="padre.correo_electronico" class="input @error('padre.correo_electronico') is-danger @enderror" />
                                        @error('padre.correo_electronico')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Nivel escolaridad</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$padre['vive']) disabled @endif wire:model.debounce.500ms="padre.nivel_escolaridad" class="input @error('padre.nivel_escolaridad') is-danger @enderror" />
                                        @error('padre.nivel_escolaridad')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Centro del Trabajo</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$padre['vive']) disabled @endif wire:model.debounce.500ms="padre.centro_trabajo" class="input @error('padre.centro_trabajo') is-danger @enderror" />
                                        @error('padre.centro_trabajo')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Cargo/Ocupación</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$padre['vive']) disabled @endif wire:model.debounce.500ms="padre.cargo_ocupacion" class="input @error('padre.cargo_ocupacion') is-danger @enderror" />
                                        @error('padre.cargo_ocupacion')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="checkbox">
                                        Vive con el estudiante?
                                        <input type="checkbox"  @if(!$padre['vive']) disabled @endif wire:model.debounce.500ms="padre.vive_estudiante">
                                    </label>
                                </div>
                                <div class="column">
                                    <label class="checkbox">
                                        Es apoderado?
                                        <input type="checkbox"  @if(!$padre['vive']) disabled @endif wire:model.debounce.500ms="padre.apoderado">
                                    </label>
                                </div>
                                <div class="column">
                                    <label class="checkbox">
                                        Reponsable económico?
                                        <input type="checkbox"  @if(!$padre['vive']) disabled @endif wire:model.debounce.500ms="padre.responsable_economico">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="separador-form">Datos de la madre</div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Tipo de documento</label>
                                    <div class="select is-fullwidth @error('madre.tipo_documento') is-danger @enderror">
                                        <select wire:model.debounce.500ms="madre.tipo_documento">
                                            <option value="DNI">DNI</option>
                                            <option value="CE">CE</option>
                                            <option value="PTP">PTP</option>
                                        </select>
                                        @error('madre.tipo_documento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Numero de Documento</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="madre.numero_documento" class="input @error('madre.numero_documento') is-danger @enderror" />
                                        @error('madre.numero_documento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column is-4-desktop">
                                    <label class="label">Fecha Nacimiento</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.lazy="madre.fecha_nac" class="input  @error('madre.fecha_nac') is-danger @enderror" id="fecha-nacimiento-madre"/>
                                    </div>
                                    @error('madre.fecha_nac')
                                    <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="column">
                                    <label class="label">Vive?</label>
                                    <div class="select is-fullwidth  @error('madre.vive') is-danger @enderror">
                                        <select wire:model.debounce.500ms="madre.vive">
                                            <option value="true">Sí</option>
                                            <option value="false">No</option>
                                        </select>
                                    </div>
                                    @error('madre.vive')
                                    <p class="has-text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Apellidos</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="madre.apellidos" class="input @error('madre.apellidos') is-danger @enderror" />
                                        @error('madre.apellidos')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Nombres</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="madre.nombres" class="input @error('madre.nombres') is-danger @enderror" />
                                        @error('madre.nombres')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Estado Civil</label>
                                    <div class="select is-fullwidth  @error('madre.estado_civil') is-danger @enderror">
                                        <select wire:model.debounce.500ms="madre.estado_civil" @if(!$madre['vive']) disabled @endif>
                                            <option value="" selected disabled>Seleccione</option>
                                            <option value="S">Soltero(a)</option>
                                            <option value="C">Casado(a)</option>
                                            <option value="D">Divorciado(a)</option>
                                            <option value="V">Viudo(a)</option>
                                        </select>
                                        @error('madre.estado_civil')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Domicilio</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$madre['vive']) disabled @endif wire:model.debounce.500ms="madre.domicilio" class="input @error('madre.domicilio') is-danger @enderror" />
                                        @error('madre.domicilio')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Celular</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$madre['vive']) disabled @endif wire:model.debounce.500ms="madre.telefono_celular" class="input @error('madre.telefono_celular') is-danger @enderror" />
                                        @error('madre.telefono_celular')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Correo electrónico</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$madre['vive']) disabled @endif wire:model.debounce.500ms="madre.correo_electronico" class="input @error('madre.correo_electronico') is-danger @enderror" />
                                        @error('madre.correo_electronico')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Nivel escolaridad</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$madre['vive']) disabled @endif wire:model.debounce.500ms="madre.nivel_escolaridad" class="input @error('madre.nivel_escolaridad') is-danger @enderror" />
                                        @error('madre.nivel_escolaridad')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Centro del Trabajo</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$madre['vive']) disabled @endif wire:model.debounce.500ms="madre.centro_trabajo" class="input @error('madre.centro_trabajo') is-danger @enderror" />
                                        @error('madre.centro_trabajo')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Cargo/Ocupación</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$madre['vive']) disabled @endif wire:model.debounce.500ms="madre.cargo_ocupacion" class="input @error('madre.cargo_ocupacion') is-danger @enderror" />
                                        @error('madre.cargo_ocupacion')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="checkbox">
                                        Vive con el estudiante?
                                        <input type="checkbox"  @if(!$madre['vive']) disabled @endif wire:model.debounce.500ms="madre.vive_estudiante">
                                    </label>
                                </div>
                                <div class="column">
                                    <label class="checkbox">
                                        Es apoderado?
                                        <input type="checkbox"  @if(!$madre['vive']) disabled @endif wire:model.debounce.500ms="madre.apoderado">
                                    </label>
                                </div>
                                <div class="column">
                                    <label class="checkbox">
                                        Reponsable económico?
                                        <input type="checkbox"  @if(!$madre['vive']) disabled @endif wire:model.debounce.500ms="madre.responsable_economico">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="separador-form">Datos del apoderado distinto a padre o  madre</div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="checkbox">
                                        <input type="checkbox" wire:model.debounce.500ms="apoderado.rellenar">
                                        Desea llenar los campos del apoderado?
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Tipo de documento</label>
                                    <div class="select is-fullwidth @error('apoderado.tipo_documento') is-danger @enderror">
                                        <select @if(!$apoderado['rellenar']) disabled @endif wire:model.debounce.500ms="madre.tipo_documento">
                                            <option value="DNI">DNI</option>
                                            <option value="CE">CE</option>
                                            <option value="PTP">PTP</option>
                                        </select>
                                        @error('apoderado.tipo_documento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Numero de Documento</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$apoderado['rellenar']) disabled @endif wire:model.debounce.500ms="apoderado.numero_documento" class="input @error('apoderado.numero_documento') is-danger @enderror" />
                                        @error('apoderado.numero_documento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Parentesco</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$apoderado['rellenar']) disabled @endif wire:model.debounce.500ms="apoderado.parentesco" class="input @error('apoderado.parentesco') is-danger @enderror" />
                                        @error('apoderado.parentesco')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Apellidos</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$apoderado['rellenar']) disabled @endif wire:model.debounce.500ms="apoderado.apellidos" class="input @error('apoderado.apellidos') is-danger @enderror" />
                                        @error('apoderado.apellidos')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Nombres</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$apoderado['rellenar']) disabled @endif wire:model.debounce.500ms="apoderado.nombres" class="input @error('apoderado.nombres') is-danger @enderror" />
                                        @error('apoderado.nombres')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Celular</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);"  @if(!$apoderado['rellenar']) disabled @endif wire:model.debounce.500ms="apoderado.telefono_celular" class="input @error('apoderado.telefono_celular') is-danger @enderror" />
                                        @error('apoderado.telefono_celular')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Correo electrónico</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);"  @if(!$apoderado['rellenar']) disabled @endif wire:model.debounce.500ms="apoderado.correo_electronico" class="input @error('apoderado.correo_electronico') is-danger @enderror" />
                                        @error('apoderado.correo_electronico')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Nivel escolaridad</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$apoderado['rellenar']) disabled @endif  wire:model.debounce.500ms="apoderado.grado_escolaridad" class="input @error('apoderado.grado_escolaridad') is-danger @enderror" />
                                        @error('apoderado.grado_escolaridad')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Grado Obtenido</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$apoderado['rellenar']) disabled @endif  wire:model.debounce.500ms="apoderado.grado_obtenido" class="input @error('apoderado.grado_obtenido') is-danger @enderror" />
                                        @error('apoderado.grado_obtenido')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Centro del Trabajo</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if(!$apoderado['rellenar']) disabled @endif  wire:model.debounce.500ms="apoderado.centro_trabajo" class="input @error('apoderado.centro_trabajo') is-danger @enderror" />
                                        @error('apoderado.centro_trabajo')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="checkbox">
                                        Vive con el estudiante?
                                        <input type="checkbox"   @if(!$apoderado['rellenar']) disabled @endif  wire:model.debounce.500ms="apoderado.vive_estudiante">
                                    </label>
                                </div>
                                <div class="column">
                                    <label class="checkbox">
                                        Es apoderado?
                                        <input type="checkbox"   @if(!$apoderado['rellenar']) disabled @endif  wire:model.debounce.500ms="apoderado.apoderado">
                                    </label>
                                </div>
                                <div class="column">
                                    <label class="checkbox">
                                        Reponsable económico?
                                        <input type="checkbox"   @if(!$apoderado['rellenar']) disabled @endif  wire:model.debounce.500ms="apoderado.responsable_economico">
                                    </label>
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
                                    <button class="button is-primary">Siguiente <i class="fas fa-arrow-alt-circle-right" style="margin-left: 5px;"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                @elseif($step === 3)
                    <form wire:submit.prevent="guardarPaso3">
                        <p>Llené los datos del formulario y en la parte inferior podrá observar la declaración jurada.</p>
                        <div class="field">
                            <div class="columns">
                                <div class="column is-2-desktop">
                                    <label class="label">Tipo de documento</label>
                                    <div class="select is-fullwidth @error('salud.tipo_documento') is-danger @enderror">
                                        <select  wire:model.debounce.500ms="salud.tipo_documento">
                                            <option value="DNI">DNI</option>
                                            <option value="CE">CE</option>
                                            <option value="PTP">PTP</option>
                                        </select>
                                        @error('salud.tipo_documento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Numero de Documento</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="salud.numero_documento" class="input @error('salud.numero_documento') is-danger @enderror" />
                                        @error('salud.numero_documento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Nombres</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if($salud['block'])  disabled @endif   wire:model.debounce.500ms="salud.nombres" class="input @error('salud.nombres') is-danger @enderror" />
                                        @error('salud.nombres')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Parentesco</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);"   wire:model.debounce.500ms="salud.parentesco" class="input @error('salud.parentesco') is-danger @enderror" />
                                        @error('salud.parentesco')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Nombre establecimiento (Caso de Emergencia)</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);"   wire:model.debounce.500ms="salud.nombre_establecimiento" class="input @error('salud.nombre_establecimiento') is-danger @enderror" />
                                        @error('salud.nombre_establecimiento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Dirección del Establecimiento</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);"   wire:model.debounce.500ms="salud.direccion" class="input @error('salud.direccion') is-danger @enderror" />
                                        @error('salud.direccion')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Referencia</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);"   wire:model.debounce.500ms="salud.referencia" class="input @error('salud.referencia') is-danger @enderror" />
                                        @error('salud.referencia')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Tipo de seguro</label>
                                    <div class="select is-fullwidth @error('salud.tipo_seguro') is-danger @enderror">
                                        <select  wire:model.debounce.500ms="salud.tipo_seguro">
                                            <option value="" selected disabled>Seleccione</option>
                                            <option value="SIS">SIS</option>
                                            <option value="ESSALUD">ESSALUD</option>
                                            <option value="EPS">EPS</option>
                                            <option value="OTRO">OTRO</option>
                                        </select>
                                        @error('salud.tipo_seguro')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Especificar otro</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);"  @if($salud['tipo_seguro'] != 'OTRO') disabled @endif wire:model.debounce.500ms="salud.otro_seguro" class="input @error('salud.otro_seguro') is-danger @enderror" />
                                        @error('salud.otro_seguro')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="declaracion-jurada" style="padding: 10px;">
                            <h3 class="has-text-centered">DECLARACIÓN JURADA DEL SEGURO DE SALUD DEL ESTUDIANTE</h3><br>
                            <p style="text-align: justify; font-size: 17px;">
                                Yo, <b>{{ $salud['nombres'] }}</b>, con documento de identidad N° <b>{{ $salud['numero_documento'] }}</b>,
                                en representación de mi hijo(a) con nombre <b>{{ $estudiante['apellido_paterno'].' '.$estudiante['apellido_materno'] }}, {{ $estudiante['nombres'] }}</b>
                                con documento de identidad N° <b>{{ $estudiante['numero_documento'] }}</b>,
                                declaro bajo juramento que, autorizo e informo a la Instituciòn Educativa Privada (En adelante el “COLEGIO”),
                                con Ruc 10254934475 y domicilio en Jr. Cailloma Nº 574 Cercado de Lima, de lo siguiente:
                            </p>
                            <ol>
                                <li>Conozco, que el COLEGIO no tiene convenio con ninguna clínica, hospital u otros análogos para la contratación de los seguros de salud de mi hijo(a), por lo que, no he sido informado de ningún programa de protección de salud.</li>
                                <li>
                                    Informo, que soy el único responsable de la protección de salud de mi hijo(a), por lo que, pongo de conocimiento del COLEGIO, el seguro de protección de salud y el establecimiento donde deberá ser derivado mi hijo(a) en caso de emergencia:<br>
                                    <b>Nombre del establecimiento: </b> {{ $salud['nombre_establecimiento'] }}<br>
                                    <b>Dirección: </b> {{ $salud['direccion'] }}.<br>
                                    <b>Referencia: </b> {{ $salud['referencia'] }}.<br>
                                    <b>Tipo de Seguro: </b> {{ $salud['tipo_seguro'] != 'OTRO' ? $salud['tipo_seguro'] : $salud['otro_seguro'] }}.<br>
                                </li>
                                <li>Acepto, que soy el único responsable en mantener activo el seguro de protección de salud de mi hijo(a), por lo que, los gastos derivados en caso de desprotección ante una emergencia son de mi responsabilidad.</li>
                                <li>Conozco, que en caso de emergencia el COLEGIO activará su protocolo de contingencias administrativas, referido al procedimiento de emergencia por accidentes.</li>
                            </ol>
                        </div>
                        <hr>
                        <div class="field">
                            <div class="columns">
                                <div class="column has-text-left">
                                    <a type="button" wire:click="$emit('goToStep', 2)" class="button is-primary"><i class="fas fa-arrow-alt-circle-left" style="margin-right: 5px;"></i> Anterior</a>
                                </div>
                                <div class="column has-text-right">
                                    <button class="button is-primary">Siguiente <i class="fas fa-arrow-alt-circle-right" style="margin-left: 5px;"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                @elseif($step === 4)
                    <form wire:submit.prevent="guardarPaso4">
                        <div class="separador-form">Datos del estudiante</div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Tipo doc.</label>
                                    <div class="control">
                                        <p>{{ $estudiante['tipo_documento'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Numero Doc.</label>
                                    <div class="control">
                                        <p>{{ $estudiante['numero_documento'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Apellidos</label>
                                    <div class="controls">
                                        <p>{{ $estudiante['apellido_paterno'] }} {{ $estudiante['apellido_materno'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Nombres</label>
                                    <div class="control">
                                        <p>{{ $estudiante['nombres'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Nivel a matricular</label>
                                    <div class="control">
                                        <p>{{ $estudiante['nivel'] == 'P' ? 'Primaria' : 'Secundaria' }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Grado a matricular</label>
                                    <div class="control">
                                        <p>{{ $estudiante['grado'] }}°</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Exonerado Religión</label>
                                    <div class="control">
                                        <p>{{ $estudiante['exonerado_religion'] ? 'Si' : 'No' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Fena de Nacimiento</label>
                                    <div class="control">
                                        <p>{{ $estudiante['fecha_nac']  }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Teléfono Celular</label>
                                    <div class="control">
                                        <p>{{ $estudiante['telefono_celular']  }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Teléfono de Emergencia</label>
                                    <div class="control">
                                        <p>{{ $estudiante['telefono_emergencia']  }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separador-form">Datos del padre</div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Tipo doc.</label>
                                    <div class="control">
                                        <p>{{ $padre['tipo_documento'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Numero Doc.</label>
                                    <div class="control">
                                        <p>{{ $padre['numero_documento'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Apellidos</label>
                                    <div class="controls">
                                        <p>{{ $padre['apellidos'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Nombres</label>
                                    <div class="control">
                                        <p>{{ $padre['nombres'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Teléfono Celular</label>
                                    <div class="control">
                                        <p>{{ $padre['telefono_celular'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Correo Electrónico</label>
                                    <div class="control">
                                        <p>{{ $padre['correo_electronico'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separador-form">Datos de la madre</div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Tipo doc.</label>
                                    <div class="control">
                                        <p>{{ $madre['tipo_documento'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Numero Doc.</label>
                                    <div class="control">
                                        <p>{{ $madre['numero_documento'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Apellidos</label>
                                    <div class="controls">
                                        <p>{{ $madre['apellidos'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Nombres</label>
                                    <div class="control">
                                        <p>{{ $madre['nombres'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Teléfono Celular</label>
                                    <div class="control">
                                        <p>{{ $madre['telefono_celular'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Correo Electrónico</label>
                                    <div class="control">
                                        <p>{{ $madre['correo_electronico'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($apoderado['rellenar'])
                            <div class="separador-form">Datos del apoderado</div>
                            <div class="field">
                                <div class="columns">
                                    <div class="column">
                                        <label class="label">Tipo doc.</label>
                                        <div class="control">
                                            <p>{{ $apoderado['tipo_documento'] }}</p>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <label class="label">Numero Doc.</label>
                                        <div class="control">
                                            <p>{{ $apoderado['numero_documento'] }}</p>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <label class="label">Apellidos</label>
                                        <div class="controls">
                                            <p>{{ $apoderado['apellidos'] }}</p>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <label class="label">Nombres</label>
                                        <div class="control">
                                            <p>{{ $apoderado['nombres'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <div class="columns">
                                    <div class="column">
                                        <label class="label">Teléfono Celular</label>
                                        <div class="control">
                                            <p>{{ $apoderado['telefono_celular'] }}</p>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <label class="label">Correo Electrónico</label>
                                        <div class="control">
                                            <p>{{ $apoderado['correo_electronico'] }}</p>
                                        </div>
                                    </div>
                                    <div class="column">
                                        <label class="label">Parentesco</label>
                                        <div class="control">
                                            <p>{{ $apoderado['parentesco'] }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="separador-form">Datos de seguro de salud</div>
                        <div class="field">
                            <div class="columns">
                                <div class="column">
                                    <label class="label">Establecimiento de Salud</label>
                                    <div class="control">
                                        <p>{{ $salud['nombre_establecimiento'] }}</p>
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Tipo de Seguro</label>
                                    <div class="control">
                                        <p>{{ $salud['tipo_seguro'] != 'OTRO' ? $salud['tipo_seguro'] : $salud['otro_seguro'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separador-form">Datos del responsable por el pago de matricula y pensiones</div>
                        <div class="field">
                            <div class="columns">
                                <div class="column is-2-desktop">
                                    <label class="label">Tipo de documento</label>
                                    <div class="select is-fullwidth @error('dj.tipo_documento') is-danger @enderror">
                                        <select  wire:model.debounce.500ms="dj.tipo_documento">
                                            <option value="DNI">DNI</option>
                                            <option value="CE">CE</option>
                                            <option value="PTP">PTP</option>
                                        </select>
                                        @error('dj.tipo_documento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Numero de Documento</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" wire:model.debounce.500ms="dj.numero_documento" class="input @error('dj.numero_documento') is-danger @enderror" />
                                        @error('dj.numero_documento')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="column">
                                    <label class="label">Nombres</label>
                                    <div class="control">
                                        <input type="text" onkeyup="mayus(this);" @if($dj['block'])  disabled @endif   wire:model.debounce.500ms="dj.nombres" class="input @error('dj.nombres') is-danger @enderror" />
                                        @error('dj.nombres')
                                        <p class="has-text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="field">
                            Yo, <strong>{{ $dj['nombres'] }}</strong> con documento <strong>{{ $dj['tipo_documento'] }} {{ $dj['numero_documento'] }}</strong> declaro que soy el responsable del pago de la matricula y pensiones de enseñanza.
                        </div>
                        <hr>
                        <div class="field">
                            <div class="columns">
                                <div class="column has-text-left">
                                    <a type="button" wire:click="$emit('goToStep', 2)" class="button is-primary"><i class="fas fa-arrow-alt-circle-left" style="margin-right: 5px;"></i> Anterior</a>
                                </div>
                                <div class="column has-text-right">
                                    <button class="button is-primary">Matricular <i class="fas fa-arrow-alt-circle-right" style="margin-left: 5px;"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                @elseif($step === 5)
                    <div class="matricula-finalizada">
                        <div class="mensaje">
                            Su matrícula ha sido recibida con éxito, recuerde descargar su ficha
                        </div>
                        <div class="codigo-matricula">
                            COD: <strong>{{ $matricula->codigo }}</strong>
                        </div>
                        <div class="botones">
                            <div class="columns">
                                <div class="column has-text-centered">
                                    <button wire:click="generarFicha" class="button is-primary">Descargar Ficha <i style="margin-left: 5px;" class="fas fa-file-pdf"></i></button>
                                    <a  href="{{ route('registrar.pago') }}" class="button">Registrar pago <i style="margin-left: 5px;" class="fas fa-money-bill"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @else
            <div class="no-matricula">
                <div class="has-text-centered">
                    <h4>Lo sentimos nuestra matricula para el año en curso esta cerrada</h4>
                </div>
                <div class="imagen">
                    <img src="{{ asset('images/no-matricula.jpg') }}"/>
                </div>
            </div>
        @endif
    </div>
</div>


@push('js')
    <script>
        function mayus(e) {
            e.value = e.value.toUpperCase();
        }
        document.addEventListener('livewire:load', function () {
            new Pikaday({
                field: document.getElementById('fecha-nacimiento'),
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

            Livewire.on('to:top', () => {
                console.log('totop');
                document.body.scrollTop = 0; // For Safari
                document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
            });

            Livewire.on('paso:padres', () => {
                new Pikaday({
                    field: document.getElementById('fecha-nacimiento-padre'),
                    format: 'DD/MM/YYYY',
                    yearRange: [1920,2015],
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
                    field: document.getElementById('fecha-nacimiento-madre'),
                    format: 'DD/MM/YYYY',
                    yearRange: [1920,2015],
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
            });


        });
    </script>
@endpush
