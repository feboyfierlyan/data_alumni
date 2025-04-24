<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Education;
use App\Models\Job;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
  public function index(Request $request)
  {
    $query = Alumni::with(['education', 'jobs']);

    if ($request->filled('tahun_lulus')) {
      $query->whereHas('education', function ($q) use ($request) {
        $q->where('tahun_lulus', $request->tahun_lulus);
      });
    }

    $alumni = $query->latest()->paginate(10);
    return view('alumni.index', compact('alumni'));
  }

  public function create()
  {
    return view('alumni.create');
  }

  public function store(Request $request)
  {
    try {
      $request->validate([
        'nama' => 'required|string|max:255',
        'nim' => 'required|string|unique:alumnis,nim',
        'jenis_kelamin' => 'required|in:L,P',
        'tempat_lahir' => 'required|string|max:255',
        'tanggal_lahir' => 'required|date',
        'alamat' => 'required|string',
        'email' => 'required|email|unique:alumnis,email',
        'no_telepon' => 'required|string|max:20',
        'foto' => 'nullable|image|max:2048',
        'jurusan' => 'required|string|max:255',
        'fakultas' => 'required|string|max:255',
        'tahun_masuk' => 'required|digits:4',
        'tahun_lulus' => 'required|digits:4',
        'ipk' => 'required|string|max:4',
        'nama_perusahaan' => 'required|string|max:255',
        'jabatan' => 'required|string|max:255',
        'bidang' => 'required|string|max:255',
        'alamat_perusahaan' => 'required|string',
        'tahun_masuk_kerja' => 'required|digits:4'
      ]);

      if ($request->hasFile('foto')) {
        $foto = $request->file('foto')->store('alumni-photos', 'public');
      }

      $alumni = Alumni::create([
        'nama' => $request->nama,
        'nim' => $request->nim,
        'jenis_kelamin' => $request->jenis_kelamin,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'alamat' => $request->alamat,
        'email' => $request->email,
        'no_telepon' => $request->no_telepon,
        'foto' => $foto ?? null
      ]);

      Education::create([
        'alumni_id' => $alumni->id,
        'jurusan' => $request->jurusan,
        'fakultas' => $request->fakultas,
        'tahun_masuk' => $request->tahun_masuk,
        'tahun_lulus' => $request->tahun_lulus,
        'ipk' => $request->ipk
      ]);

      Job::create([
        'alumni_id' => $alumni->id,
        'nama_perusahaan' => $request->nama_perusahaan,
        'jabatan' => $request->jabatan,
        'bidang' => $request->bidang,
        'alamat_perusahaan' => $request->alamat_perusahaan,
        'tahun_masuk' => $request->tahun_masuk_kerja,
        'pekerjaan_saat_ini' => true
      ]);

      return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil ditambahkan');
    } catch (\Exception $e) {
      return back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage())->withInput();
    }
  }

  public function edit(Alumni $alumnus)
  {
    $alumnus->load(['education', 'jobs']);
    return view('alumni.edit', compact('alumnus'));
  }

  public function update(Request $request, Alumni $alumnus)
  {
    $request->validate([
      'nama' => 'required|string|max:255',
      'nim' => 'required|string|unique:alumnis,nim,' . $alumnus->id,
      'jenis_kelamin' => 'required|in:L,P',
      'tempat_lahir' => 'required|string|max:255',
      'tanggal_lahir' => 'required|date',
      'alamat' => 'required|string',
      'email' => 'required|email|unique:alumnis,email,' . $alumnus->id,
      'no_telepon' => 'required|string|max:20',
      'foto' => 'nullable|image|max:2048'
    ]);

    if ($request->hasFile('foto')) {
      $foto = $request->file('foto')->store('alumni-photos', 'public');
      $alumnus->foto = $foto;
    }

    $alumnus->update($request->except('foto'));

    return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil diperbarui');
  }

  public function destroy(Alumni $alumnus)
  {
    $alumnus->delete();
    return redirect()->route('alumni.index')->with('success', 'Data alumni berhasil dihapus');
  }

  public function show(Alumni $alumnus)
  {
    $alumnus->load(['education', 'jobs']);
    return view('alumni.show', compact('alumnus'));
  }
}
