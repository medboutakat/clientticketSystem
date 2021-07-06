<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Settings;
use App\User;

class SettingsController extends Controller
{
    public function index()
    {
        $settings= Settings::all();  
        return $settings;
        // $grouped = $settings->groupBy('group'); 
        // return   $grouped; 
    }

    public function show(Settings $data)
    {
        return $data;
    }
  
    public function update(Request $request, Settings $data)
    {

        $currentUser= $request->user();  
         
        if($currentUser->isAdmin()){ 
            $data->update($request->all()); 
            return response()->json($data, 200);  
        }
           
       return response()->json(['error' => "Your don't have ennought permession."], 401);

    }

    public function delete(Settings $data)
    {
        $data->delete();

        return response()->json(null, 204);
    }
}


// 200: OK. The standard success code and default option.
// 201: Object created. Useful for the store actions.
// 204: No content. When an action was executed successfully, but there is no content to return.
// 206: Partial content. Useful when you have to return a paginated list of resources.
// 400: Bad request. The standard option for requests that fail to pass validation.
// 401: Unauthorized. The user needs to be authenticated.
// 403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
// 404: Not found. This will be returned automatically by Laravel when the resource is not found.
// 500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
// 503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.