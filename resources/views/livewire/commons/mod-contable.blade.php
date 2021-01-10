<div class="mod-contable" x-data="items()">
    <div class="items-container">
        <div class="item-section @if($route == 'contabilidad.cronograma') item-section-active @endif"  @click='goLink("{{ route('contabilidad.cronograma') }}")'>
            <div class="item-section-left">
                <img src="{{ asset('images/icons/calendario.svg') }}"/>
            </div>
            <div class="item-section-right">
                <div class="titulo">Cronograma</div>
                <div class="subtitulo">Pagos</div>
            </div>
        </div>
        <div class="item-section @if($route == 'contabilidad.pagos-pensiones') item-section-active @endif"  @click='goLink("{{ route('contabilidad.pagos-pensiones') }}")'>
            <div class="item-section-left">
                <img src="{{ asset('images/icons/recibo.svg') }}"/>
            </div>
            <div class="item-section-right">
                <div class="titulo">Pagos</div>
                <div class="subtitulo">Pensiones</div>
            </div>
        </div>
        <div class="item-section @if($route == 'contabilidad.pagos-matricula') item-section-active @endif"  @click='goLink("{{ route('contabilidad.pagos-matricula') }}")'>
            <div class="item-section-left">
                <img src="{{ asset('images/icons/pago-en-efectivo.svg') }}"/>
            </div>
            <div class="item-section-right">
                <div class="titulo">Pagos</div>
                <div class="subtitulo">Matriculas</div>
            </div>
        </div>
        <div class="item-section"  @click='goLink("{{ route('dashboard.configuracion') }}")'>
            <div class="item-section-left"  @click='goLink("{{ route('dashboard.configuracion') }}")'>
                <img src="{{ asset('images/icons/reportes.svg') }}"/>
            </div>
            <div class="item-section-right"  @click='goLink("{{ route('dashboard.configuracion') }}")'>
                <div class="titulo"  @click='goLink("{{ route('dashboard.configuracion') }}")'>Reportes</div>
                <div class="subtitulo"  @click='goLink("{{ route('dashboard.configuracion') }}")'>Contables</div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function items() {
            return {
                goLink (link)
                {
                    window.location.href = link;
                }
            }
        }
    </script>
@endpush