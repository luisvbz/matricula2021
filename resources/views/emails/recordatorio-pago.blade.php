Hola, {{ $padre->apellidos }}, {{ $padre->nombres }}. Este es un recordatorio de pago de las pensión que adeuda con el
colegio por la educacion de su menor hijo(a) {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}, {{ $alumno->nombres }}<br>

<ul>
    @php $total = 0.00; @endphp
@foreach($meses as $mes)
    <li>Pensión del mes de {{ $mes->mes | mes }} - S./ {{ $mes->costo }}</li><br>
    @php $total = $total + $mes->costo; @endphp
@endforeach
</ul>
<br>
Total a pagar: {{ (float) $total }}
