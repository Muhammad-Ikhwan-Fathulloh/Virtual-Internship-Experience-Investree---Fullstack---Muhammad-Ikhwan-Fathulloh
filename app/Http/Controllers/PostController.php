<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PostModel;
use App\Models\PostCategoryModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Auth::user()->id
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Postindex()
    {
        $PostCategories = PostCategoryModel::all();

        return view('posts.posts', compact('PostCategories'));
    }

    public function fetchAll(){
        $Posts = PostModel::all();
		$output = '';
		if ($Posts->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Image</th>
                <th>Title</th>
                <th>Content</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($Posts as $Post) {
				$output .= '<tr>
                <td>' . $Post->post_id . '</td>
                <td>' . $Post->post_category_id . '</td>
                <td>' . $Post->post_image . '</td>
                <td>' . $Post->post_title . '</td>
                <td>' . $Post->post_content . '</td>
                <td>
                  <a href="#" id="' . $Post->post_id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editPostModal"><i class="bi-pencil-square h4"></i></a>
                  <a href="#" id="' . $Post->post_id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
			}
			$output .= '</tbody></table>';
			echo $output;
		} else {
			echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
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
        $Posts = ['user_id' => Auth::user()->id, 'post_category_id' => $request->post_category_id, 'post_title' => $request->post_title, 'post_content' => $request->post_content, 'post_image' => $request->post_image];
		PostModel::create($Posts);
		return response()->json([
			'status' => 200,
		]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->post_id;
		$Post = PostModel::find($id);
		return response()->json($Post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->post_id;
        $Post = PostModel::find($id);

        $Posts = ['user_id' => Auth::user()->id, 'post_category_id' => $request->post_category_id, 'post_title' => $request->post_title, 'post_content' => $request->post_content, 'post_image' => $request->post_image];
        $Post->update($Posts);
		return response()->json([
			'status' => 200,
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->post_id;
        PostModel::destroy($id);
    }
}
