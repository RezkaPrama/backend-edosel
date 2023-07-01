<?php

namespace App\Http\Controllers;

use App\Models\InputDokumen;
use App\Models\InputDokumenDetail;
use App\Models\Shelf;
use Illuminate\Http\Request;

class InputDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokumen = InputDokumen::latest()->when(request()->q, function ($dokumen) {
            $dokumen = $dokumen->where('nik', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.dokumen.index', compact('dokumen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shelf = Shelf::all();

        return view('admin.dokumen.create', compact('shelf'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation passed, proceed to save data to the database
        $this->validate($request, [
            'nik'                  => 'required',
            'nama'                 => 'required',
            'tanggal_input'        => 'required',
            'jabatan'              => 'required',
            'jenis_karyawan'       => 'required',
            'shelf_id'             => 'required'
        ]);

        // Example: Create a new user and store it in the database
        $dokumen = InputDokumen::create([

            'nik'               => $request->input('nik'),
            'nama'              => $request->input('nama'),
            'tanggal_input'     => $request->input('tanggal_input'),
            'jabatan'           => $request->input('jabatan'),
            'jenis_karyawan'    => $request->input('jenis_karyawan'),
            'shelf_id'          => $request->input('shelf_id')

        ]);

        if ($dokumen) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.dokumen.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.dokumen.index')->with(['error' => 'Data Gagal Disimpan!']);
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
        $dokumenDetail = InputDokumenDetail::where('input_dokumen_id', $id)->get();

        $dokumen = InputDokumen::findOrFail($id);
        $shelf = Shelf::all();

        return view('admin.dokumen.edit', compact('dokumen', 'shelf', 'dokumenDetail'));
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
        // Validation passed, proceed to save data to the database
        $this->validate($request, [
            'nik'                  => 'required',
            'nama'                 => 'required',
            'tanggal_input'        => 'required',
            'jabatan'              => 'required',
            'jenis_karyawan'       => 'required',
            'shelf_id'             => 'required'
        ]);

        $dokumen = InputDokumen::findOrFail($id);

        $dokumen->update([
            'nik'               => $request->input('nik'),
            'nama'              => $request->input('nama'),
            'tanggal_input'     => $request->input('tanggal_input'),
            'jabatan'           => $request->input('jabatan'),
            'jenis_karyawan'    => $request->input('jenis_karyawan'),
            'shelf_id'          => $request->input('shelf_id')
        ]);

        if ($dokumen) {
            return redirect()->back()->with(['success' => 'Data Berhasil DiUpdate!']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Di Update!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
