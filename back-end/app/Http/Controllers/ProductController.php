<?php

namespace App\Http\Controllers;
use App\PaymentMode;
use App\Products;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\URL;


class ProductController extends Controller
{
    public function index()
    {
         return Products::all();
    }

    public function category($categoryId)
    {       
        return  Products::where("category_id",$categoryId)->get();
    }


    
    public function show(Products $data)
    {
        return $data;
    }

    public function store(ProductRequest $request)
    {
        $data= $request->all();    
        // return  $request;
        if($request->hasFile('fileName')){
            $allowedfileExtension = ['jpge', 'jpg', 'png'];
            $files = $request->allFiles('fileName');
            $errors = [];
 
            foreach ($files as $file) {

                    // $extension = $file->getClientOriginalExtension(); 
                    $extension = $file->guessExtension();
                    $check = in_array($extension, $allowedfileExtension);
        
                    if ($check) {   
                      
                    } 

                    $filename  = $file->getClientOriginalName();
                    $pictureName   = 'prod_'.date('His').'-'.$filename.'.'.  $extension ;
                    //move image to public/img folder
                    $imagePath=public_path('images');
                    $file->move($imagePath, $pictureName);  
                    // $data["image_url"]=$pictureName;
                                        
                    $route = str_replace("product", "", url()->current());
                    $data["image_url"] = $route . "image/" . $pictureName;

            }  
        }  
        $product = Products::create($data);
        return response()->json($product, 201);
    }

    public function updateProduct(ProductRequest $request)
    {
       $requestData=$request->all();
       $data=Products::find($requestData['id']);

      
        // return  $request;
        if($request->hasFile('fileName')){
            $allowedfileExtension = ['jpge', 'jpg', 'png'];
            $files = $request->allFiles('fileName'); 
            foreach ($files as $file) {

                    // $extension = $file->getClientOriginalExtension(); 
                    $extension = $file->guessExtension();
                    $check = in_array($extension, $allowedfileExtension);
        
                    if ($check) {   
                        $filename  = $file->getClientOriginalName();
                        $pictureName   = 'prod_'.date('His').'-'.$filename.'.'.  $extension ;
                        //move image to public/img folder
                        $imagePath=public_path('images');
                        $file->move($imagePath, $pictureName);   
                        
                        $route = str_replace("product/update", "", url()->current());
                        $data["image_url"] = $route . "image/" . $pictureName;
                   
                    }   
            } 

        } 

        $data->update($requestData); 


        return response()->json($data, 200);
    }

    public function delete(Products $data)
    {
        $data->delete();

        return response()->json(null, 204);
    }
}
