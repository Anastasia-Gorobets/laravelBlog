<?php

namespace App\Http\Controllers;

use App\Events\BlogPostPosted;
use App\Models\BlogPost;
use App\Http\Requests\StorePost;
use App\Models\Image;
use App\Services\Counter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth')->only(['create','store','edit','update','destroy']);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("posts.index", [
            'posts'=>BlogPost::latestWithRelations()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {

        /*$request->validate([
            'title'=>'bail|required|min:5|max:100',
            'content'=>'required|min:10|max:100'
        ]);*/



        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;


        //$post = new BlogPost();
     /*   $post->title = $request->input('title');
        $post->content = $request->input('content');*/

        /*$post->title = $validated['title'];
        $post->content = $validated['content'];
        $post->save();*/

        $post = BlogPost::create($validated);

        if($request->hasFile('thubnail')){
            $path = $request->file('thubnail')->store('thubnails');
            $post->image()->save(Image::make(['path'=>$path]));
        }

        event(new BlogPostPosted($post));


        $request->session()->flash('status','Blog post was created');

        return  redirect()->route('posts.show', ['post'=>$post->id]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function() use($id) {
            return BlogPost::with('comments','user','tags','comments.user')
                ->findOrFail($id);
        });



        $counter = new Counter();


        return view('posts.show', [
            'post' => $blogPost,
            'counter' => $counter->increment("blog-post-{$id}",['blog-post']),
        ]);



    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize($post);

        return view('posts.edit',['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);

       /* if(Gate::denies('update-post',$post)){
          abort(403, "You can't edit this post!");
        }*/

        $this->authorize($post);

        $validated = $request->validated();
        $post->fill($validated);
        $post->save();

        if($request->hasFile('thubnail')){
            $path = $request->file('thubnail')->store('thubnails');
            if($post->image){
                Storage::delete($post->image->path);
                $post->image->path = $path;
                $post->image->save();
            }else{
                $post->image()->save(Image::make(['path'=>$path]));
            }
        }



        $request->session()->flash('status','Blog post was updated');

        return redirect()->route('posts.show', ['post'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = BlogPost::findOrFail($id);

        $this->authorize($post);

        $post->delete();
        session()->flash('status','Blog post was deleted');
        return redirect()->route('posts.index');

    }
}
