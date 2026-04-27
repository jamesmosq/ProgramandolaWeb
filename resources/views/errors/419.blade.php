@include('errors.layout', [
    'codigo'      => '419',
    'titulo'      => 'Sesión expirada',
    'descripcion' => 'Tu sesión ha expirado por inactividad. Recarga la página para continuar.',
    'acciones'    => new \Illuminate\Support\HtmlString('
        <button onclick="window.location.reload()" class="btn-primary">↻ Recargar página</button>
        <a href="' . url('/login') . '" class="btn-secondary">Volver al login</a>
    '),
])
