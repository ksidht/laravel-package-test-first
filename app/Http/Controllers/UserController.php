<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\UpdateValRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request as RequestStatic;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::orderBy('id')
                ->filter(RequestStatic::only('search', 'trashed'))
                ->paginate(5)
                ->withQueryString();
        
        return view('adminusers.index', compact('users'));      
        
        /* 
        *  NEED TO REVIEW FOLLOWING CODE
        *  1. Use if require or delete it
        */

        $user_query = User::with([]);

        // if search keywork is present
        if ($request->keyword) {
            $user_query->where('name', 'LIKE', '%' . $request->keyword . '%');
        }

        // if sort is present.',
        if ($request->sortBy && in_array($request->sortBy, ['id', 'created_at'])) {
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        // if sortOrder is present.',
        if ($request->sortOrder && in_array($request->sortOrder, ['asc', 'desc'])) {
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        // if perPage is present
        if ($request->perPage) {
            $perPage = $request->perPage;
        } else {
            $perPage = '5';
        }

        // if trashed is present
        if ($request->trashed) {
            $user_query->withTrashed();
        }

        if ($request->onlyTrashed) {
            $user_query->onlyTrashed();
        }

        $user = $user_query->orderBy($sortBy, $sortOrder)->paginate($perPage);

        // dd($user);

        // return response()->success($user);
        return view('adminusers.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminusers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response()->success($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('adminusers.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateValRequest $request, User $user)
    {
        $user->update($request->validated());

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index');

    }

    public function restore(User $user)
    {
        $organization->restore();

        return redirect()->route('user.index');
    }

}
