<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use App\Models\Siswa;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrestasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestasi = Prestasi::where('guru_id',Auth::user()->guru->id)->paginate(10);
        return view('pages.prestasi.index',compact('prestasi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $siswa = KelasSiswa::with('siswa')->where('kelas_id',$walikelas->kelas_id)->get();
        $siswa = Siswa::all();
        return view('pages.prestasi.create',compact('siswa'));
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
            'siswa_id' => 'required',
            'jenis_kegiatan' => 'required'
        ]);
        try {
            DB::beginTransaction();
            $dataRequest = $request->all();
            $dataRequest['guru_id'] = Auth::user()->guru->id;
            Prestasi::create($dataRequest);
            DB::commit();
            return redirect()->route('view.prestasi')
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->route('view.prestasi.insert')
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
        $prestasi = Prestasi::find($id);
        $siswa = Siswa::all();
        return view('pages.prestasi.edit',compact('prestasi','siswa'));
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
            'siswa_id' => 'required',
            'jenis_kegiatan' => 'required'
        ]);
        try {
            DB::beginTransaction();
            Prestasi::where('id',$id)->update($request->only(['siswa_id','jenis_kegiatan','keterangan']));
            DB::commit();
            return redirect()->route('view.prestasi')
                ->with('success', 'Data Berhasil disimpan');
        } catch (Exception $e) {
            DB::rollBack();
            // dd($e);
            return redirect()->route('view.prestasi.edit',$id)
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

            Prestasi::where('id',$id)->delete();
            DB::commit();
            
            $success = true;         
            return response()->json(['success'=>$success]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['success' => false,'errors' => $e]);
        }
    }
}
