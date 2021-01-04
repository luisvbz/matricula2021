<div class="header-nav"  x-data="{ open: false }">
    <div class="logo">
        <img src="{{ asset('images/logo.png') }}">
    </div>
    <div class="menu">
        <a class="menu-item" href="https://iepdivinosalvador.net.pe">Página Principal</a>
        <a class="menu-item" href="{{ route('principal') }}">Matricular</a>
        <a class="menu-item" href="{{ route('registrar.pago') }}">Registrar Pago</a>
        <a class="menu-item" href="{{ route('consultar.matricula') }}">Consultar Matrícula</a>
    </div>
    <div class="menu-mobile-button">
        <a @click="open = true"><i class="fas fa-bars"></i></a>
    </div>
    <div class="menu-mobile-items" x-show="open">
       <div><a  @click.away="open = false" class="item" href="https://iepdivinosalvador.net.pe">Página Principal</a></div>
        <div><a @click.away="open = false" class="item" href="{{ route('principal') }}">Matricular</a></div>
        <div><a @click.away="open = false" class="item" href="{{ route('registrar.pago') }}">Registrar Pago</a></div>
        <div><a @click.away="open = false" class="item" href="{{ route('consultar.matricula') }}">Consultar Matrícula</a></div>
    </div>
</div>
