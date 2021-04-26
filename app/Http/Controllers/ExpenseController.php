<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Expensetype;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $month = $now->format('F');

        $expensetypes = Expensetype::orderBy('name')->get();
        return view('backside.expense',compact('expensetypes','month'));
    }

    public function getlistData(Request $request)
    {
        $now = Carbon::now();
        $month = $now->month;

        $data = Expense::orderBy('expensedate', 'DESC')->whereMonth('expensedate',$month)->get();

        // dd($data);

        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('expensedate', function(Expense $expense) {
                        return $expense->expensedate;
                    })
                    ->addColumn('title', function(Expense $expense) {
                        return $expense->title;
                    })
                    ->addColumn('expensetype', function(Expense $expense) {
                        return $expense->expensetype->name;
                    })
                    ->addColumn('amount', function(Expense $expense) {
                        return number_format($expense->amount);
                    })
                    ->addColumn('estatus', function(Expense $expense) {
                        $status = $expense->status;

                        if ($status == 'Paid') {
                            $statusBadge = '<span class="badge bg-success"> '.$status.' </span>';
                        }else{
                            $statusBadge = '<span class="badge bg-danger"> '.$status.' </span>';

                        }

                        return $statusBadge;
                    })
                    ->addColumn('user', function(Expense $expense) {
                        return $expense->user->name;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="buttons">';
                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" 
                        data-title="'.$row->title.'" 
                        data-expensedate ="'.$row->expensedate.'"
                        data-amount ="'.$row->amount.'"
                        data-status ="'.$row->status.'"
                        data-expensetype_id ="'.$row->expensetype_id.'"
                        >
                                    <i class="bi bi-gear btnicon"></i>
                                </a>';

                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-danger mmfont deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ဖျက်ပစ်မည်" data-id="'.$row->id.'">
                                    <i class="bi bi-x btnicon"></i>
                                </a>';
                        
                        $btn = $btn.'</div>';
    
                        return $btn;
   
                    })
                    ->rawColumns(['estatus','action'])
                    ->make(true);
    }

    public function getsearchExpense(Request $request)
    {
        $s = request('sdate');
        $e = request('edate');

        $start = Carbon::parse($s)->format('Y-m-d');
        $end = Carbon::parse($e)->format('Y-m-d');

        $datas = Expense::whereBetween('expensedate',[$start, $end])
                ->get();

        return  Datatables::of($datas)
                    ->addIndexColumn()
                    ->addColumn('expensedate', function(Expense $expense) {
                        return $expense->expensedate;
                    })
                    ->addColumn('title', function(Expense $expense) {
                        return $expense->title;
                    })
                    ->addColumn('expensetype', function(Expense $expense) {
                        return $expense->expensetype->name;
                    })
                    ->addColumn('amount', function(Expense $expense) {
                        return number_format($expense->amount);
                    })
                    ->addColumn('estatus', function(Expense $expense) {
                        $status = $expense->status;

                        if ($status == 'Paid') {
                            $statusBadge = '<span class="badge bg-success"> '.$status.' </span>';
                        }else{
                            $statusBadge = '<span class="badge bg-danger"> '.$status.' </span>';
                        }

                        return $statusBadge;
                    })
                    ->addColumn('user', function(Expense $expense) {
                        return $expense->user->name;
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="buttons">';
                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-warning text-dark mmfont editBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ပြင်ဆင်မည်" data-id="'.$row->id.'" 
                        data-title="'.$row->title.'" 
                        data-expensedate ="'.$row->expensedate.'"
                        data-amount ="'.$row->amount.'"
                        data-status ="'.$row->status.'"
                        data-expensetype_id ="'.$row->expensetype_id.'"
                        >
                                    <i class="bi bi-gear btnicon"></i>
                                </a>';

                        $btn = $btn.'<a href="javascript:void(0)" class="btn icon btn-danger mmfont deleteBtn" data-bs-toggle="tooltip" data-bs-placement="top" title="ဖျက်ပစ်မည်" data-id="'.$row->id.'">
                                    <i class="bi bi-x btnicon"></i>
                                </a>';
                        
                        $btn = $btn.'</div>';
    
                        return $btn;
   
                    })
                    ->rawColumns(['estatus','amount','action'])
                    ->make(true);
    }

    public function gettotalData()
    {
        $now = Carbon::now();
        $month = $now->month;

        $datas = Expense::whereMonth('expensedate',$month)->get();

        $total=0;

        foreach ($datas as $data) 
        {
            $amount = $data->amount;

            $total += $amount++;
        }

        return response()->json(['total'=>number_format($total)]);
    }

    public function getsearchExpensetotal(Request $request)
    {
        $now = Carbon::now();
        $month = $now->month;

        $s = request('sdate');
        $e = request('edate');

        $start = Carbon::parse($s)->format('Y-m-d');
        $end = Carbon::parse($e)->format('Y-m-d');

        $datas = Expense::whereBetween('expensedate',[$start, $end])
                ->get();

        $total=0;

        foreach ($datas as $data) 
        {
            $amount = $data->amount;

            $total += $amount++;
        }

        return response()->json(['searchTotal'=>number_format($total)]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  =>'required',
            'date'  =>'required',
            'amount'  =>'required',

        ];

        $customMessages = [
            'name.required' => ' အသုံးစာရင်းခေါင်းစဥ် ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'date.required' => 'ရက်ဆွဲ ဖြည့်သွင်းရန်လိုအပ်သည်။',
            'amount.required' => 'ငွေပမာဏ ဖြည့်သွင်းရန်လိုအပ်သည်။',
        ];

        $this->validate($request, $rules, $customMessages);

        Expense::create([
            'expensedate'  => $request->date,
            'title'  => $request->name,
            'amount'  => $request->amount,
            'expensetype_id'  => $request->expensetype,
            'status'  => $request->status,
            'user_id'   => Auth::id()

        ]);        
       
            return response()->json(['success'=>'Expense <b> SAVED </b> successfully.']);
        
    }
    public function show(Expense $expense)
    {
        //
    }

    public function edit(Expense $expense)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $expense=Expense::find($id);
        $expense->expensedate= request('date');
        $expense->title= request('title');
        $expense->amount= request('amount');
        $expense->status= request('status');
        $expense->expensetype_id= request('expensetypeid');

        $expense->user_id= Auth::id();


        $expense->save();

        return response()->json(['success'=>'Expense <b> UPDATED </b> successfully.']);
    }

    public function destroy(Expense $expense)
    {
        $expense->delete();

        return response()->json(['success'=>'Expense <b> DELETED </b> successfully.']);
    }
}
