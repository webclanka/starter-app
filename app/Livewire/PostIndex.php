<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostIndex extends Component
{
    use WithPagination;

    public $search = '';
    public $status = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => ''],
    ];

    public function updating($property)
    {
        if ($property === 'search' || $property === 'status') {
            $this->resetPage();
        }
    }

    public function render()
    {
        $posts = Post::with('user')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('content', 'like', '%' . $this->search . '%');
            })
            ->when($this->status, function ($query) {
                $query->where('status', $this->status);
            })
            ->latest()
            ->paginate(10);

        return view('livewire.post-index', compact('posts'));
    }

    public function deletePost($postId)
    {
        $post = Post::findOrFail($postId);
        
        // Check if user owns the post
        if ($post->user_id !== auth()->id()) {
            session()->flash('error', 'You can only delete your own posts.');
            return;
        }

        $post->delete();
        session()->flash('success', 'Post deleted successfully.');
    }
}