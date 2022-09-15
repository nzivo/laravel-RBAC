<?php

namespace App\Http\Controllers;

use App\Models\CapUsage;
use App\Http\Requests\StoreCapUsageRequest;
use App\Http\Requests\UpdateCapUsageRequest;
use Illuminate\Support\Facades\DB;

class CapUsageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = DB::table('users')->get();
        $id = 86;
        $userCreated = now();
        $current_date = now();

        $users = DB::table('users')
            ->join('account_transactions', 'users.id', '=', 'account_transactions.reseller_id')
            ->where('account_transactions.created_at', 'users.created_at', 'date(curdate())')
            ->orWhere($current_date)
            ->orWhere($id)
            ->groupBy('name');

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCapUsageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCapUsageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CapUsage  $capUsage
     * @return \Illuminate\Http\Response
     */
    public function show(CapUsage $capUsage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCapUsageRequest  $request
     * @param  \App\Models\CapUsage  $capUsage
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCapUsageRequest $request, CapUsage $capUsage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CapUsage  $capUsage
     * @return \Illuminate\Http\Response
     */
    public function destroy(CapUsage $capUsage)
    {
        //
    }
}
