<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        return view('pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('pages.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'username' => 'required|unique:users',
            'email'    => 'required|unique:users',
            'password' => 'required|confirmed',
            'role_id'  => 'required',
        ]);
        try {
            DB::beginTransaction();
            $user = User::create($request->all());
            $roleUser = new RoleUser();
            $roleUser->user_id = $user->id;
            $roleUser->role_id = $request->role_id;
            $roleUser->save();
            DB::commit();
            return redirect()->route('view.user')
            ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->route('view.user.insert')
                ->with('error', 'Data Gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('role')->where('id',$id)->first();
        $roles = Role::all();
        // dd($user->role);
        return view('pages.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|unique:users,username,'.$id,
            'email'    => 'required|unique:users,email,'.$id,
            'role_id'  => 'required',
        ]);

        try{
            DB::beginTransaction();
            User::findOrFail($id);
            User::where('id',$id)->update($request->only(['username','email','name']));
            RoleUser::where('user_id',$id)->update($request->only('role_id'));
            DB::commit();
            return redirect()->route('view.user')
            ->with('success', 'Data Berhasil disimpan');
        }catch(Exception $e){
            DB::rollBack();
            // dd($e);
            return redirect()->route('view.user.edit',$id)
            ->with('error', 'Data Gagal disimpan');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        try {
            DB::beginTransaction();

            RoleUser::where('user_id',$id)->delete();
            User::where('id',$id)->delete();
            
            DB::commit();
            
            $success = true;         
            return response()->json(['success'=>$success]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false,'errors' => $e]);
        }
    }
}
