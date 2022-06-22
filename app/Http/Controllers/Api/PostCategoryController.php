<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatterHelper;
use Illuminate\Support\Facades\DB;
use App\Models\PostCategoryModel;
use Illuminate\Support\Facades\Auth;

class PostCategoryController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->component = "Component Post Category";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $postcategories = PostCategoryModel::join('users', 'post_categories.user_id', '=', 'users.id')->get();

            $postcategories_list = array("component" => $this->component, "data_component" => $postcategories);

            if ($postcategories == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($postcategories)
                return ResponseFormatterHelper::successResponse($postcategories_list, 'Success Get All Post Categories');
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
            $PostCategories = ['user_id' => Auth::user()->id, 'post_category_title' => $request->post_category_title];
            PostCategoryModel::create($PostCategories);

            return ResponseFormatterHelper::successResponse($PostCategories, 'Create Post Categories Success');
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
            $postcategories = PostCategoryModel::join('users', 'post_categories.user_id', '=', 'users.id')->find($id);

            $postcategories_list = array("component" => $this->component, "data_component" => $postcategories);

            if ($postcategories == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($postcategories)
                return ResponseFormatterHelper::successResponse($postcategories_list, 'Success Get by ID Post Categories');
            else
                return ResponseFormatterHelper::errorResponse(null, 'Data null');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }

    public function paginate($limit, $offset){
        try {
            $postcategories = PostCategoryModel::join('users', 'post_categories.user_id', '=', 'users.id')
                                    ->limit($limit)
                                    ->offset($offset)
                                    ->get();

            $postcategories_list = array("component" => $this->component, "data_component" => $postcategories);

            if ($postcategories == null)
                return ResponseFormatterHelper::successResponse(null, 'Data null');
            else if ($postcategories)
                return ResponseFormatterHelper::successResponse($postcategories_list, 'Success Get All Post Categories');
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
            $PostCategory = PostCategoryModel::find($id);

            $PostCategories = ['user_id' => Auth::user()->id, 'post_category_title' => $request->post_category_title];

            $PostCategory->update($PostCategories);

            return ResponseFormatterHelper::successResponse($PostCategories, 'Update Post Categories Success');
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
            PostCategoryModel::destroy($id);

            return ResponseFormatterHelper::successResponse('Post Categories', 'Delete Post Categories Success');
        } catch (\Throwable $th) {
            return ResponseFormatterHelper::errorResponse(null, $th);
        }
    }
}
