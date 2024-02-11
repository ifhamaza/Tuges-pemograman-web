<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class mahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $katakunci = $request->katakunci;
        $jumlahbaris = 4;
        if (strlen($katakunci)) {
            $data = mahasiswa::where('matakuliah', 'like', "%$katakunci%")
                ->orWhere('namadosen', 'like', "%$katakunci%")
                ->orWhere('mengampu', 'like', "%$katakunci%")
                ->paginate($jumlahbaris);
        } else {
            $data = mahasiswa::orderBy('matakuliah', 'desc')->paginate($jumlahbaris);
        }
        return view('mahasiswa.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Session::flash('matakuliah', $request->matakuliah);
        Session::flash('namadosen', $request->namadosen);
        Session::flash('mengampu', $request->mengampu);

        $request->validate([
            'matakuliah' => 'required',
            'namadosen' => 'required',
            'mengampu' => 'required',
        ], [
            'matakuliah.required' => 'matakuliah wajib diisi',
            'matakuliah.unique' => 'matakuliah yang diisikan sudah ada dalam database',
            'namadosen.required' => 'Namadosen wajib diisi',
            'mengampu.required' => 'mengampu wajib diisi',
        ]);
        $data = [
            'matakuliah' => $request->matakuliah,
            'namadosen' => $request->namadosen,
            'mengampu' => $request->mengampu,
        ];
        mahasiswa::create($data);
        return redirect()->to('mahasiswa')->with('success', 'Berhasil menambahkan data');
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
        $data = mahasiswa::where('matakuliah', $id)->first();
        return view('mahasiswa.edit')->with('data', $data);
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
            'matakuliah' => 'required',
            'namadosen' => 'required',
        ], [
            'matakuliah.required' => 'matakuliah wajib diisi',
            'namadosen.required' => 'namadosen wajib diisi',
        ]);
        $data = [
            'matakuliah' => $request->matakuliah,
            'namadosen' => $request->namadosen,
        ];
        mahasiswa::where('matakuliah', $id)->update($data);
        return redirect()->to('mahasiswa')->with('success', 'Berhasil melakukan update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mahasiswa::where('matakuliah', $id)->delete();
        return redirect()->to('mahasiswa')->with('success', 'Berhasil melakukan delete data');
    }
}
