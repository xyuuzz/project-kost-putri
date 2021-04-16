<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Saving as ModelsSaving;

class Saving extends Controller
{
    public function __construct()
    {
        $this->table = new ModelsSaving();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $table = Auth::user()->savings();

        $T_pemasukan = $table->sum("pemasukan"); // pemasukan
        $T_pengeluaran = $table->sum("pengeluaran"); // pengeluaran
        $Table = $table->latest()->paginate(3); // dapatkan semua data

        return view("view.tabungan.tabungan", compact("Table", "T_pemasukan", "T_pengeluaran"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("view.tabungan.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $valid = !$request->pemasukan && !$request->pengeluaran ? 'pemasukan' : 'tanggal';
        $desk =  $valid == "pemasukan" ? "Salah Satu Kolom" : "Kolom Tanggal";

        $request->validate([
            'deskripsi' => 'required',
            $valid => 'required'
        ], [
            "deskripsi.required" => "Kolom Deskripsi Wajib diisi!!",
            "$valid.required" => "$desk Wajib diisi"
        ]);

        // Masukan ke dalam table
        Auth::user()->savings()->create([
            "pemasukan" => $request->pemasukan,
            "pengeluaran" => $request->pengeluaran,
            "deskripsi" => $request->deskripsi,
            "tanggal" => $request->tanggal
        ]);

        // beri alert/ pesan bahwa data berhasil dimasukan

        return redirect(route("saving.index"))->with("success", "Data berhasil dibuat!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->table::find($id);   
        return view("view.tabungan.edit", compact("data"));
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
        $valid = !$request->pemasukan && !$request->pengeluaran ? 'pemasukan' : 'tanggal';
        $desk = $valid == "pemasukan" ? "Salah Satu Kolom" : "Kolom Tanggal";

        $request->validate([
            'deskripsi' => 'required',
            $valid => 'required'
        ], [
            "deskripsi.required" => "Kolom Deskripsi Wajib diisi!!",
            "$valid.required" => "$desk Wajib diisi"
        ]);

        $this->table::find($id)->update([
            "pemasukan"  => $request->pemasukan,
            "pengeluaran" => $request->pengeluaran,
            "deskripsi" => $request->deskripsi,
            "tanggal" => $request->tanggal
        ]);

return redirect(route("saving.index"))->with("success", "Data Berhasil Di Update!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->table::find($id)->delete();
        return redirect(route("saving.index"))-> with("success", "Data berhasil Dihapus");
    }

}
