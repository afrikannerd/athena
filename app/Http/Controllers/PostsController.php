<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        #$posts = DB::select("SELECT * FROM posts");
        #$posts = Post::orderBy('title','desc')->take(3)->get(); //number of rows to be fetched
        #$posts = Post::orderBy('title','desc')->get();
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        $data = ['title' => 'Blog',
                 'posts' => $posts
                ];
        
        return view('posts.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = "Create New Post";
        return view('posts.create')->with('title',$title);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);  
        //create post object
        $post = new Post;
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return redirect('/posts')->with('success','Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = abs(intval($id));
        $post = Post::find($id) ?  Post::find($id): (new class($id){
            public $title = 'Error';
            public $body = 'No such post';
            public $created_at = null;
            public $id;
            public function __construct($id)
            {
                $this->created_at = gmdate('M d Y H:i:s',time());
                $this->id = $id;
            }
            
        });
       
       $data = ['title' => $post->title,'post'=>$post];
       return view('posts.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = intval(abs($id));
        $post = Post::find($id) ?  Post::find($id): (new class($id){
            public $title = 'Error';
            public $body = 'No such post';
            public $created_at = null;
            public $id;
            public function __construct($id)
            {
                $this->created_at = gmdate('M d Y H:i:s',time());
                $this->id = $id;
            }
            
        });
        $data = ['title' => $post->title,'post'=>$post];
        return view('posts.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'body' => 'required'
        ]);  
        //create post object
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->save();
        return redirect('/posts')->with('success',"Post {$id} updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect('/posts')->with('success','Post Removed');
    }
}
