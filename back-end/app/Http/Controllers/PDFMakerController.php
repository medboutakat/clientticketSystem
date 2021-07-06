<?php 

namespace App\Http\Controllers;
use App;
use Image; 
use App\User;
use App\Agency;
use App\Branch;
use ZipArchive;
use App\Customer;
use App\Pointing;
use App\CheckBank;
use App\Workspace;
use Carbon\Carbon;
use App\CheckStates;
use App\CheckBanksViews;
use App\CheckStatesViews;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\TransfersRequest;


use App\Http\Requests\CheckStatesRequest;
use Illuminate\Support\Facades\Response;  
use App\Http\Requests\LeavePaymentRequest; 
use App\Http\Requests\CheckBankFilterRequest;
use App\PointingDetails;
use App\Subscriber;

class PDFMakerController extends Controller{

    private $pdf;


    public function __construct()
    {
        $this->pdf = App::make('dompdf.wrapper');   
    }

    private function loadView($obj1,$obj2){
        $this->pdf->loadView($obj1,$obj2)->setPaper('a4', 'landscape');
    }
    private function loadViewA4($obj1,$obj2){
        $this->pdf->loadView($obj1,$obj2)->setPaper('a4'); 
    }
    private function loadViewA4L($obj1,$obj2){ 
        $this->pdf->loadView($obj1,$obj2)->setPaper('a4', 'landscape');
    }
    private function stream(){
        return $this->pdf->stream(); 
    }
    

    function PrintSubscribers(){ 
        $subscribers= Subscriber::all();
 
        //  $attachment = App\Attachments::find(1); 

        $this->loadViewA4L("subscribers",array('users' => $subscribers,'response'=>"test"));
        // // return $pdf->download('web.pdf');
        return $this->stream(); 
    } 
//------------------------------PrintCheckBanksReported----------------------
 
    function PrintCheckBanksUnpaid(CheckBankFilterRequest $request){  

        $attriutes=$request->getAttributes();
        $from= $attriutes['from'];
        $to= $attriutes['to'];  
 
        $paymentModesIdExist = isset($attriutes['payment_modes_id']) && !empty($attriutes['payment_modes_id']);
        $paymentModesId = $paymentModesIdExist && $attriutes['payment_modes_id'] != null ? $attriutes['payment_modes_id'] : null;

        $customerExist = isset($attriutes['customer_id']);
        $customerId=  $customerExist && $attriutes['customer_id']!=null ? $attriutes['customer_id']:null;  
 
         
        // $customers= Customer::all();  

        // $from = date('2010-10-20 00:00:00');
        // $to = date('2022-10-25 00:00:00'); 

        $checkBanksView=  DB::table('check_banks_views'); 

        $checkBanks= $checkBanksView->whereBetween('unpaid_date', [$from, $to]);
  
        if($customerId){
            $checkBanks=$checkBanks->where('customer_id',$customerId);
        } 
 
        
        $paymentModes = null;

        if ($paymentModesId) {
            $checkBanks = $checkBanks->where('payment_modes_id', $paymentModesId);
            $paymentModes = App\PaymentMode::find($paymentModesId);
        }

        $checkBanksFiltred=$checkBanks->get();

        $total= 0;
        if( $checkBanksFiltred)
             $total= $checkBanksFiltred->sum('amount');  


        $this->loadView("checkBanksEffetsUnpayed",array('checkBanks' => $checkBanksFiltred,"paymentModes"=>$paymentModes,"total"=>$total));
        // return $this->download('web.pdf');
        return $this->stream(); 
    }  
    //------------------------------PrintCheckBanksReported----------------------
    // function PrintCheckBanksReported(CheckBankFilterRequest $request){  
    function PrintCheckBanksReported(CheckBankFilterRequest $request){ 

        $attriutes=$request->getAttributes();
 
        $from= $attriutes['from'];
        $to= $attriutes['to'];    

        $paymentModesIdExist = isset($attriutes['payment_modes_id']) && !empty($attriutes['payment_modes_id']);
        $paymentModesId = $paymentModesIdExist && $attriutes['payment_modes_id'] != null ? $attriutes['payment_modes_id'] : null;

        $customerExist = isset($attriutes['customer_id']); 
        $customerId=  $customerExist? $attriutes['customer_id']:null;  
  
        $checkBanksView=  DB::table('check_banks_views'); 

        $checkBanks= $checkBanksView->whereBetween('report_date', [$from, $to]);
 
        if($customerId!=null)
            $checkBanks =$checkBanks->where('customer_id', $attriutes['customer_id']);
     
        
        $paymentModes = null;

        if ($paymentModesId) {
            $checkBanks = $checkBanks->where('payment_modes_id', $paymentModesId);
            $paymentModes = App\PaymentMode::find($paymentModesId);
        }


        // Log::info('message'); 
       
        $checkBanksFiltred=$checkBanks->get();

        $total= 0;
        if( $checkBanksFiltred)
             $total= $checkBanksFiltred->sum('amount');   

        $this->loadView("checkBanksEffetsReported",array('checkBanks' => $checkBanksFiltred,"paymentModes"=>$paymentModes,"total"=>$total));
        // return $this->download('web.pdf');
        return $this->stream(); 
    }  
    //------------------------------PrintCheckBanksWallet----------------------
    function PrintCheckBanksWallet(CheckBankFilterRequest $request){  
        
        $attriutes=$request->getAttributes();
        $from= $attriutes['from'];
        $to= $attriutes['to'];     


        $paymentModesIdExist = isset($attriutes['payment_modes_id']) && !empty($attriutes['payment_modes_id']);
        $paymentModesId = $paymentModesIdExist && $attriutes['payment_modes_id'] != null ? $attriutes['payment_modes_id'] : null;

 
        $nature_checksExist = isset($attriutes['nature_checks_id']);
        $natureChecksId=  $nature_checksExist && $attriutes['nature_checks_id']!=null? $attriutes['nature_checks_id']:null;   

  
        $customerExist = isset($attriutes['customer_id']);
        $customerId=  $customerExist && $attriutes['customer_id']!=null ? $attriutes['customer_id']:null;  
      
        $natureName ="none" ; 
        
        $checkBanksView=  DB::table('check_banks_views'); 

        $checkBanks= $checkBanksView->whereBetween('payment_deadline_date', [$from, $to]) ;

  

        if($customerId){
            $checkBanks=  $checkBanks->where('customer_id',$customerId) ;
        }
         

        $paymentModes = null;   

        if($paymentModesId){
            $checkBanks=  $checkBanks->where('payment_modes_id',$paymentModesId) ;
            $paymentModes = App\PaymentMode::find($paymentModesId);
        }

        if($natureChecksId){
            $nature=  App\NatureCheck::where('id', $natureChecksId)->first();
            if($nature!=null){
                 $natureName=$nature->name;
                 $checkBanks= $checkBanks->where('nature_checks_id',$natureChecksId) ;
            }
        }

        $checkBanksFiltred=$checkBanks->get();

        $total= 0;
        if( $checkBanksFiltred)
             $total= $checkBanksFiltred->sum('amount');  
 
        $this->loadView("checkBanksEffetsWallet",array('checkBanks' =>  $checkBanksFiltred,'title'=>$natureName,"paymentModes"=>$paymentModes,"total"=>$total));
       // return $this->download('web. pdf');
        return $this->stream(); 
    }  

