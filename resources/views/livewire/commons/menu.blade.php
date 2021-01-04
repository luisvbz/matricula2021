<div class="menu-principal">
    <div class="menu-principal-logo">
        <img src="{{ asset('images/logo.png') }}"/>
    </div>
    <div class="menu-principal-items">
        <ul>
            <li wire:click="go('dashboard.principal')" class="item-menu  @if($route == 'dashboard.principal') item-active @endif"><i class="fas fa-home"></i> Inicio</li>
            <li wire:click="go('dashboard.matriculas')"  class="item-menu @if($route == 'dashboard.matriculas') item-active @endif"><i class="fas fa-graduation-cap"></i> Matriculas</li>
            <li wire:click="go('dashboard.pagos')" class="item-menu @if($route == 'dashboard.pagos') item-active @endif"><i class="fas fa-money-bill"></i> Pagos</li>
            @if($isAdmin)
                <li wire:click="go('dashboard.configuracion')" class="item-menu  @if($route == 'dashboard.configuracion') item-active @endif"><i class="fas fa-cogs"></i> Configuración</li>
            @endif
            <li   wire:click="logout" class="item-menu"><i class="fas fa-sign-out"></i> Cerrar Sesión</li>
        </ul>
    </div>
</div>
