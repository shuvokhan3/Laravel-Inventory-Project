<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //page Route
    public function categoryView(){
        return view('pages.dashboard.category-page');
    }

    //backend route for CategoryController
    //CategoryList
    public function CategoryList(Request $request){
        try{
            $user_id = $request->header('id');
            return Category::where('user_id', '=', $user_id)->get();
        }catch (\Exception $e){
            return response([
                'status' => 'Error',
                'message' => 'Sorry, something went wrong. Please try again later.'
            ], 500);
        }
    }

    //CategoryCreate
    public function CategoryStore(Request $request)
    {
        try{
            $id = $request->header('id');
            $email = $request->header('email');
            Category::create([
                'name' => $request->input('name'),
                'user_id' => $id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category added successfully!'
            ]);

        }catch (\Exception $e){
            return response()->json([
                "Status" => 'Error',
                "Message" => "Somethings Went Wrong"
            ]);
        }
    }

    //CategoryDelete
    public function CategoryDelete(Request $request){
        $id = $request->header('id');
        $category = Category::find($id);

        if(!$category){
            return response()->json([
                'status' => 'error',
                'message' => 'Sorry, something went wrong. Please try again later.'
            ]);
        }else{
            $category->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Category deleted successfully!'
            ]);
        }
    }

    //CategoryUpdate
    public function CategoryUpdate(Request $request)
    {
        $id = $request->header('id');
        $category = Category::find($id);

        if(!$category){
            return response()->json([
                'status' => 'Error',
                'message' => 'Sorry, something went wrong. Please try again later.'
            ]);
        }else{
            $category->update([
                'name' => $request->input('name'),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Category updated successfully!'
            ]);
        }
    }
}
