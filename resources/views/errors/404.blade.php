@include('errors.layout', [
    'codigo'      => '404',
    'titulo'      => 'Página no encontrada',
    'descripcion' => 'La página que buscas no existe o fue movida a otra dirección.',
    'acciones'    => new \Illuminate\Support\HtmlString('
        <a href="' . url('/dashboard') . '" class="btn-primary">← Ir al dashboard</a>
        <a href="' . url('/modulos') . '" class="btn-secondary">Ver módulos</a>
    '),
])
