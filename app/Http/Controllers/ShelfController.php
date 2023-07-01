<?php

namespace App\Http\Controllers;

use App\Models\Shelf;
use Illuminate\Http\Request;

class ShelfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shelf = Shelf::latest()->when(request()->q, function ($shelf) {
            $shelf = $shelf->where('nama_rak', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.shelf.index', compact('shelf'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shelf.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'no_rak' => 'required',
            'nama_rak' => 'required',
            'jumlah_ambalan' => 'required',
        ]);

        $shelf = Shelf::create([
            'no_rak' => $request->no_rak,
            'nama_rak' => $request->nama_rak,
            'jumlah_ambalan' => $request->jumlah_ambalan,
            'keterangan' => $request->ket
        ]);

        if ($shelf) {
            return redirect()->route('admin.shelf.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            return redirect()->route('admin.shelf.index')->with(['error' => 'Data Gagal Disimpan!']);
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
    public function edit(Shelf $shelf)
    {
        return view('admin.shelf.edit', compact('shelf'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shelf $shelf)
    {
        $this->validate($request, [
            'no_rak'            => 'required', 
            'nama_rak'          => 'required', 
            'jumlah_ambalan'    => 'required'
        ]); 

        //save to DB
        $shelf->update([
            'no_rak'            => $request->no_rak,
            'nama_rak'          => $request->nama_rak,
            'jumlah_ambalan'    => $request->jumlah_ambalan,
            'keterangan'        => $request->ket
        ]);
 
        if($shelf){
             //redirect dengan pesan sukses
             return redirect()->route('admin.shelf.index')->with(['success' => 'Data Berhasil Diupdate!']);
         }else{
             //redirect dengan pesan error
             return redirect()->route('admin.shelf.index')->with(['error' => 'Data Gagal Diupdate!']);
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
        dd($id);
        $shelf = Shelf::findOrFail($id);
        $shelf->delete();

        if($shelf){
            return response()->json([
                'status' => 'success'
            ]);
        }else{
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
