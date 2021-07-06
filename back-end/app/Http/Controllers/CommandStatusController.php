<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\OperationStatus; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Http\Requests\RemarkNameRequiredRequest;
// use App\Http\Resources\ProductCategoriesResource;
// use App\Http\Resources\ProductCategoriesCollection; 

class OperationStatusController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:delivery status-view', ['only' => ['index', 'show']]);
        // $this->middleware('permission:delivery status-create', ['only' => ['store']]);
        // $this->middleware('permission:delivery status-edit', ['only' => ['update']]);
        // $this->middleware('permission:delivery status-delete', ['only' => ['delete']]);
    }

    public function index()
    { 
        //return  new CheckbankCollection(Checkbank::paginate()); 
        return OperationStatus::all();  
        // return new CheckbankCollection(Checkbank::paginate(2)); 
    }

    public function show(OperationStatus $data)
    { 
        return $data; 
    }

    public function store(Request $request)
    {  
        //$data= RequestHelpers::AuditCreate($request); 
        $data= $request->all();
        // return  $request;
        $data = OperationStatus::create($data);


        return response()->json($data, 201);
    }

    public function update(Request $request, OperationStatus $data)
    {
         
        $dataAll= $request->all();

        $data->update($dataAll);

        return response()->json($data, 200);
    }

    public function delete(OperationStatus $data)
    {
        $data->delete();

        return response()->json(null, 204);
    }
}
