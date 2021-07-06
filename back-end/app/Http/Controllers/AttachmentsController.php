<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Http\Requests\AttachmentsRequest; 
use App\Attachments;
use Illuminate\Support\Facades\Response;  
use Image;


class AttachmentsController extends Controller
{
    public function index()
    { 
        $attachments=Attachments::all();
        $encodedData = json_encode($attachments, JSON_UNESCAPED_UNICODE|JSON_INVALID_UTF8_IGNORE); 
        return response()->json($encodedData, 200,array('Content-Type'=>'application/json; charset=utf-8' ));  
    }

    public function show(Attachments $attachment)
    {  
        $image_file = Image::make($attachment->file);
        $response = Response::make($image_file->encode('jpeg'));
        $response->header('Content-Type', 'image/jpeg');

        // $img = Image::cache(function($image_file) {
        //     return $image_file->make('public/foo.jpg')->resize(300, 200)->greyscale();
        //  });
         
   
        return $response; 
    }

    public function store(AttachmentsRequest $request)
    {       
           $image_file = $request->file; 
           $image = Image::make($image_file); 
           Response::make($image->encode('jpeg')); 
           $data = Attachments::create([
            'file_name'  => $request->file_name,
            'file' => $image,
            'check_bank_id'=>  $request->check_bank_id,
            'workspace_id'=>  $request->workspace_id,  
            ]);
            $encodedData = json_encode($data, JSON_UNESCAPED_UNICODE|JSON_INVALID_UTF8_IGNORE);
            return response()->json($encodedData, 201); 
         
    }

    public function update(Request $request, Attachments $attachments)
    {
        $attachments->update($request->all());
        return response()->json($attachments, 200);
    }

    public function delete(Attachments $attachments)
    {
        $attachments->delete();
        return response()->json(null, 204);
    }
}

 