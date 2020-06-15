<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Auth;
use DB;

use App\User;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
      $posts = Post::latest()->paginate(10);

      return view('home', ['posts' => $posts]);
    }

    public function getProfile() {
      return view('profile');
    }

    public function editProfile(Request $request) {
      $validator = Validator::make($request->all(), [
        'first_name' => 'required|max:255',
        'email' => [
          'required',
          Rule::unique('users')->ignore(Auth::user()->id),
          'email',
          'max:255'
        ],
        'password' => 'required|min:8',
      ]);

      if ($validator->fails()) {
          return redirect('profile')
                  ->withErrors($validator)
                  ->withInput();
      }
      
      $user = User::find(Auth::user()->id);
      
      $user->first_name = $request->first_name;
      $user->email = $request->email;
      $user->password = Hash::make($request->password);

      $user->save();
      return redirect('profile')->with('success-message', "Edit profile success");
    }

    public function createPost(Request $request) {
      $validator = Validator::make($request->all(), [
        'title' => 'required|max:255',
        'description' => 'required|min:10',
        'file' => 'image|mimes:jpeg,png,jpg,svg|max:2048',
      ]);

      if ($validator->fails()) {
          return redirect('profile')
                  ->withErrors($validator)
                  ->withInput();
      }

      $post = new Post;
      $post->title = $request->title;
      $post->description = $request->description;
      $post->author = Auth::user()->first_name . ' ' . Auth::user()->last_name;

      if($request->hasFile('file')) {
        $imageName = time().'.'.request()->file->getClientOriginalExtension();
        request()->file->move(public_path('images'), $imageName);
        $post->img_link = $imageName;
      }

      $post->save();

      return redirect('profile')->with('success-message', "Post created");
    }
}
