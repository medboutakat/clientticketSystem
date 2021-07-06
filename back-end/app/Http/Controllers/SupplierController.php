<?php

namespace App\Http\Controllers;
use App\Supplier;
use App\PaymentMode;
use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    public function index()
    {
        return Supplier::all();
    }

    public function show(Supplier $data)
    {
        return $data;
    }

    public function store(SupplierRequest $request)
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
                    $pictureName   = 'supp_'.date('His').'-'.$filename.'.'.  $extension ;
                    //move image to public/img folder
                    $imagePath=public_path('images');
                    $file->move($imagePath, $pictureName);  
                    // $data["image_url"]=$pictureName;
                    
                    $data["image_url"] = "http://localhost:8000/api/image/" . $pictureName;

            }  
        }  
        $product = Supplier::create($data);
        return response()->json($product, 201);
    }

    public function updateProduct(SupplierRequest $request)
    {
       $requestData=$request->all();
       $data=Supplier::find($requestData['id']);

      
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
                        $pictureName   = 'supp_'.date('His').'-'.$filename.'.'.  $extension ;
                        //move image to public/img folder
                        $imagePath=public_path('images');
                        $file->move($imagePath, $pictureName);   
                        
                        $requestData['image_url'] = "http://localhost:8000/api/image/" . $pictureName;                      
                    }   
            } 

        } 

        $data->update($requestData); 


        return response()->json($data, 200);
    }

    public function delete(Supllier $data)
    {
        $data->delete();

        return response()->json(null, 204);
    }
}
