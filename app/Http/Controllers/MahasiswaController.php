<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Kelas;
use App\Models\Mahasiswa_MataKuliah;
use App\Models\MataKuliah;
use DB;
use PDF;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //fungsi eloquent menampilkan data menggunakan pagination
        //$mahasiswa = Mahasiswa::paginate(3);
        // Mengambil semua isi tabel 
        //$posts = Mahasiswa::orderBy('nim', 'desc')->paginate(6);
        //return view('mahasiswa.index', compact('mahasiswa'))->with('i', (request()->input('page', 1) - 1) * 5);
        //yang semula Mahasiswa::all, diubah menjadi with() yang menyatakan relasi
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('id_mahasiswa', 'asc')->paginate(3);
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa, 'paginate' => $paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all(); // mendapatkan data dari tabel kelas
        return view('mahasiswa.create',['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'foto' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'email' => 'required',
        ]);

        $mahasiswa = new Mahasiswa;
        $mahasiswa->nim = $request->get('nim');
        $mahasiswa->nama = $request->get('nama');
        $mahasiswa->foto = $request->file('foto')->store('images', 'public');
        $mahasiswa->jurusan = $request->get('jurusan');
        $mahasiswa->alamat = $request->get('alamat');
        $mahasiswa->tanggal_lahir = $request->get('tanggal_Lahir');
        $mahasiswa->email = $request->get('email');

        $kelas = Kelas::find($request->get('kelas'));
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->tanggal_lahir = $request->get('tanggal_lahir');
        $mahasiswa->save();

        //$kelas = new Kelas;
        //$kelas->id = $request->get('Kelas');
        //$idkelas = $request->get('Kelas');
        //$kelas = Kelas::find($idkelas);

        //fungsi untuk menambah data dengan relasi belongsTo
        //$mahasiswa->kelas()->associate($kelas);

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
        ->with('success', 'Mahasiswa Berhasil Ditambahkan');
        //fungsi eloquent untuk menambah data
        //Mahasiswa::create($request->all());
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        //return redirect()->route('mahasiswa.index')
           // ->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        $Mahasiswa = $mahasiswa;
        return view('mahasiswa.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswa.edit', compact('mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'foto' => 'required',
            'kelas' => 'required',
            'jurusan' => 'required',
            'alamat' => 'required',
            'tanggal_lahir' => 'required',
            'email' => 'required',
        ]);
        //fungsi eloquent untuk mengupdate data inputan kita
        //memanggil nama kolom dalam model mahasiswa yang sesuai dengan id mahasiswa yg di req
        //Mahasiswa::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->update($data);
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $mahasiswa->nim = $request->get('nim');
        $mahasiswa->nama = $request->get('nama');
        if ($mahasiswa->foto && file_exists(storage_path('app/public' . $mahasiswa->foto))) {
            Storage::delete('public/' . $mahasiswa->foto);
        }
        $image_name = $request->file('foto')->store('images', 'public');
        $mahasiswa->foto = $image_name;

        $mahasiswa->jurusan = $request->get('jurusan');
        $mahasiswa->alamat = $request->get('alamat');
        $mahasiswa->tanggal_lahir = $request->get('tanggal_lahir');
        $mahasiswa->email = $request->get('email');
        $kelas = Kelas::find($request->get('kelas'));
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::where('id_mahasiswa', $mahasiswa->id_mahasiswa)->delete();
        return redirect()->route('mahasiswa.index')
            ->with('success', 'Mahasiswa Berhasil Dihapus');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $mahasiswa = Mahasiswa::where('nama', 'like', "%" . $keyword . "%")->paginate(3);
        return view('mahasiswa.index',[
            'paginate' => $mahasiswa
        ]);
    }

    public function nilai($id)
    {
        $daftar = Mahasiswa_MataKuliah::with("matakuliah")->where("mahasiswa_id", $id)->get();
        $daftar->mahasiswa = Mahasiswa::with('kelas')->where('id_mahasiswa', $id)->first();
        return view('mahasiswa.nilai', compact('daftar'));
    }

    public function cetak_nilai($id)
    {
        $daftar = Mahasiswa_MataKuliah::with("matakuliah")->where("mahasiswa_id", $id)->get();
        $daftar->mahasiswa = Mahasiswa::with('kelas')->where("id_mahasiswa", $id)->first();
        $pdf = PDF::loadview('mahasiswa.cetak_pdf', compact('daftar'));
        return $pdf->stream();
    }

}