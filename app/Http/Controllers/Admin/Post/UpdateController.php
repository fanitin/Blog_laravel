<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Post $post){
        try{
            $data = $request->validated();
            $tagIds = $data['tag_ids'];
            unset($data['tag_ids']);


            $data['preview_image'] = Storage::disk('public')->put('images/posts/prewiew_images', $data['preview_image']);
            $data['main_image'] = Storage::disk('public')->put('images/posts/main_images', $data['main_image']);
            $post->update($data);
            $post->tags()->attach($tagIds);
            
        }catch(Exception $exception){
            abort(404);
        }
        
        return view("admin.post.show", ["post" => $post]);
    }
}
