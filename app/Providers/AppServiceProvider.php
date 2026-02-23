<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

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
        Paginator::useBootstrapFive();

        // Хук: модератор может всё! Проверяется перед остальными правилами.
        Gate::before(function (User $user) {
            if ($user->role && $user->role->name === 'moderator') {
                return true;
            }
        });

        // Право на изменение/удаление комментария
        Gate::define('update-comment', function (User $user, \App\Models\Comment $comment) {
            // Доступно только автору
            return $user->id === $comment->user_id;
        });

        Gate::define('delete-comment', function (User $user, \App\Models\Comment $comment) {
            // Доступно только автору (модератор пройдет через Gate::before)
            return $user->id === $comment->user_id;
        });
    }

}
