<?php

namespace App\Http\Controllers;

use App\Models\UlasanBuku;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UlasanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //  public function index()
    //  {
    //      $ulasanbuku = UlasanBuku::with('user','buku')->orderBy('id','desc')->get();
    //      return view('ulasan_buku.index', compact('ulasan_buku'));
    //  }

    public function index()
    {
        $ulasanbuku = UlasanBuku::with('user','buku')->orderBy('id','desc')->get();
        return view('ulasan_buku.index', compact('ulasanbuku'));
    }


     public function input(Request $request)
     {
         return view("ulasan_buku.formInput");
     }


    // public function index()
    // {
    //     $ulasanbuku = UlasanBuku::all{};
    //     return view('ulasan_buku.index');
    // }

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
        UlasanBuku::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'ulasan' => $request->ulasan,
            'rating' => $request->rating,
        ]);

        return redirect()->route('ulasan_buku')->with('success', 'Data berhasil disimpan');
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
        $ulasanbuku = UlasanBuku::findorfail($id);
        return view('ulasan_buku.formEdit', compact('ulasanbuku'));
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
        $ulasanbuku = UlasanBuku::findorfail($id);
        $ulasanbuku->update($request->all());

        return redirect()->route('ulasan_buku')->with('success', 'Data berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ulasanbuku = UlasanBuku::findorfail($id);

        $ulasanbuku->delete();

        return redirect()->route('ulasan_buku')->with('success', 'Data berhasil dihapus');
    }
}
