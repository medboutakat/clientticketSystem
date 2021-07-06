<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\SubscriberFunction;

class SubscriberFunctionController extends Controller
{
    public function index()
    {
        return SubscriberFunction::all();
    }

    public function show(SubscriberFunction $data)
    {
        return $data;
    }

    public function store(Request $request)
    {  
        $data = SubscriberFunction::create($request->all());

        return response()->json($data, 201);
    }

    public function update(Request $request, SubscriberFunction $data)
    { 

        $data=$data->update($request->all());

        return response()->json($data, 200);
    }

    public function delete(SubscriberFunction $data)
    {
        $data->delete();

        return response()->json(null, 204);
    }
}
 