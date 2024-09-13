<?php

namespace App\Http\Resources\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User\UserResource;
class PostsShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'message'=>'single post',
            'title'=>$this->title,
            'description'=>$this->description,
            'user'=>new UserResource( $this->user),



        ];
    }
}
