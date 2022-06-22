<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatterHelper;
use Illuminate\Support\Facades\DB;
use App\Models\PostModel;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->component = "Component Post";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $posts = PostModel::join('post_categories', 'posts.post_category_id', '=', 'post_categories.post_category_id')
                        ->join('users', 'posts.user_id', '=', 'users.id')
                        ->get();

            $posts_list = array("component" => $this->component, "data_component" => $posts);

            if ($posts == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($posts)
                return ResponseFormatterHelper::successResponse($posts_list, 'Success Get All Posts');
            else
                return ResponseFormatterHelper::errorResponse(null, 'Data null');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $Posts = ['user_id' => Auth::user()->id, 'post_category_id' => $request->post_category_id, 'post_title' => $request->post_title, 'post_content' => $request->post_content, 'post_image' => $request->post_image];
		    PostModel::create($Posts);

            return ResponseFormatterHelper::successResponse($Posts, 'Create Posts Success');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $posts = PostModel::join('post_categories', 'posts.post_category_id', '=', 'post_categories.post_category_id')
                        ->join('users', 'posts.user_id', '=', 'users.id')
                        ->find($id);

            $posts_list = array("component" => $this->component, "data_component" => $posts);

            if ($posts == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($posts)
                return ResponseFormatterHelper::successResponse($posts_list, 'Success Get by ID Posts');
            else
                return ResponseFormatterHelper::errorResponse(null, 'Data null');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }

    public function paginate($limit, $offset){
        try {
            $posts = PostModel::join('post_categories', 'posts.post_category_id', '=', 'post_categories.post_category_id')
                        ->join('users', 'posts.user_id', '=', 'users.id')
                        ->limit($limit)
                        ->offset($offset)->get();

            $posts_list = array("component" => $this->component, "data_component" => $posts);

            if ($posts == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($posts)
                return ResponseFormatterHelper::successResponse($posts_list, 'Success Get All Posts');
            else
                return ResponseFormatterHelper::errorResponse(null, 'Data null');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        try {
            $Post = PostModel::find($id);

            $Posts = ['user_id' => Auth::user()->id, 'post_category_id' => $request->post_category_id, 'post_title' => $request->post_title, 'post_content' => $request->post_content, 'post_image' => $request->post_image];

            $Post->update($Posts);

            return ResponseFormatterHelper::successResponse($Posts, 'Update Posts Success');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            PostModel::destroy($id);

            return ResponseFormatterHelper::successResponse('Posts', 'Delete Posts Success');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }
}
