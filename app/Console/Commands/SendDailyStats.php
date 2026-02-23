<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ArticleView;
use App\Models\Comment;
use App\Models\User;
use App\Mail\DailyStatsMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendDailyStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-daily-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправка ежедневной статистики модераторам';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();
        
        // 1. Получаем количество просмотров за сегодня
        $viewsCount = ArticleView::whereDate('created_at', $today)->count();
        
        // 2. Получаем количество комментариев за сегодня
        $commentsCount = Comment::whereDate('created_at', $today)->count();
        
        // 3. Получаем всех модераторов
        $moderators = User::whereHas('role', function($query) {
            $query->where('name', 'moderator');
        })->get();
        
        // 4. Рассылаем письма
        foreach ($moderators as $moderator) {
            Mail::to($moderator->email)->send(new DailyStatsMail($viewsCount, $commentsCount));
        }

        $this->info("Статистика отправлена {$moderators->count()} модераторам. Просмотры: $viewsCount, Комменты: $commentsCount");
    }
}
