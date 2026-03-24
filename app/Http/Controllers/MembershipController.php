<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Plan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Membership::with(['user','plan'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id',
        'plan_id' => 'required|exists:plans,id',
        'start_date' => 'required|date']);
        $plan = Plan::find($request->plan_id);

        $start = Carbon::parse($request->start_date);
        $end = $start->copy()->addDays($plan->duration);

        $membership = Membership::create([
        'user_id' => $request->user_id,
        'plan_id' => $request->plan_id,
        'start_date' => $start,
        'end_date' => $end,
        'status' => 'active'
        ]);
        return response()->json($membership,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $membership = Membership::with(['user','plan'])->find($id);
        if(!$membership){
            return response()->json(['message' => 'Membership not found']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $membership = Membership::find($id);
         if(!$membership){
            return response()->json(['message' => 'membership not found']);
         }
         $membership->update($request->all());
         return response()->json($membership);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $membership = Membership::find($id);
        if (!$membership){
            return response()->json(['message' => 'Membership not found']);
        }
        $membership->delete();
        return response()->json('membership deleted');
    }
}
