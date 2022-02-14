<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Post;
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        $tags = Tag::all();

        return view('admin.posts.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $request->validate($this->validation_rules(), $this->error_messages());

        $data = $request->all();

        if(array_key_exists('cover', $data)) {
            $data['cover'] = Storage::put('posts_covers', $data['cover']);
        }

        //new instance of post
        $new_post = new Post();

        //GEN UNIQUE SLUG
        $slug = Str::slug($data['title'], '-');
        $counter = 1;
        $base_slug = $slug;

        //check uniqueness of slug in table posts
        while(Post::where('slug', $slug)->first()) {
            //gen new slug
            $slug = $base_slug . '-' . $counter;
            $counter++;
        }

        //set new slug
        $data['slug'] = $slug;

        
        //set post
        $new_post->fill($data);
        
        //save in table posts of db
        $new_post->save();
        
        //create relation between 'posts' and 'tags'
        if(array_key_exists('tags', $data)) {
            $new_post->tags()->attach($data['tags']);
        }

        //return to details' page
        return redirect()->route('admin.posts.show', $new_post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        if(! $post) {
            abort(404);
        }
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
         //validation
         $request->validate($this->validation_rules(), $this->error_messages());

        $data = $request->all();

        if(array_key_exists('cover', $data)) {
            //remove pre cover if exists
            if($post->cover) {
                Storage::delete($post->cover);
            } 
            //set new cover
            $data['cover'] = Storage::put('posts_covers', $data['cover']);
        }

        //update if title is changed
        if($data['title'] != $post->title) {
            $slug = Str::slug($data['title'], '-');
            $counter = 1;
            $base_slug = $slug;

            //check uniqueness of slug in table posts
            while(Post::where('slug', $slug)->first()) {
                //gen new slug
                $slug = $base_slug . '-' . $counter;
                $counter++;
            }
            $data['slug'] = $slug;
        } 

        else {
            $data['slug'] = $post->slug;
        }

        $post->update($data);

        if(array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('admin.posts.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if($post->cover) {
            Storage::delete($post->cover);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('deleted', $post->title);
    }

    /**
     * method for group validation rules 
     */
    private function validation_rules() {
        return [
            'title'=>'required|max:255',
            'body'=>'required',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id',
            'cover' => 'nullable|file|mimes:jpg,jpeg,bmp,png',
        ];
    }

    /**
     * method for group error messages
     */
    private function error_messages() {
        return [
            'required'=>'Field :attribute required',
            'max'=>'Max :max characters',
            'category_id.exists' => 'Category not found',
        ];
    }
}
