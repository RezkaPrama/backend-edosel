<?php

namespace App\Http\Controllers;

use App\Exports\InputDokumenExport;
use App\Models\InputDokumen;
use App\Models\InputDokumenDetail;
use App\Models\Shelf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Maatwebsite\Excel\Facades\Excel;

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
            'nik'                  => 'required',
            'nama'                 => 'required',
            'tanggal_input'        => 'required',
            'pangkat'              => 'required',
            'satuan'               => 'required',
            'jenis_karyawan'       => 'required',
            'shelf_id'             => 'required'
        ]);

        // Example: Create a new user and store it in the database
        $dokumen = InputDokumen::create([

            'id'                => $request->input('lastId'),
            'nik'               => $request->input('nik'),
            'nama'              => $request->input('nama'),
            'tanggal_input'     => $request->input('tanggal_input'),
            'pangkat'           => $request->input('pangkat'),
            'satuan'            => $request->input('satuan'),
            'jenis_karyawan'    => $request->input('jenis_karyawan'),
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
    public function destroy($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function export()
    {

        // Generate the Excel file
        $filePath = Excel::store(new InputDokumenExport, 'export.xlsx', 'public');

        // Download the file
        return response()->download($filePath, 'export.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
