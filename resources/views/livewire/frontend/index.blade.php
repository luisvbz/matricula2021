@section('title')
    IEPS
@endsection
<div class="container" style="padding-bottom: 50px">
    <div class="form-container" x-data="items()">
        <div class="items-container">
            <div class="item-section"  @click='goLink("{{ route('matricular') }}")'>
                <div class="item-section-left">
                    <img src="{{ asset('images/icons/school.svg') }}"/>
                </div>
                <div class="item-section-right">
                    <div class="titulo">Matrícular</div>
                    <div class="subtitulo">Nueva matrícula</div>
                </div>
            </div>
            <div class="item-section"  @click='goLink("{{ route('registrar.pago') }}")'>
                <div class="item-section-left">
                    <img src="{{ asset('images/icons/pago-en-efectivo.svg') }}"/>
                </div>
                <div class="item-section-right">
                    <div class="titulo">Registrar pago</div>
                    <div class="subtitulo">Nuevo pago</div>
                </div>
            </div>
            <div class="item-section"  @click='goLink("{{ route('estado.cuenta') }}")'>
                <div class="item-section-left">
                    <img src="{{ asset('images/icons/recibo.svg') }}"/>
                </div>
                <div class="item-section-right">
                    <div class="titulo">Estado de cuenta</div>
                    <div class="subtitulo">Verificar estado de cuenta de matrícula</div>
                </div>
            </div>
            <div class="item-section"  @click='goLink("{{ route('consultar.matricula') }}")'>
                <div class="item-section-left">
                    <img src="{{ asset('images/icons/detalles.svg') }}"/>
                </div>
                <div class="item-section-right">
                    <div class="titulo">Consultar matrícula</div>
                    <div class="subtitulo">Consultar datos de la matrícula</div>
                </div>
            </div>
        </div>
    </div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day --}}
</div>
@push('js')
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
