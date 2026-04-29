<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class SetAdminUser extends Command
{
    protected $signature = 'admin:set {email} {--revoke : Quitar rol de admin en vez de asignarlo}';
    protected $description = 'Asigna o revoca el rol de administrador a un usuario';

    public function handle(): int
    {
        $email = $this->argument('email');
        $revocar = $this->option('revoke');

        $user = User::where('email', $email)->first();

        if (! $user) {
            $this->error("No existe ningún usuario con el correo: {$email}");
            return self::FAILURE;
        }

        $user->is_admin = ! $revocar;
        $user->save();

        $estado = $user->is_admin ? 'ADMINISTRADOR' : 'estudiante';
        $this->info("{$user->name} ({$email}) ahora es: {$estado}");

        return self::SUCCESS;
    }
}
