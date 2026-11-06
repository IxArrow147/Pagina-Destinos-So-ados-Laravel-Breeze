<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
   public function boot(): void
    {
    ResetPassword::toMailUsing(function (object $notifiable, string $token) {
        $url = route('password.reset', [
            'token' => $token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ]);

        $minutos = config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');

        return (new MailMessage)
            ->subject('Recupera tu contraseña - Destinos Soñados S.A.')
            ->greeting('¡Hola!')
            ->line('Recibiste este correo porque solicitamos restablecer la contraseña de tu cuenta.')
            ->action('Restablecer contraseña', $url)
            ->line("Este enlace expirará en {$minutos} minutos.")
            ->line('Si no solicitaste el cambio, no necesitas hacer nada más.')
            ->salutation('Saludos, Destinos Soñados S.A.');
    });
    }
}
