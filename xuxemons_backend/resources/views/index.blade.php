













<form action="{{ route('xuxemons.random') }}" method="GET">
    @csrf <!-- Agrega el token CSRF para protección -->
    <button type="submit" class="btn btn-primary">Generar Xuxemon Aleatorio</button>
</form>