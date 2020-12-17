<?php

namespace App\Http\Controllers;

use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatpelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matpel = MataPelajaran::paginate(10);
        return view('pages.matpel.index',compact('matpel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        if($request->id !== null){
            $request->validate([
                'kode_matpel' => 'required|unique:mata_pelajaran,kode_matpel,'.$request->id,
                'nama_matpel' => 'required'
            ]);

            $query = MataPelajaran::find($request->id);
            $query->update($request->all());
        }else{
            $request->validate([
                'kode_matpel' => 'required|unique:mata_pelajaran',
                'nama_matpel' => 'required'
            ]);

            $query = MataPelajaran::create($request->all());
        }

        if ($query) {
            return redirect()->route('view.mata_pelajaran')
                ->with('success', 'Data Berhasil disimpan');
        } else {
            return redirect()->route('view.mata_pelajaran')
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
        //
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
        //
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

            MataPelajaran::find($id)->delete();
            
            DB::commit();
            
            $success = true;         
            return response()->json(['success'=>$success]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false,'errors' => $e]);
        }
    }
}
