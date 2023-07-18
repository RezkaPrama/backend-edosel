<?php

namespace App\Http\Controllers;

use App\Exports\InputDokumenExport;
use App\Models\InputDokumen;
use App\Models\InputDokumenDetail;
use App\Models\Shelf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Console\Input\Input;

class InputDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = InputDokumen::query();

        if ($request->has('nik')) {
            $query->orWhere('nik', $request->input('nik'));
        }

        if ($request->has('nama')) {
            $query->orWhere('nama', $request->input('nama'));
        }

        if ($request->has('no_rak')) {
            $query->orWhere('shelf_id', $request->input('no_rak'));
        }

        $dokumen = $query->paginate(10);

        $shelf = Shelf::all();

        return view('admin.dokumen.index', compact('dokumen', 'shelf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shelf = Shelf::all();
        $lastId = InputDokumen::latest()->value('id');

        return view('admin.dokumen.create', compact('shelf', 'lastId'));
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
            'no_dosir'             => 'required',
            'nik'                  => 'required',
            'nama'                 => 'required',
            'tanggal_input'        => 'required',
            'pangkat'              => 'required',
            'satuan'               => 'required',
            'personel'             => 'required',
            'shelf_id'             => 'required'
        ]);

        // Example: Create a new user and store it in the database
        $dokumen = InputDokumen::create([

            'id'                => $request->input('lastId'),
            'no_dosir'          => $request->input('no_dosir'),
            'nik'               => $request->input('nik'),
            'nama'              => $request->input('nama'),
            'tanggal_input'     => $request->input('tanggal_input'),
            'pangkat'           => $request->input('pangkat'),
            'satuan'            => $request->input('satuan'),
            'personel'          => $request->input('personel'),
            'shelf_id'          => $request->input('shelf_id')

        ]);

        $dokumen->save();



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
            'pangkat'              => 'required',
            'satuan'               => 'required',
            'jenis_karyawan'       => 'required',
            'shelf_id'             => 'required'
        ]);

        $dokumen = InputDokumen::findOrFail($id);

        $dokumen->update([
            'nik'               => $request->input('nik'),
            'nama'              => $request->input('nama'),
            'tanggal_input'     => $request->input('tanggal_input'),
            'pangkat'           => $request->input('pangkat'),
            'satuan'            => $request->input('satuan'),
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
    public function destroy($id, $userid)
    {
        $dokumen = InputDokumen::findOrFail($id);
        $details = DB::table('input_dokumen_details')
            ->select('nama_file')
            ->where('input_dokumen_id', '=', $id)
            ->get();

        foreach ($details as $value) {
            $filename = $value->nama_file;
            $destinationPath = 'public/uploads'; 
            $filePath = $destinationPath . '/' . $userid . '/' . $filename;

            if (Storage::exists($filePath)) {
                Storage::delete($filePath);
            }
        }

        $dokumen->inputDokumenDetail()->delete();
        $dokumen->delete();

        return response()->json([
            'success' => true,
            'data' => $filePath
        ]);
    }

    /**
     * filter export the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function exportExcel(Request $request, $userid)
    {
        $nik = $request->input('nik');
        $nama = $request->input('nama');
        $no_rak = $request->input('no_rak');

        $query = InputDokumen::query();

        if ($nik != null) {
            $query->where('nik', $nik);
        }
        if ($nama != null) {
            $query->where('nama', $nama);
        }
        if ($no_rak != null) {
            $query->where('shelf_id', $no_rak);
        }

        $results = $query->get();

        return Excel::download(new InputDokumenExport($results), 'Dokumen.xlsx');
    }
}
