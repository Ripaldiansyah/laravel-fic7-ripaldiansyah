<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $users = User::paginate(5);
        $users = DB::table('users')
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orwhere('phone', 'like', '%' . $search . '%')
                    ->orwhere('email', 'like', '%' . $search . '%');
                    if(strtolower($search) === 'pending'){
                        $query->orwhereNull('email_verified_at');
                    }else{
                        $query->orwhereNotNull('email_verified_at');
                    }
                ;
            })->paginate(5);
        return view('pages.user.index', compact('users'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $user)
    {
        //
    }
}