    function PrintCheckBanksEncaissed(CheckBankFilterRequest $request)
    {

        $attriutes = $request->getAttributes();
        $from = $attriutes['from'];
        $to = $attriutes['to'];

        $paymentModesIdExist = isset($attriutes['payment_modes_id']) && !empty($attriutes['payment_modes_id']);
        $paymentModesId = $paymentModesIdExist && $attriutes['payment_modes_id'] != null ? $attriutes['payment_modes_id'] : null;

        $nature_checksExist = isset($attriutes['nature_checks_id']);
        $natureChecksId = $nature_checksExist && $attriutes['nature_checks_id'] != null ? $attriutes['nature_checks_id'] : null;

        $customerExist = isset($attriutes['customer_id']);
        $customerId = $customerExist && $attriutes['customer_id'] != null ? $attriutes['customer_id'] : null;

        $natureName = "none";

        $checkBanksView = DB::table('check_banks_views');

        $checkBanks = $checkBanksView->whereBetween('encasment_date', [$from, $to]);

        if ($customerId) {
            $checkBanks = $checkBanks->where('customer_id', $customerId);
        }

        $paymentModes = null;

        if ($paymentModesId) {
            $checkBanks = $checkBanks->where('payment_modes_id', $paymentModesId);
            $paymentModes = App\PaymentMode::find($paymentModesId);
        }

        if ($natureChecksId) {
            $nature = App\NatureCheck::where('id', $natureChecksId)->first();
            if ($nature != null) {
                $natureName = $nature->name;
                $checkBanks = $checkBanks->where('nature_checks_id', $natureChecksId);
            }
    }

    $checkBanksFiltred = $checkBanks->get();

    $total = 0;
    if ($checkBanksFiltred) {
        $total = $checkBanksFiltred->sum('amount');
    }

    $this->loadView("checkBanksEncaissed", array('checkBanks' => $checkBanksFiltred, 'title' => $natureName, "paymentModes" => $paymentModes, "total" => $total));
    // return $this->download('web. pdf');
    return $this->stream();
}


    private function GetById($customersCol){
         $customersCol->first(function($it, $customerId) {
          if( $it->id==$customerId)
             return $it; 
         });
    }

