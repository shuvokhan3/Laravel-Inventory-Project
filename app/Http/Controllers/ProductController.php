<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function ViewProduct(){
        return view('pages.dashboard.product-page');
    }

    //create product
    public function CreateProduct(Request $request){

        try{

            $user_id = $request->header('id');

            //make file Name and path
            $img = $request->file('img');

            if(!$img){
                return response()->json([
                    'message'=>'image not uploaded'
                ]);
            }

            //make image name using time and client image original name
            $time = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$time}-{$file_name}";
            //make image image url
            $img_url = "uploads/{$img_name}";

            //upload file
            $img->move(public_path('uploads'), $img_name);

            //save to database
            Product::create([
                'name'=>$request->input('name'),
                'price'=>$request->input('price'),
                'unit'=>$request->input('unit'),
                'img_url'=>$img_url,
                'user_id'=>$user_id,
                'category_id'=>$request->input('category_id')
            ]);

            return response()->json([
                'status' => 'success',
                'message'=> 'Product created successfully'
            ],200);

        }catch (\Exception $exception){
            return response()->json([
                'status' => 'Error',
                'message' => 'Create Product Failed'
            ]);
        }

    }

    //delete product
    public function DeleteProduct(Request $request){
        try{
            $user_id = $request->header('id');
            $product_id = $request->input('id');
            //get this product image file
            $filePath = $request->input('file_path');
            //delete this image
            File::delete($filePath);

            Product::where('user_id','=' , $user_id)
                ->where('id', '=', $product_id)
                ->delete();
            return response()->json([
                'status' => 'success',
                'message'=> 'Product deleted successfully'
            ]);
        }catch (\Exception $exception){
            return response()->json([
                'status' => 'Error',
                'message' => 'Delete Product Failed'
            ]);
        }
    }

    //get product
    public function ProductList(Request $request){
        try{
            $user_id = $request->header('id');
            return Product::where('user_id','=', $user_id)->get();

        }catch (\Exception $exception){
            return response()->json([
                'status' => 'Error',
                'message' => 'Product List Failed'
            ]);
        }
    }

    //product by id
    public function productById(Request $request){
        try{
            $user_id = $request->header('id');
            $product_id = $request->input('id');
            return Product::where('user_id','=' , $user_id)
                ->where('id', '=', $product_id)
                ->first();

        }catch (\Exception $exception){
            return response()->json([
                'status' => 'Error',
                'message' => 'Product List Failed'
            ]);
        }

    }

    //product update
    public function UpdateProduct(Request $request){
        try{


            $user_id = $request->header('id');
            $product_id = $request->input('id');

            if($request->file('img')){
                $img = $request->file('img');
                $time = time();
                $file_name = $img->getClientOriginalName();
                $img_name = "{$user_id}-{$time}-{$file_name}";

                $img_url = "uploads/{$img_name}";

                $img->move(public_path('uploads'),$img_name);

                //delete old image
                $filePath = $request->input('file_path');
                File::delete($filePath);

                //store info on the database
                Product::where('user_id','=' , $user_id)
                    ->where('id', '=', $product_id)
                    ->update([
                        'name'=>$request->input('name'),
                        'price'=>$request->input('price'),
                        'unit'=>$request->input('unit'),
                        'img_url'=>$img_url,
                        'category_id'=>$request->input('category_id'),
                    ]);
                return response()->json([
                    'status' => 'success',
                    'message'=> 'Product Updated with image',
                    'img_url'=>$img_url
                ]);

            }else{
                Product::where('user_id', '=' , $user_id)
                    ->where('id', '=', $product_id)
                    ->update([
                        'name' => $request->input('name'),
                        'price'=> $request->input('price'),
                        'unit' => $request->input('unit'),
                        'category_id'=>$request->input('category_id')
                    ]);
                return response()->json([
                    'status' => 'success',
                    'message' => 'Product updated without image'
                ]);
            }

        }catch (\Exception $exception){
            return response()->json([
                'status' => 'Error',
                'message' => 'Update Product Failed'
            ]);

        }



    }


}
