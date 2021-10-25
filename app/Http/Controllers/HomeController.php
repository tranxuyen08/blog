<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class HomeController extends Controller
{
    public function index() {




        return view('welcome');
    }

    public function detail($id) {
        $post =  Post::with(['author', 'category', 'comments', 'comments.author'])->find($id);
        // $post =  Post::with(['author', 'category', 'comments', 'comments.author'])
        //     ->where('id', $id)->first();
        \DB::enableQueryLog(); // Enable query log
        $post = Post::cuong(2)->get();
        // $post = Post::withoutGlobalScope('phandong')->get();
        dd(\DB::getQueryLog()); // Show results of log

        dd($post);

        $array_post = [
            'user_id' => $post->user_id,
            'category_id' => $post->category_id,
            'slug' => $post->slug,
            'title' => $post->title,
            'thumbnail' => $post->thumbnail,
            'excerpt' => $post->excerpt,
            'body' => $post->body,
            'published_at' => $post->published_at,
        ];
        $author = [
            'id' => $post->author->id,
            'name' => $post->author->name,
            'email' => $post->author->email,
        ];
        $category = [
            'id' => $post->category->id,
            'name' => $post->category->name,
            'slug' => $post->category->slug,
        ];
        
        $comments = [];
        $comment_users = [];
        foreach ($post->comments as $comment) {
            array_push($comments, array(
                'id' => $comment->id,
                'user_id' => $comment->user_id,
                'post_id' => $comment->post_id,
                'body' => $comment->body,
                'deleted_at' => $comment->deleted_at,
            ));
            array_push($comment_users, array(
                'id' => $comment->author->id,
                'name' => $comment->author->name,
                'email' => $comment->author->email,
            ));
        }
        dd($array_post , $author, $category, $comments, $comment_users);
    }

    public function create_comments() {
        $post = Post::find(1);
        // $comment = new Comment([
        //     'user_id' => 2,
        //     'body' => 'A new comment.'
        // ]);
        // $post->comments()->save($comment);
        Comment::find(1)->delete();
        // $post->comments()->createMany([
        //     [
        //         'user_id' => 1,
        //         'body' => 'A new comment 3.'
        //     ],
        //     [
        //         'user_id' => 1,
        //         'body' => 'A new comment 4.'    
        //     ],
        // ]);


    }
}
