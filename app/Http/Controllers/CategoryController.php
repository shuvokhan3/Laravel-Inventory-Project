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
        $user_id = $request->header('id');
        $category_id = $request->input('id');

        return Category::where('user_id', '=', $user_id)
            ->where('id' , '=', $category_id)
            ->delete();
    }

    //show category which category user want to update
    public function ShowCategoryUpdateFormData(Request $request){
        $user_id = $request->header('id');
        $category_id = $request->input('id');

        $val =  Category::where('user_id' , '=', $user_id)
            ->where('id', '=', $category_id)
            ->first();

        return response()->json([
            'value' => $val
        ]);

    }

    //CategoryUpdate
    public function CategoryUpdate(Request $request)
    {
        try{
            $user_id = $request->header('id');
            $category_id = $request->input('id');

            Category::where('user_id', '=' ,$user_id)
                ->where('id' , '=', $category_id)
                ->update([
                    'name' => $request->input('name')
                ]);

            return $request->json([
                'status' => 'success',
                'message' => 'category updated successfully!'
            ],200);

        }catch (\Exception $e){
            return response()->json([
                'status' => 'Error',
                'message' => 'Sorry, something went wrong. Please try again later.'
            ]);
        }
    }


}
