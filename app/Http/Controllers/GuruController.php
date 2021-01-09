<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Role;
use App\Models\RoleUser;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gurus = Guru::paginate(10);
        return view('pages.gurus.index',compact('gurus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.gurus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip'   => 'required|unique:guru',
            'nama'  => 'required',
        ]);
        try {
            DB::beginTransaction();
            Guru::create($request->all());
            $user = new User();

            $user->username = $request->nip;
            $user->name = $request->nama;
            $user->password = Hash::make("guru123"); 
            $user->save();

            $role = Role::where('name','guru')->first();
            
            $userRole = new RoleUser();
            $userRole->user_id = $user->id;
            $userRole->role_id = $role->id;
            $userRole->save();

            DB::commit();
            return redirect()->route('view.guru')
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->route('view.guru.insert')
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
        $guru = Guru::find($id);
        return view('pages.gurus.edit',compact('guru'));
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
            'nip'   => 'required|unique:guru,nip,'.$id,
            'nama'  => 'required',
        ]);
        try {
            DB::beginTransaction();
            Guru::where('id',$id)->update($request->only(['nip','nama','gelar_depan','gelar_belakang']));
            DB::commit();
            return redirect()->route('view.guru')
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->route('view.guru.edit',$id)
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

            Guru::where('id',$id)->delete();
            DB::commit();
            
            $success = true;         
            return response()->json(['success'=>$success]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false,'errors' => $e]);
        }
    }
}
