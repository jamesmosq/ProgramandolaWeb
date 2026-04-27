@include('errors.layout', [
    'codigo'      => '403',
    'titulo'      => 'Acceso denegado',
    'descripcion' => 'No tienes permiso para ver esta página. Si crees que es un error, contacta al instructor.',
    'acciones'    => new \Illuminate\Support\HtmlString('
        <a href="' . url('/dashboard') . '" class="btn-primary">← Volver al inicio</a>
    '),
])
