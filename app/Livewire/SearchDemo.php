<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;

class SearchDemo extends Component
{
    public $search = '';
    public $searchType = 'posts';
    
    public function render()
    {
        $results = collect();
        
        if (strlen($this->search) >= 2) {
            if ($this->searchType === 'posts') {
                $results = Post::where('title', 'like', '%' . $this->search . '%')
                              ->orWhere('content', 'like', '%' . $this->search . '%')
                              ->with('user')
                              ->take(5)
                              ->get();
            } else {
                $results = User::where('name', 'like', '%' . $this->search . '%')
                              ->orWhere('email', 'like', '%' . $this->search . '%')
                              ->take(5)
                              ->get();
            }
        }
        
        return view('livewire.search-demo', compact('results'));
    }
}