    function PrintCheckState(CheckStatesRequest $request){   
        
        $user=$request->user();  
        $attriutes = $request->getAttributes();
        $checkStateId = $attriutes['check_state_id'];

        $workspace=""; 
        
        $checkState = App\CheckState::find($checkStateId);  

        if($checkState == null) 
            return response()->json(null, 204);

        $checkBanksView=  DB::table('check_state_details_views'); 
            
        $checkStateDetails =  $checkBanksView->where('check_states_id', $checkStateId)->get();

        if($checkStateDetails == null) 
            return response()->json("no pdf to generate", 204);

        $stateAccountBank = App\BankAccount::find($checkState->bank_account_id);
        
        $stateBank = App\Bank::find($stateAccountBank->bank_id);  
        
        $checkStateDetailsByPayementId = CheckBank::where('check_states_id', $checkStateId)->select('payment_modes_id', DB::raw('count(*) as total'))
        ->groupBy('payment_modes_id')
        ->get();  

         
        $paymentModes = App\PaymentMode::all(); 
 
        foreach ($checkStateDetailsByPayementId as $value) {
            $paymentModeById = $paymentModes->firstWhere('id',$value->payment_modes_id); 

            $value->payment_modes_check_name=$paymentModeById->name;
        } 
    
        $statePaymentMode = $paymentModes->firstWhere('id',$checkState->payment_modes_id);


        $this->loadView("checkBanksStates",
            array('checkState'=>$checkState,
                'checkStateDetails' => $checkStateDetails,
                'workspace'=>$workspace,
                'checkStateDetailsByPayementId'=>$checkStateDetailsByPayementId,
                'stateBank'=>$stateBank,
                'stateAccountBank'=>$stateAccountBank,
                'statePaymentMode'=> $statePaymentMode )
        );
        
        return $this->stream();
    } 


    

    function PrintLeavePayment(LeavePaymentRequest $request){

        $user=$request->user();  
        $attriutes = $request->getAttributes();
        $leavePaymentId = $attriutes['paymentleave_id']; 
        $workspace=""; 
        
        $leavePayment = App\LeavePayment::find($leavePaymentId);  

        if($leavePayment == null) 
            return response()->json(null, 204);
 
        $salary = App\Salary::find($leavePayment->salary_id);   
        $customerBank = App\Bank::find($salary->bank_id); 
        $salaryCategory = App\SalaryCategory::find($salary->salary_category_id);  
        $am2=explode(".",$leavePayment->amount)[1];
        $leavePayment->amount2=$am2;
 
        
        $this->loadViewA4("paymentleave",
            array('leavePayment'=>$leavePayment,
                'salary' => $salary,
                'workspace'=>$workspace,
                'salaryCategory'=>$salaryCategory,  
                'customerBank'=>$customerBank, 
                )
        );
        
        return $this->stream();
    } 
     
    function PrintTransfer(TransfersRequest $request){   
        
        $user=$request->user();  
        $attriutes = $request->getAttributes();
        $transferId = $attriutes['transfer_id'];

        $workspace=""; 
        
        $transfer = App\Transfer::find($transferId);  

        if($transfer == null) 
            return response()->json(null, 204);
 
        $customer = App\Customer::find($transfer->customer_id);  
        $customerBank = App\Bank::find($customer->bank_id);
 

        $bankAccount = App\BankAccount::find($transfer->bank_account_id);
  
        $bank = App\Bank::find($bankAccount->bank_id);
         
        
        $am2=explode(".",$transfer->amount)[1];
        $transfer->amount2=$am2;
        
        $this->loadViewA4("transfers",
            array('transfer'=>$transfer,
                'customer' => $customer,
                'workspace'=>$workspace,
                'bankAccount'=>$bankAccount, 
                'bank'=>$bank, 
                'customerBank'=>$customerBank, 
                )
        );
        
        return $this->stream();
    } 

    function PrintTransferMultiple(TransfersRequest $request){   
        
        $user=$request->user();  
        $attriutes = $request->getAttributes();
        $transferId = $attriutes['transfer_id'];

        $workspace=""; 
        
        $transfer = App\TransferMultiple::find($transferId);  

        if($transfer == null) 
            return response()->json(null, 204);
 

        $bankAccount = App\BankAccount::find($transfer->bank_account_id);  
        $bank = App\Bank::find($bankAccount->bank_id); 

        $agencies = Agency::all();

        $details=[];
        foreach ($transfer->details as $detail) { 
            $customer = App\Customer::find($detail['customer_id']);   
            $agency = $agencies->firstWhere('id', $detail['agency_id']);   
            if($agency!=null) $customer->agency_name= $agency->name;
            $customer->amount=$detail['amount'];
            $details[]= $customer;
        }

        $am2=explode(".",$transfer->amount)[1];
        $transfer->amount2=$am2;  
        
        $this->loadViewA4("transfersmultiple",
            array('transfer' => $transfer, 
                'workspace' => $workspace,
                'bankAccount' => $bankAccount,
                'bank' => $bank, 
                'details' => $details, 
            ));


        return $this->stream();
    } 

