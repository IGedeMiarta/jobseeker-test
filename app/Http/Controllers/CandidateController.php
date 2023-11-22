<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CandidateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $candidate = new Candidate;
        $paginate = $request->paginate ??10;

        $email = $request->email ??false;
        $phone = $request->phone ??false;
        $fullname = $request->fullname ??false;
        $dob = $request->dob ??false;
        $pob = $request->pob ??false;
        $gender = $request->gender ?? false;
        $year_exp = $request->year_exp ?? false;
        $salary = $request->salary ?? false;

        $search = $request->search ??false;
        $order = $request->order ??false;

        if($search){
            $candidate = $candidate->where('email','like','%'.$search.'%')
                            ->orWhere('phone_number','like','%'.$search.'%')
                            ->orWhere('full_name','like','%'.$search.'%')
                            ->orWhere('pob','like','%'.$search.'%')
                            ->orWhere('pob','like','%'.$search.'%');
        }
        if ($email) {
            $candidate = $candidate->where('email','like','%'.$email.'%');
        }
        if ($phone) {
            $candidate = $candidate->where('phone_number','like','%'.$phone.'%');
        }
        if ($fullname) {
            $candidate = $candidate->where('full_name','like','%'.$fullname.'%');
        }
        if ($dob) {
            $candidate = $candidate->whereDate('dob', $dob);
        }
        if ($pob) {
            $candidate = $candidate->where('pob','like','%'.$pob.'%');
        }
        if ($gender != false && $gender != 'all') {
            $candidate = $candidate->where('gender', $gender);
        }
        if($year_exp){
            $candidate = $candidate->where('year_exp',$year_exp);
        }
        if($salary){
            $candidate  = $candidate->where('last_salary', preg_replace("/[^0-9]/", "", $salary));
        }

        if($order){
            $candidate = $candidate->orderBy('candidate_id',$order);
        }else{
            $candidate = $candidate->orderBy('candidate_id','desc');
        }
        $candidate = $candidate->paginate($paginate);

        return response()->json([
            'status'    => 200,
            'message'   => 'All Data Candidate',
            'pages'      => $candidate
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'         => 'required|unique:t_candidate|email',
            'phone_number'  => 'required|unique:t_candidate',
            'full_name'     => 'required',
            'dob'           => 'required|date',
            'pob'           => 'required',
            'gender'        => ['required', Rule::in(['F', 'M'])],
            'year_exp'      => 'required|integer',
        ]);
        $validator->setCustomMessages([
            'gender.in' => "Please enter only `F` for female or `M` for male.",
        ]);

        if($validator->fails()){
            return response()->json([
                'status'    => 422,
                'message'   => 'Validation Invalid',
                'errors'    => $validator->errors()
            ],422);
        }
        if($request->last_salary == null) $request['last_salary'] = 0;
        DB::beginTransaction();
        try {
            $candidate = Candidate::create($request->all());
            DB::commit();
            return response()->json([
                'status'    => 201,
                'message'   => 'New Candidate Created',
                'data'      => $candidate
            ],201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status'    => 500,
                'message'   => 'Error: '. $th->getMessage(),
            ],500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return response()->json([
                'status'  => 404,
                'message' => "Candidate Id: `$id` not found.",
            ], 404);
        }
        return response()->json([
            'status'    => 201,
            'message'   => "Show Candidate By Id",
            'data'      => $candidate
        ],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $candidate = Candidate::find($id);
        
        if (!$candidate) {
            return response()->json([
                'status'  => 404,
                'message' => "Candidate Id: `$id` not found.",
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'email'         => 'required|email|unique:t_candidate,email,' . $id,
            'phone_number'  => 'required|unique:t_candidate,phone_number,' . $id,
            'full_name'     => 'required',
            'dob'           => 'required|date',
            'pob'           => 'required',
            'gender'        => ['required', Rule::in(['F', 'M'])],
            'year_exp'      => 'required|integer',
        ]);
        $validator->setCustomMessages([
            'gender.in' => "Please enter only `F` for female or `M` for male.",
        ]);

        DB::beginTransaction();
        try {
            $candidate->update($request->all());
            DB::commit();
            return response()->json([
                'status'    => 201,
                'message'   => "Candidate Updated",
                'data'      => $candidate
            ],201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status'    => 500,
                'message'   => "Error: ". $th->getMessage(),
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $candidate = Candidate::find($id);
        if (!$candidate) {
            return response()->json([
                'status'  => 404,
                'message' => "Candidate Id: `$id` not found."
            ], 404);
        }
        DB::beginTransaction();
        try {
            $candidate->delete();
            DB::commit();
            return response()->json([
                'status'    => 201,
                'message'   => "Candidate Deleted",
            ],201);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status'    => 500,
                'message'   => "Error: ". $th->getMessage(),
            ],500);
        }
    }
}
