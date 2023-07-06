<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InputDokumenDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InputDokumenDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
    public function destroy($id, $userid)
    {
        $directory = 'public/uploads/';
        $filePath = $directory . '/' . $userid . '/';

        $dokumenDetail = InputDokumenDetail::findOrFail($id);
        // $image = Storage::disk('local')->delete('public/documents/'.basename($fileUsulanDetail->nama_file));
        $image = Storage::disk('local')->delete($filePath . basename($dokumenDetail->nama_file));
        $dokumenDetail->delete();

        if ($dokumenDetail) {
            return redirect()->back()->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            return redirect()->back()->with(['error' => 'Data Gagal Dihapus!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        if ($request->file('file') !== null) {

            // $request->validate([
            //     'file' => [
            //         'required',
            //         'mimes:xls,xlsx',
            //         'max:2048',
            //         function ($attribute, $value, $fail) {
            //             $extension = $value->getClientOriginalExtension();
            //             if (!in_array($extension, ['xls', 'xlsx'])) {
            //                 $fail($attribute . ' Salah data. hanya file excel yang diijinkan.');
            //             }
            //         },
            //     ],
            // ]);

            $userid = $request->input('users_id');
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();

            $destinationPath = 'public/uploads'; // your desired destination path

            $filePath = $destinationPath . '/' . $userid . '/';

            $file->storeAs($filePath, $filename);

            $dokumenDetail = InputDokumenDetail::create([
                'input_dokumen_id'        => $request->input('input_dokumens_id'),
                'users_id'                 => $request->input('users_id'),
                'nama_file'                => $file->getClientOriginalName()
            ]);

            $dokumenDetail->save();

            return response()->json([
                'result' => 'success'
            ]);
        } else {
            return response()->json([
                'result' => 'error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadCreate(Request $request)
    {

        if ($request->file('file') !== null) {
            $file = $request->file('file');
            $userid = $request->input('user_id');
            $lastId = $request->input('lastId');
    
            // $filename = $file->getClientOriginalName();
            $filename = $file->hashName();
    
            $destinationPath = 'public/uploads'; // your desired destination path
    
            $filePath = $destinationPath . '/' . $userid . '/';
    
            $file->storeAs($filePath, $filename);

            $dokumenDetail = InputDokumenDetail::create([
                'input_dokumen_id'          => $lastId,
                'users_id'                  => $userid,
                'nama_file'                 => $filename
            ]);

            $dokumenDetail->save();
    
            return response()->json([
                'result' => 'success',
                // 'filename' => $lastId,
                // 'totalFiles' => $totalFiles
                ]);
        } else {
            return response()->json([
                'result' => 'error'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($userid, $filename)
    {
        // $filePath = 'public/documents/' . $filename; // Replace with the actual directory path

        $directory = 'public/uploads/';
        $subPath = $directory . '/' . $userid . '/';

        $filePath = $subPath . $filename; // Replace with the actual directory path

        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        }

        // Handle case when the file doesn't exist
        abort(404, 'File Tidak ditemukan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function previewPdf($userid, $filename)
    {
        $directory = 'storage/uploads/';
        $subPath = $directory . '/' . $userid . '/';

        $filePath = $subPath . $filename; // Replace with the actual directory path

        // Check if the file exists
        if (!file_exists($filePath)) {
            abort(404, 'The PDF file does not exist.');
        }

        // Set the appropriate content-type header
        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        return response()->file($filePath, $headers);
    }
}
