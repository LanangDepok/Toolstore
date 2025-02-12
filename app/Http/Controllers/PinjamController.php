<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alat;
use App\Models\datapinjam;
use App\Models\History;
use App\Models\Pinjam;
use Carbon\Carbon;

use Illuminate\View\View;

use Illuminate\Http\RedirectResponse;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

class PinjamController extends Controller
{
    public function index(): View
    {
        //get posts
        // $alats = Alat::orderBy('nama_alat', 'asc')->paginate(2);
        $alats = Alat::All();

        //render view with posts
        return view('mahasiswa.pinjam', compact('alats'));
    }

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|numeric',
            'kelas' => 'required',
            'email' => 'required|email',
            // 'alat' => 'required',
            'jumlah' => 'required|numeric',
            'keperluan' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png|max:10240',
        ]);

        //upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->hashName();
            $image->move(public_path("storage/gambar"), $image->hashName());
            // $image->storeAs('public/gambar', $image->hashName());
        } else {
            $imagePath = null;
        }
        $dataAlat = Alat::find($request->alat);
        //create
        Pinjam::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'kelas' => $request->kelas,
            'email' => $request->email,
            'alat' => $dataAlat->nama_alat,
            'id_alat' => $dataAlat->id,
            'jumlah' => $request->jumlah,
            'tempat' => $dataAlat->tempat,
            'keperluan' => $request->keperluan,
            'image' => $imagePath,
        ]);

        //redirect to index
        return redirect()->route('mahasiswa.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    public function show(string $id): View
    {
        //get post by ID
        $pinjams = Pinjam::findOrFail($id);

        //render view with post
        return view('mahasiswa.show', compact('pinjams'));
    }

    public function show2(string $id): View
    {
        //get post by ID
        $pinjams = Datapinjam::findOrFail($id);

        //render view with post
        return view('mahasiswa.show2', compact('pinjams'));
    }

    public function show3(string $id): View
    {
        //get post by ID
        $pinjams = History::findOrFail($id);

        //render view with post
        return view('mahasiswa.show3', compact('pinjams'));
    }

    public function landing(): View
    {
        return view('mahasiswa.landing');
    }

    public function akhir(Request $request)
    {
        $pinjams = History::get(); // Mengambil semua data dari tabel History

        // Mengambil tahun-tahun unik dari data created_at
        $years = $pinjams->pluck('created_at')->map(function ($createdAt) {
            return Carbon::parse($createdAt)->format('Y');
        })->unique();

        return view('mahasiswa.history', compact('pinjams', 'years'));
    }


}