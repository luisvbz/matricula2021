<div class="menu-principal" x-data="menuPrincipal()">
    <div class="menu-principal-logo">
        <img src="{{ asset('images/logo.png') }}"/>
    </div>
    <div class="menu-principal-items">
        <ul>
            <li @click='goUrl("{{ route('dashboard.principal') }}")' class="item-menu  @if($route == 'dashboard.principal') item-active @endif"><i class="fas fa-home"></i> Inicio</li>
            <li @click='goUrl("{{ route('dashboard.matriculas') }}")' class="item-menu @if($route == 'dashboard.matriculas') item-active @endif"><i class="fas fa-graduation-cap"></i> Matriculas</li>
            <li @click='goUrl("{{ route('dashboard.contabilidad') }}")'  class="item-menu @if($route == 'dashboard.contabilidad') item-active @endif"><i class="fas fa-money-bill"></i> Contabilidad</li>
            @if($isAdmin)
                <li @click='goUrl("{{ route('dashboard.configuracion') }}")' class="item-menu  @if($route == 'dashboard.configuracion') item-active @endif"><i class="fas fa-cogs"></i> Configuración</li>
            @endif
            <li   wire:click="logout" class="item-menu"><i class="fas fa-sign-out"></i> Cerrar Sesión</li>
        </ul>
    </div>
</div>
@push('scripts')
    <script>
        function menuPrincipal() {
            return {
                goUrl(url){
                    window.location.href = url;
                }
            }
        }
    </script>
@endpush