    //--------------------------------PrintCheckBanksState---------------------
    function GenerateVerement($checkStateId){ 
     
        $zip = new ZipArchive;
        //This is the main document in a .docx file.
        $fileToModify = 'word/document.xml';
        $wordDoc = "Document.docx";

        if ($zip->open($wordDoc) === true) {
            //Read contents into memory
            $oldContents = $zip->getFromName($fileToModify);
            //Modify contents:
            $newContents = str_replace('Microsoft', 'Openoffice', $oldContents);
            //Delete the old...
            $zip->deleteName($fileToModify);
            //Write the new...
            $zip->addFromString($fileToModify, $newContents);
            //And write back to the filesystem.
            $return = $zip->close();
            if ($return == true) {
                echo "Success!";
            }
        } else {
            echo 'failed';
        }


        return 0;
    }  


    function PrintPointing($month,$branch_id){


        $branch=Branch::find($branch_id);

        $dataMonths=Pointing::whereMonth('date', '=', $month)->get()->first();  
        $data=PointingDetails::whereMonth('pointing_id', '=',$dataMonths->id)->get();   

        $sqlPointing = "SELECT  d.*,p.date FROM pointing_details d  INNER JOIN pointings p ON p.id=d.pointing_id  and month(p.date)=?";  
        $data=DB::select($sqlPointing,[$month]);  



        $sql = "SELECT  s.*,c.name as function,IFNULL(d.hours,0) hours,p.date FROM pointing_details d
                INNER JOIN pointings p ON p.id=d.pointing_id  and month(p.date)=?
                RIGHT JOIN salaries s ON s.id=d.salary_id AND s.branch_id=? 
                INNER JOIN salary_categories c on c.id=s.salary_category_id "; 

        
        // $sql = "SELECT  s.*,c.name as function,IFNULL(d.hours,0) hours,p.date FROM pointing_details d
        //         INNER JOIN pointings p ON p.id=d.pointing_id  and month(p.date)=?
        //         RIGHT JOIN salaries s ON s.id=d.salary_id AND s.branch_id=? 
        //         INNER JOIN salary_categories c on c.id=s.salary_category_id ";
       
        $sql = "SELECT  s.*,c.name as function from salaries s INNER JOIN salary_categories c on c.id=s.salary_category_id AND s.branch_id=? ORDER BY s.full_name"; 
        $salaries=DB::select($sql,[$branch_id]);  

        $totalDays=Carbon::now()->daysInMonth; 
        $firstCols=0;
        $presence=array();
        for ($i = 0; $i <sizeof($salaries); $i++){ 

              $presence[$i][$firstCols++]=$salaries[$i]->id;
              $presence[$i][$firstCols++]=$salaries[$i]->full_name ;
              $presence[$i][$firstCols++]=$salaries[$i]->function ; 
              $salId=$salaries[$i]->id;
              $totalPresenceDays=0;
            for ($j = $firstCols; $j <  $totalDays+$firstCols; $j++) {
                    
                $presence[$i][$j] = "0X0";

                // $filtered = $data->where(function ($dt) use ($salId,$j) {
                //    $date= \Carbon\Carbon::create($dt['date']);  
                //     return $dt->salary_id==$salId && $date->day == ($j-3);  
                // }); 
                $filtered = array_filter($data, function($obj) use ($salId,$j){  
                    $date= \Carbon\Carbon::create($obj->date);  
                    return $obj->salary_id==$salId && $date->day == ($j-3);   
                });


                if(sizeof($filtered) > 0){ 
                    $sum = array_reduce($filtered, function($i, $obj)
                    {
                        return $i += $obj->hours;
                    });
                   // $sum = array_sum(array_column($filtered, 'hours'));


                   // $totalPresenceDays++;
                    $totalPresenceDays+=$sum/9.00;//$filtered[0]->hours ;
                    $presence[$i][$j] = $sum; 
                }
            }   

            $presence[$i][$firstCols+ $totalDays+1] =number_format((float) $totalPresenceDays, 2, '.', ''); 
            $presence[$i][$firstCols+ $totalDays+2] =$salaries[$i]->amount;
            $presence[$i][$firstCols+ $totalDays+3] = "";
            $presence[$i][$firstCols+ $totalDays+4] = ""; 
            $presence[$i][$firstCols+ $totalDays+5] = ""; 

        }
         

        // return  $presence;
        $this->loadViewA4L("pointing",array('salaries' => $salaries,'totalDays'=>$totalDays,
        'month'=> $month,
        'presence'=> $presence,
        'branch'=>$branch    
        ));

        return $this->stream();


    }
}