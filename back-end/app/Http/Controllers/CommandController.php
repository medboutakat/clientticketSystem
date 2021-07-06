<?php

namespace App\Http\Controllers;

use App\Command;
use App\CommandDetail;
use App\Payment;
use App\Customer;
use App\Delivery; 
use Carbon\Carbon;
use App\ViewDelivery;
use App\DeliveryDetail; 
use App\DeliveryPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use App\Http\Resources\ProductCategoriesResource;
use App\Http\Resources\ProductCategoriesCollection;
use App\MovementType;
use App\Stock;
use App\StockQuantity;

class DeliveryController extends Controller
{

    public function __construct()
    {
        // $this->middleware('permission:delivery-view', ['only' => ['index', 'show']]);
        // $this->middleware('permission:delivery-create', ['only' => ['store']]);
        // $this->middleware('permission:delivery-edit', ['only' => ['update']]);
        // $this->middleware('permission:delivery-delete', ['only' => ['delete']]);
    }

    public function user($userId)
    { 
        // return ViewDelivery::where('created_user',$userId)->get();
        // return 'yes'; 
        // return ViewDelivery::all();   
    }

    public function mine()
    { 
        $user=auth()->user();
        
        // return ViewDelivery::where('created_user',$user->id)->get();  
    }

    public function index()
    { 
        //return  new CheckbankCollection(Checkbank::paginate()); 
        return Command::all();  
        // return new CheckbankCollection(Checkbank::paginate(2)); 
    }
 

    public function show(Command $data)
    {   
        return  $data;
    }

    
   private  function generateRandomString($length = 20) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function store(Request $request)
    {


        DB::beginTransaction();

        try {
          
            
        $data= $request->all(null); 
        
        $data['code']= $this->generateRandomString(10);

        $details = $request->input('details.*');

        // $payments = $request->input('payments.*'); 

        // protected $fillable = ['code','customer_id', 'date','remise','subtotal','total','delivery_status_id','invoice_id' ];
   
        $id=DB::table('deliveries')->insertGetId([
            'code' => $data['code'],
            'customer_id' => $data['customer_id'],
            'date' => $data['date'],
            'remise' => $data['remise'],
            'subtotal' => $data['subtotal'],
            'total' => $data['total'],
            'delivery_status_id' => $data['delivery_status_id'],
            'invoice_id' => $data['invoice_id'],
        ]);

        
        foreach ($details as $detail) {
            
            $currentProduct=CommandDetail::find($detail['product_id']);

             $detail["delivery_id"] = $id; 
             $detail["price"] =  $detail['sale_price'];

             CommandDetail::create($detail);    
               

        }         
        
        // $delivery->details = DeliveryDetail::where('delivery_id', $delivery->id)->get();
        // $delivery->payments = DeliveryPayment::where(['delivery_id' => $delivery->id])->get();


            DB::commit();
            // all good
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }
 

        // return response()->json( $delivery, 201);
        return response()->json( "yes", 201);
    }

   private function  setDetails($details, $stateId){
   foreach ($details as $detail) {  
           $checkBank=CommandDetail::find($detail);
           $checkBank->check_states_id=$stateId;
           $checkBank->save();  
         }
    }


    public function update(Request $request, Delivery $data)
    {
         
        $dataAll= $request->all();

        $data->update($dataAll);

        return response()->json($data, 200);
    }

    public function delete(Delivery $data)
    {    
        CommandDetail::where('delivery_id', $data->id) ->delete();
        $data->delete();

        return response()->json(null, 204);
    }
}
