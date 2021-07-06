<?php

namespace App\Http\Controllers;
use App\ProductCategories;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCategoryRequest;

class ProductCategoryController extends Controller
{
    public function index()
    {
        return ProductCategories::all();
    } 

    public function show(ProductCategories $data)
    {
        return $data;
    }


    public function store(ProductCategoryRequest $request)
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
                    $pictureName   = 'cat_'.date('His').'-'.$filename.'.'.  $extension ;
                    //move image to public/img folder
                    $imagePath=public_path('images');
                    $file->move($imagePath, $pictureName);  
                    // $data["image_url"]=$pictureName;
                    $route = str_replace("productcategory", "", url()->current());
                    $data["image_url"] = $route . "image/" . $pictureName;


            }  
        }  
        $product = ProductCategories::create($data);
        return response()->json($product, 201);
    }

    public function updateCategory(ProductCategoryRequest $request)
    {
       $requestData=$request->all();
       $data=ProductCategories::find($requestData['id']);

      
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
                        $pictureName   = 'cat_'.date('His').'-'.$filename.'.'.  $extension ;
                        //move image to public/img folder
                        $imagePath=public_path('images');
                        $file->move($imagePath, $pictureName);   
                        
                        $route = str_replace("productcategory/update", "", url()->current());
                        $data["image_url"] = $route . "image/" . $pictureName;
                   
                    }   
            } 

        } 

        $data->update($requestData); 


        return response()->json($data, 200);
    }

    public function delete(ProductCategories $data)
    {
        $data->delete();

        return response()->json(null, 204);
    }
}
