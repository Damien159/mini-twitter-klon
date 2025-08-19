<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;

class UserProfile extends Component
{
    public User $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }
    public function deletePost($postId)
{
    $post = Post::where('id', $postId)->where('user_id', $this->user->id)->first();

    if ($post) {
        $post->delete();
    }
}

    public function render()
    {
        $posts = Post::with('likes')
            ->where('user_id', $this->user->id)
            ->latest()
            ->get();

        $postCount = $posts->count();
        $likeCount = $posts->sum(fn($post) => $post->likes->count());

        return view('livewire.user-profile', [
            'user' => $this->user,
            'posts' => $posts,
            'postCount' => $postCount,
            'likeCount' => $likeCount,
        ]);
    }
}