@include('errors.layout', [
    'codigo'      => '429',
    'titulo'      => 'Demasiadas solicitudes',
    'descripcion' => 'Has enviado demasiadas solicitudes en poco tiempo. Espera un momento e intenta de nuevo.',
    'acciones'    => new \Illuminate\Support\HtmlString('
        <a href="' . url('/dashboard') . '" class="btn-primary">← Volver al inicio</a>
    '),
])
