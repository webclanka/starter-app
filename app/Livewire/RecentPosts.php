<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class RecentPosts extends Component
{
    use WithPagination;

    public function render()
    {
        $posts = Post::with('user')
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.recent-posts', compact('posts'));
    }
}