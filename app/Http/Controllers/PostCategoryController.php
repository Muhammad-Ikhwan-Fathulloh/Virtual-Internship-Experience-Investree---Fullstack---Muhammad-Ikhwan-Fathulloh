<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\PostCategoryModel;
use Illuminate\Support\Facades\Auth;

class PostCategoryController extends Controller
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
    public function PostCategoryindex()
    {
        return view('post_categories.post_categories');
    }

    public function fetchAll(){
        $PostCategories = PostCategoryModel::all();
		$output = '';
		if ($PostCategories->count() > 0) {
			$output .= '<table class="table table-striped table-sm text-center align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>Kategori</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
			foreach ($PostCategories as $PostCategory) {
				$output .= '<tr>
                <td>' . $PostCategory->post_category_id . '</td>
                <td>' . $PostCategory->post_category_title . '</td>
                <td>
                  <a href="#" id="' . $PostCategory->post_category_id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editPostCategoryModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $PostCategory->post_category_id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
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
        $PostCategories = ['user_id' => Auth::user()->id, 'post_category_title' => $request->post_category_title];
		PostCategoryModel::create($PostCategories);
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
        $id = $request->post_category_id;
		$PostCategory = PostCategoryModel::find($id);
		return response()->json($PostCategory);
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
        $id = $request->post_category_id;
        $PostCategory = PostCategoryModel::find($id);

        $PostCategories = ['user_id' => Auth::user()->id, 'post_category_title' => $request->post_category_title];

        $PostCategory->update($PostCategories);
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
        $id = $request->post_category_id;
        PostCategoryModel::destroy($id);
    }
}
