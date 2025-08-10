<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class PostForm extends Component
{
    public Post $post;
    public $title = '';
    public $content = '';
    public $status = 'draft';

    protected $rules = [
        'title' => 'required|string|max:255',
        'content' => 'required|string|min:10',
        'status' => 'required|in:draft,published,archived',
    ];

    public function mount(Post $post = null)
    {
        if ($post && $post->exists) {
            $this->post = $post;
            $this->title = $post->title;
            $this->content = $post->content;
            $this->status = $post->status;
        } else {
            $this->post = new Post();
        }
    }

    public function save()
    {
        $this->validate();

        $this->post->fill([
            'title' => $this->title,
            'content' => $this->content,
            'status' => $this->status,
            'user_id' => auth()->id(),
        ]);

        $this->post->save();

        session()->flash('success', 'Post saved successfully.');
        
        return redirect()->route('posts.index');
    }

    public function render()
    {
        return view('livewire.post-form');
    }
}