<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import Model "Post
use App\Models\Alat;

//return type View
use Illuminate\View\View;

use App\Models\Pinjam;
use App\Models\User;
use App\Models\Datapinjam;
use App\Models\History;
use Illuminate\Http\RedirectResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Facades\DB;


class AlatController extends Controller
{
    public function index(): View
    {
        //get posts
        // $alats = Alat::orderBy('nama_alat', 'asc')->paginate(2);
        $alats = Alat::orderBy('nama_alat', 'asc')->get();

        //render view with posts
        return view('admin.index', compact('alats'));
    }

    public function create(): View
    {
        return view('admin.create');
    }
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,jpg,png',
            'nama_alat' => 'required|unique:alats,nama_alat',
            'jumlah' => 'required|numeric',
            'tempat' => 'required',
            'kategori' => 'nullable',
        ]);

        $namaAlat = $request->nama_alat;
        $existingAlat = Alat::where('nama_alat', $namaAlat)->first();
        if ($existingAlat) {
            return redirect()->back()->withErrors(['nama_alat' => 'Nama alat sudah tersedia.'])->withInput();
        }

        //upload image
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->hashName();
            $image->move(public_path("storage/gambar"), $image->hashName());
            // $image->storeAs('public/gambar', $image->hashName());
        } else {
            $imagePath = null;
        }

        //create
        Alat::create([
            'image' => $imagePath,
            'nama_alat' => $namaAlat,
            'jumlah' => $request->jumlah,
            'tempat' => $request->tempat,
            'kategori' => $request->kategori,
        ]);

        //redirect to index
        return redirect()->route('admin.index')->with(['success' => 'Data berhasil disimpan!']);
    }

    public function show(string $id): View
    {
        //get post by ID
        $alats = Alat::findOrFail($id);

        //render view with post
        return view('admin.show', compact('alats'));
    }

    public function edit(string $id): View
    {
        //get post by ID
        $alats = Alat::findOrFail($id);

        //render view with post
        return view('admin.edit', compact('alats'));
    }
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,jpg,png',
            'nama_alat' => 'required',
            'jumlah' => 'required|numeric',
            'tempat' => 'required',
            'kategori' => 'nullable'
        ]);

        //get post by ID
        $alats = Alat::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $nama_file = $image->hashName();
            $image->move(public_path("storage/gambar"), $nama_file);

            // dd(public_path("storage/gambar/") . $alats->image);

            //delete old image
            File::delete(public_path("storage/gambar/") . $alats->image);

            //update post with new image
            $alats->update([
                'image' => $nama_file,
                'nama_alat' => $request->nama_alat,
                'jumlah' => $request->jumlah,
                'tempat' => $request->tempat,
                'kategori' => $request->kategori
            ]);

        } else {

            //update post without image
            $alats->update([
                'nama_alat' => $request->nama_alat,
                'jumlah' => $request->jumlah,
                'tempat' => $request->tempat,
                'kategori' => $request->kategori
            ]);
        }

        //redirect to index
        return redirect()->route('admin.index')->with(['success' => 'Data berhasil diubah!']);
    }

    public function destroy($id): RedirectResponse
    {
        //get post by ID
        $alats = Alat::findOrFail($id);

        //delete image
        File::delete(public_path("storage/gambar/") . $alats->image);

        //delete post
        $alats->delete();

        //redirect to index
        return redirect()->route('admin.index')->with(['success' => 'Data berhasil dihapus!']);
    }

    public function login(Request $request)
    {
        # code...
        return view('admin.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);
        // Mengambil pengguna dengan nama pengguna yang cocok
        $user = User::where('name', $credentials['name'])->first();

        // Memeriksa apakah pengguna ditemukan dan password cocok
        if ($user && $user->password === $credentials['password']) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }
        return back()->with('loginError', 'Username atau Password salah!');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function daftar_pinjam(Request $request)
    {
        # code...
        $pinjams = Pinjam::orderByDesc('created_at')->get();

        return view('admin.daftar_pinjam', compact('pinjams'));
    }

    public function destroy2($id): RedirectResponse
    {
        //get post by ID
        $pinjams = Pinjam::findOrFail($id);

        //delete image
        File::delete(public_path("storage/gambar/") . $pinjams->image);

        //delete post
        $pinjams->delete();

        //redirect to index
        return redirect()->route('admin.daftar_pinjam')->with(['success' => 'Peminjaman ditolak!!']);
    }

    public function pinjaman(Request $request)
    {
        # code...
        $pinjams = Datapinjam::get();

        return view('admin.pinjaman', compact('pinjams'));
    }





    public function selesai(Request $request)
    {
        $id = $request->query('id');
        // Ambil data dari Tabel A berdasarkan pinjamId
        $dataA = Pinjam::find($id);

        $dataAlat = Alat::find($dataA->id_alat);

        if ($dataA) {
            // Hapus gambar dari direktori
            // File::delete(public_path("storage/gambar/") . $dataA->image);

            // Hapus data dari Tabel A
            $dataA->delete();

            // Insert data ke Tabel B
            Datapinjam::create([
                'nama' => $dataA->nama,
                'nim' => $dataA->nim,
                'kelas' => $dataA->kelas,
                'alat' => $dataAlat->nama_alat,
                'jumlah' => $dataA->jumlah,
                'id_alat' => $dataAlat->id,
                'email' => $dataA->email,
                'keperluan' => $dataA->keperluan,
                'image' => $dataA->image,
                // Sesuaikan kolom-kolom lain yang perlu diisi di Tabel B
            ]);

            $dataAlat->jumlah = intval($dataAlat->jumlah) - intval($dataA->jumlah);
            $dataAlat->save();

            return redirect('/daftar_pinjam')->with('success', 'Data berhasil diproses.');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    public function edit2(string $id): View
    {
        //get post by ID
        $alats = Datapinjam::findOrFail($id);

        //render view with post
        return view('admin.edit2', compact('alats'));
    }

    public function update2(Request $request, $id): RedirectResponse
    {

        $status = $request->input('status');
        //validate form
        $this->validate($request, [
            'keterangan' => 'nullable',
            'status' => 'nullable',
        ]);


        //get post by ID
        $alats = Datapinjam::findOrFail($id);

        //update post without image
        $alats->update([
            'keterangan' => $request->keterangan,
            'status' => $request->status,
        ]);


        //redirect to index
        return redirect()->route('admin.pinjaman')->with(['success' => 'Data berhasil diubah!']);
    }

    public function history(Request $request)
    {
        $id = $request->query('id');

        $dataA = Datapinjam::find($id);

        $dataAlat = Alat::find($dataA->id_alat);

        if ($dataA) {
            // Hapus gambar dari direktori
            File::delete(public_path("storage/gambar/") . $dataA->image);

            // Insert data ke Tabel B
            History::create([
                'nama' => $dataA->nama,
                'nim' => $dataA->nim,
                'kelas' => $dataA->kelas,
                'alat' => $dataA->alat,
                'id_alat' => $dataA->id_alat,
                'jumlah' => $dataA->jumlah,
                'email' => $dataA->email,
                'keterangan' => $dataA->keterangan,
                'keperluan' => $dataA->keperluan,
                'status' => $dataA->status,
                'awal_pinjaman' => $dataA->created_at,
                // Sesuaikan kolom-kolom lain yang perlu diisi di Tabel B
            ]);

            $dataAlat->jumlah = intval($dataAlat->jumlah) + intval($dataA->jumlah);
            $dataAlat->save();

            // Hapus data dari Tabel A
            $dataA->delete();

            return redirect('pinjaman')->with('success', 'Data berhasil diproses.');
        }

        return redirect()->back()->with('error', 'Data tidak ditemukan.');
    }

    public function akhir(Request $request)
    {
        $pinjams = History::get(); // Mengambil semua data dari tabel History

        // Mengambil tahun-tahun unik dari data created_at
        $years = $pinjams->pluck('created_at')->map(function ($createdAt) {
            return Carbon::parse($createdAt)->format('Y');
        })->unique();

        return view('admin.history', compact('pinjams', 'years'));
    }

    public function exportpdf(Request $request)
    {
        $id = $request->query('id');
        $history = History::find($id);

        $data1 = $history->nama;
        $data2 = $history->alat;
        $data3 = $history->nim;
        $data4 = $history->kelas;
        $data5 = $history->email;
        $data6 = $history->keterangan;
        $data7 = $history->keperluan;
        $data8 = $history->status;
        $data9 = $history->awal_pinjaman;
        $data10 = $history->created_at;
        $data11 = $history->jumlah;

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Data History</h1>
                       <p>Nama: ' . $data1 . '</p>
                       <p>Alat: ' . $data2 . '</p>
                       <p>Jml Alat: ' . $data11 . '</p>
                       <p>NIM: ' . $data3 . '</p>
                       <p>Kelas: ' . $data4 . '</p>
                       <p>Email: ' . $data5 . '</p>
                       <p>Keterangan: ' . $data6 . '</p>
                       <p>Keperluan: ' . $data7 . '</p>
                       <p>Status: ' . $data8 . '</p>
                       <p>Awal Peminjaman: ' . $data9 . '</p>
                       <p>Selesai Peminjaman: ' . $data10 . '</p>');

        return $pdf->download($data1 . '_' . $data3 . '_' . $data2 . '.pdf');

    }



}