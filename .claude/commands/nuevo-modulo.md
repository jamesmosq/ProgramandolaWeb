Guía completa para agregar un nuevo módulo a EduCode. Pide al usuario el nombre, descripción, icono emoji y color antes de ejecutar.

## Checklist de pasos (en orden)

1. **Seeder** (`database/seeders/ModulosSeeder.php`)
   - Agregar el nuevo módulo al array `$modulos` con el siguiente `orden` disponible
   - Incluir al menos 2 lecciones, cada una con pasos y ejercicios
   - Usar `updateOrCreate` (ya está implementado en el seeder)

2. **Color** (`resources/views/modulos/index.blade.php`)
   - Agregar el color nuevo al array `$colores` con las 4 claves: `hover`, `bar`, `border`, `badge`
   - Formato: `'COLOR' => ['hover'=>'group-hover:text-COLOR-400', 'bar'=>'from-COLOR-500 to-COLOR-400', 'border'=>'hover:border-COLOR-400/30', 'badge'=>'bg-COLOR-400/10 text-COLOR-400 border-COLOR-400/15']`
   - Actualizar el texto "N módulos en secuencia"

3. **Guías** (`resources/views/modulos/show.blade.php`)
   - Añadir entrada al array `$guias` con el orden del nuevo módulo
   - Si no hay guía aún, omitir esta entrada (el bloque @foreach simplemente no mostrará botones)

4. **GuiaController** (`app/Http/Controllers/GuiaController.php`)
   - Agregar los nombres de archivo al array `$archivosPermitidos['guias']` si hay guías HTML para este módulo

5. **Archivo HTML de guía** (si aplica)
   - Copiar el `.html` a `resources/guias/`
   - Verificar que NO contenga referencias a "CEFIT-SENA" — solo "EduCode"
   - Verificar que el header esté centrado (text-align:center en el CSS del header)

6. **Ejecutar**
   - `php artisan db:seed --class=ModulosSeeder`
   - `npm run build`

7. **Verificar** en el navegador que el nuevo módulo aparece en `/modulos` con el color correcto y los botones de guía funcionan.
