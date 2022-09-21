<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Http\Requests\StoreValRequest;
use App\Http\Requests\UpdateValRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_query = User::with([]);

        // if search keywork is present
        if ($request->keyword) {
            $user_query->where('name','LIKE','%'. $request->keyword.'%');
        }

        // if sort is present.',
        if ($request->sortBy && in_array($request->sortBy, ['id', 'created_at'])){
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        // if sortOrder is present.',
        if ($request->sortOrder && in_array($request->sortOrder, ['asc', 'desc'])){
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

        // if paginate is present
        if ($request->paginate) {
            $user = $user_query->orderBy($sortBy,$sortOrder)->paginate($perPage);
        } else if ($request->simplePaginate) {
            $user = $user_query->orderBy($sortBy,$sortOrder)->simplePaginate($perPage);
        } else {
            $user = $user_query->orderBy($sortBy,$sortOrder)->get();
        }

        
        // return response()->success($user);
        return view('adminusers.index',compact('user'));
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
    public function store(StoreValRequest $request)
    {
        dd($request->validated());
        DB::beginTransaction();
        try {
            $userData = User::create($request->validated());
            DB::commit();

            return redirect()->route('user.index');
            
            // return response()->success($userData);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->error($th,500);
        }
        
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
        return view('user.edit',compact('user'));
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
        DB::beginTransaction();
        try {
            $user->update($request->validated());
            DB::commit();
            // return response()->success($user);
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->error($th,500);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->delete();
            DB::commit();
            // return response()->success($user);
            return redirect()->route('user.index');
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->error($th,500);
        }
        
    }
}
