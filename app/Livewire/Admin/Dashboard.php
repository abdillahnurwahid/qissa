<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Models\Video;
use App\Models\Artikel;
use App\Models\ContentRequest;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        $stats = [
            'total_users' => User::count(),
            'total_videos' => Video::count(),
            'total_articles' => Artikel::count(),
            'pending_requests' => ContentRequest::pending()->count(),
        ];

        $categories = Category::all();
        
        $chartData = [
            'labels' => [],
            'views' => [],
            'comments' => [],
        ];

        foreach ($categories as $category) {
            $chartData['labels'][] = $category->name;
            
            $videoViews = Video::where('category_id', $category->id)
                ->where('status', 'approved')
                ->sum('views');
            
            $artikelViews = Artikel::where('category_id', $category->id)
                ->where('status', 'approved')
                ->sum('views');
            
            $chartData['views'][] = $videoViews + $artikelViews;
            
            $videoComments = DB::table('comments')
                ->whereIn('commentable_id', Video::where('category_id', $category->id)->pluck('id'))
                ->where('commentable_type', 'App\Models\Video')
                ->count();
            
            $artikelComments = DB::table('comments')
                ->whereIn('commentable_id', Artikel::where('category_id', $category->id)->pluck('id'))
                ->where('commentable_type', 'App\Models\Artikel')
                ->count();
            
            $chartData['comments'][] = $videoComments + $artikelComments;
        }

        return view('livewire.admin.dashboard', compact('stats', 'chartData'));
    }
}