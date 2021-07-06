<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest; 
use App\Http\Resources\UserResource ;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Workspace;

class RegistrationController extends Controller
{
    /**
     * Register User
     *
     * @param RegistrationRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(RegistrationRequest $request) {
        $user=null;
        
        $attributes=$request->getAttributes();        
        $attributesUser=$request->except(['workspace']);
        $workspaceName= $attributes['workspace'];      
        
        try{

            DB::beginTransaction();
            $attributesUser['role']="user"; 
 
            $user=User::create($attributesUser);
            DB::commit();
        }    
        catch(Exception $ex){
            DB::rollBack();
        } 
        
        // try { 
        //          $user->sendEmailVerificationNotification();
        //   } 
        //   catch(Exception $e) {
        //     echo 'Message: ' .$e->getMessage();
        //   }

          

        return  new UserResource($user); //$this->respondWithMessage('User successfully created');
    }
}
