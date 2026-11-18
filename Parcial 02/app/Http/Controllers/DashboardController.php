<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Service;
use Illuminate\Contracts\View\View;

/**
 * Controlador del dashboard administrativo.
 */
class DashboardController extends Controller
{
    /**
     * Muestra métricas y últimas publicaciones.
     */
    public function index(): View
    {
        $stats = [
            'posts_total' => Post::query()->count(),
            'posts_published' => Post::query()->whereNotNull('published_at')->whereDate('published_at', '<=', now()->toDateString())->count(),
            'categories_total' => Category::query()->count(),
            'services_active' => Service::query()->where('is_active', true)->count(),
        ];

        $latestPosts = Post::query()
            ->with(['category', 'user'])
            ->latest()
            ->take(8)
            ->get();

        return view('admin.dashboard', [
            'stats' => $stats,
            'latestPosts' => $latestPosts,
        ]);
    }
}
