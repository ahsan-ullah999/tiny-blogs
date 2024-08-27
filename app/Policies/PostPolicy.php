<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{

    public function modify(User $users, Post $posts): Response
    {
        return $users->id === $posts->user_id
        ? Response::allow()
        : Response::deny('you do not own this post');
    }
}
