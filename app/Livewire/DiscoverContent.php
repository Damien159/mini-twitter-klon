<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Flux\Flux;
 use Livewire\WithPagination;

class DiscoverContent extends Component
{
     use WithPagination;

    public $title;
    public $body;
    public $filter = 'latest';
    

    public function mount()
    {
        $this->title = '';
        $this->body = '';
    }

    public function create()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'body'  => 'required|string',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title'   => $this->title,
            'body'    => $this->body,
        ]);
         Flux::modal('create-post')->close();
        $this->reset(['title', 'body']);
        $this->mount(); // Refresh posts
        
    }

    public function like($postId)
{
    $post = Post::findOrFail($postId);

    $like = $post->likes()->where('user_id', Auth::id())->first();

    if ($like) {
        // Like existiert, also entfernen (unliken)
        $like->delete();
    } else {
        // Noch kein Like, also hinzufügen
        Like::create([
            'user_id' => Auth::id(),
            'post_id' => $postId,
        ]);
    }

    $this->mount(); // Refresh posts
}

    public function render()
{
    $query = Post::with('user', 'likes');
    if ($this->filter === 'most_liked') {
        $query->withCount('likes')->orderByDesc('likes_count')->orderByDesc('created_at');
    } else {
        $query->latest();
    }
    return view('livewire.discover-content', [
        'posts' => $query->paginate(5),
    ]);
}
}
