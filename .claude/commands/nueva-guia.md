Agrega una guía HTML existente al sistema de guías de EduCode. Pide al usuario el nombre del archivo y a qué módulo (orden) pertenece.

## Checklist de pasos

1. **Limpiar la guía HTML** — verificar que NO contenga:
   - "CEFIT-SENA" → reemplazar por "EduCode"
   - "EduCode CEFIT" → reemplazar por "EduCode"
   - Cualquier otro nombre institucional en badges, footers o títulos de app en ejemplos de código

2. **Verificar UI/UX de la guía**:
   - El `<header>` CSS debe tener `text-align:center`
   - El contenedor del logo/badge debe tener `justify-content:center`
   - El `<h1>` debe tener `margin-inline:auto`
   - El `<header p>` debe tener `margin-inline:auto`
   - Barra de progreso: altura mínima 5px
   - Tags `<pre>` correctos (sin `<pre">` malformados)

3. **Copiar a `resources/guias/`**
   - El nombre del archivo debe seguir el patrón `guia_[tema].html`

4. **Registrar en `GuiaController`** (`app/Http/Controllers/GuiaController.php`)
   - Añadir el nombre (sin extensión) al array `$archivosPermitidos['guias']`

5. **Vincular al módulo** (`resources/views/modulos/show.blade.php`)
   - Añadir `['nombre'=>'guia_TEMA', 'label'=>'Etiqueta visible']` al array `$guias[$orden]` del módulo correspondiente

6. **Rebuild**
   - `npm run build` (solo necesario si se tocaron vistas Blade)

7. **Verificar** que la guía abre desde el panel del módulo y la navbar EduCode aparece correctamente inyectada.
