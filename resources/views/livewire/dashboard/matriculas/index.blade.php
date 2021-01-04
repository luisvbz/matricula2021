<div class="content-dashboard">
    <div class="content-dashboard-header">
        <div><i class="fas fa-graduation-cap"></i> Matrículas</div>
    </div>
    <div class="content-dashboard-search-bar">
        <div class="columns">
            <div class="column is-4">
                <div class="control has-icons-left">
                    <input type="text" class="input" wire:model.defer="search" placeholder="Buscar por nombre o DNI del estudiante"/>
                    <span class="icon is-small is-left">
                            <i class="fas fa-search"></i>
                        </span>
                </div>
            </div>
            <div class="column is-2">
                <div class="select is-fullwidth">
                    <select wire:model.defer="estado">
                        <option value="" selected>Estado</option>
                        <option value="0">Pendiente</option>
                        <option value="1">Confirmada</option>
                        <option value="2">Anulada</option>
                    </select>
                </div>
            </div>
            <div class="column is-2">
                <div class="select is-fullwidth">
                    <select wire:model.defer="nivel">
                        <option value="" selected>Nivel</option>
                        <option value="P">Primaria</option>
                        <option value="S">Secundaria</option>
                    </select>
                </div>
            </div>
            <div class="column is-2">
                <div class="select is-fullwidth">
                    <select wire:model.defer="grado">
                        <option value="" selected>Grado</option>
                        <option value="1">Primero</option>
                        <option value="2">Segundo</option>
                        <option value="3">Tercero</option>
                        <option value="4">Cuarto</option>
                        <option value="5">Quinto</option>
                        <option value="6">Sexto</option>
                    </select>
                </div>
            </div>
            <div class="column has-text-centered">
                <button wire:click="buscar" class="button is-success"><i class="fas fa-search"></i></button>
                <button wire:click="limpiar" class="button is-danger"><i class="fas fa-eraser"></i></button>
            </div>
        </div>
    </div>
    <div class="content-dashboard-search-bar">
        <div class="columns">
            <div class="column has-text-centered"><i class="fas fa-circle has-text-warning"></i> <strong>{{ $pendientes }}</strong> PENDIENTES</div>
            <div class="column has-text-centered"><i class="fas fa-circle has-text-success"></i> <strong>{{ $confirmadas }}</strong> CONFIRMADAS</div>
            <div class="column has-text-centered"><i class="fas fa-circle has-text-danger"></i> <strong>{{ $anuladas }}</strong> ANULADAS</div>
            <div class="column has-text-centered"><i class="fas fa-circle has-text-grey-light"></i> <strong>{{ $total }}</strong> TOTAL</div>
        </div>
    </div>
    <div class="content-dashboard-content box-content">
        <table class="table">
            <thead>
                <tr>
                    <th class="has-text-centered">Estado</th>
                    <th>COD</th>
                    <th>DNI/CE/PTP</th>
                    <th>Alumno</th>
                    <th>Nivel</th>
                    <th>Grado</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($matriculas as $matricula)
                    <tr>
                        <td class="has-text-centered">{!! $matricula->status !!}</td>
                        <td>{{ $matricula->codigo }}</td>
                        <td>{{ $matricula->alumno->numero_documento }}</td>
                        <td>{{ trim($matricula->alumno->apellido_paterno.' '.$matricula->alumno->apellido_materno.' '.$matricula->alumno->nombres) }}</td>
                        <td>{{ $matricula->nivel == 'P' ? 'PRIMARIA' : 'SECUNDARIA' }}</td>
                        <td>{{ $matricula->grado | grado }}</td>
                        <td>{{ $matricula->created_at | dateFormat }}</td>
                        <td>
                            <div class="dashboard-menu-opcion" x-data="{ open: false }">
                                <button class="button is-small" @click="open = true"><i class="fas fa-bars"></i></button>
                                <div class="items" x-show="open">
                                    <div class="items-option"  @click.away="open = false">
                                        <a href="{{ route('dashboard.detalle-matricula', [$matricula->codigo]) }}"><i class="fas fa-search-plus has-text-primary"></i> Ver mas detalles</a>
                                    </div>
                                    <div class="items-option"  @click.away="open = false">
                                        <a wire:click="descargarFicha({{ $matricula->id }})"><i class="fas fa-file-pdf has-text-success"></i> Descargar ficha</a>
                                    </div>

                                    <div  class="items-option" @click.away="open = false">
                                        @if($matricula->estado == 0)
                                            <a wire:click="showDialogConfirmMatricula({{ $matricula->id }})"><i class="fas fa-check-double has-text-success"></i> Confirmar</a>
                                        @elseif($matricula->estado == 1)
                                            <a wire:click="showDialogAnularMatricula({{ $matricula->id }})"><i class="fas fa-ban has-text-danger"></i> Anular</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="has-text-centered">No hay resultados que mostrar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $matriculas->links() }}
    </div>
    <div class="loading-matricula"  wire:loading wire:target="descargarFicha">
        <div class="loading-matricula-body">
            <div class="spinner">
                <img src="{{ asset('images/loader.svg') }}"/>
            </div>
            <div class="mensaje">
                Generando ficha.....
            </div>
        </div>
    </div>
</div>
