Ejecuta el seeder principal del proyecto EduCode y confirma el resultado.

Pasos:
1. Corre `php artisan db:seed --class=ModulosSeeder`
2. Informa cuántos módulos y lecciones quedaron en la base de datos consultando con `php artisan tinker --execute="echo Modulo::count().' módulos, '.Leccion::count().' lecciones';"` o simplemente con una query directa
3. Si hay error, muestra el mensaje completo y sugiere la causa
