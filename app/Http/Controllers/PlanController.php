<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlanRequest;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            return response()->json(Plan::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $plan = Plan::find($id);
        if(!$plan){
            return response()->json(['message'=>'plan not found']);
        }
        return response()->json($plan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePlanRequest $request, string $id)
    {
        $plan = Plan::find($id);
        if(!$plan){
            return response()->json(['message'=>'plan not found']);
        }
        $plan->update($request->validate());
        return response()->json([
            'message' => 'plan update succesfully',
            'data'=> $plan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $plan = Plan::find($id);
        if(!$plan){
            return response()->json(['message'=>'plan not found']);
        }
        $plan->delete();
        return response()->json(['message'=>'Plan deleted succesfully']);
    }
}
