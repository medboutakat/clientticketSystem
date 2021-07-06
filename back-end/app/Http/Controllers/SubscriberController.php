<?php
namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SubscriberController extends Controller
{
    public function index()
    {
        // $sql = "SELECT  s.*,c.name as function_name,b.name branch_name from salaries s
        //         INNER JOIN salary_categories c on c.id=s.salary_category_id
        //         INNER JOIN branches b on b.id=s.branch_id"; 

        // $salaries=DB::select($sql);  
        $salaries=Subscriber::all();
        
        return $salaries;//Salary::all();
    }

    public function branch()
    {
        $user = auth()->user();  
        return Subscriber::where('branch_id', '=', $user->branch_id)->get(); 
    } 

    public function today($day)
    { 
        $user=auth()->user();
        $date= Carbon::now(); 

        $branch_id=$user->branch_id;  
        
        $sql = "SELECT  s.*,IFNULL(d.hours,0) hours FROM pointings p 
                INNER JOIN pointing_details  d ON p.id=d.pointing_id and DAY(p.date)=? AND p.branch_id=?
                RIGHT JOIN salaries s ON s.id=d.salary_id 
                ";

        $salaries=DB::select($sql,[$date->day,$branch_id]);  
        return $salaries;
    }

    public function thismonth($month)
    {
        $sql = "SELECT distinct s.*,month(p.date) as thismonth FROM salaries s left JOIN pointings p ON s.id=p.salary_id AND  month(p.date)=?";

        $salaries=DB::select($sql,[$month]); 

        return $salaries;
    } 
 
    public function show(Subscriber $data)
    {
        return $data;
    }

    public function store(Request $request)
    {  
        $data = Subscriber::create($request->all());

        return response()->json($data, 201);
    }

    public function update(Request $request, Subscriber $data)
    { 

        $data=$data->update($request->all());

        return response()->json($data, 200);
    } 
    
    public function delete(Subscriber $data)
    {
        $data->delete();

        return response()->json(null, 204);
    }

     public function activate($salaryId)
    {
        $salary=Subscriber::find($salaryId); 
        $salary->is_active=true;
        $salary->save();
         
        return response()->json($salary, 200);
    }
    
    public function deactivate($salaryId)
    {
        $salary = Subscriber::find($salaryId); 
        $salary->is_active=false;
        $salary->save();
       

        return response()->json($salary, 200);
    }
}
 