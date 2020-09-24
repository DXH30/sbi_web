<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Asosiasi;
use App\Perusahaan;
use App\Professional;
use App\Kendaraan;
use App\JenisKendaraan;
use App\ModeTransportasi;
use App\Lokasi;
use App\StatusKendaraan;
use App\KetersediaanKendaraan;
use App\DataRayon;
use App\Noanggota;
use App\User;
use App\Group;
use App\Provinsi;
use App\Kabupaten;
use App\Kecamatan;
use App\Kelurahan;
use App\Rayon;
use App\Kategori;

class EditController extends Controller
{
  public function edit_asosiasi(Request $request)
  {
    $id = $request->id;
    $obj = array(
      'status' => 2,
      'asosiasi' => Asosiasi::where('id', $id)->get(),
      'data_rayon' => DataRayon::get(),
      'noanggota' => Noanggota::get(),
      'provinsi' => Provinsi::get(),
      'kabupaten' => Kabupaten::get(),
      'kecamatan' => Kecamatan::get(),
      'kelurahan' => Kelurahan::get(),
      'rayon' => Rayon::get(),
      'kategori' => Kategori::get(),
    );
    return view('dashboard.edit', $obj);
  }

  public function submit_asosiasi(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);
    $id = $request->id;
    $data_in = Asosiasi::firstOrNew(array('id' => $id));
    $data_in->kat_id = $request->kat_id;
    $data_in->nama = $request->nama;
    $data_in->telp_kantor = $request->telp_kantor;
    $data_in->npwp = $request->npwp;
    $data_in->alamat_kantor = $request->alamat_kantor;
    $data_in->kab_id = $request->kab_id;
    $data_in->prov_id = $request->prov_id;
    $data_in->kode_pos = $request->kode_pos;
    $data_in->website = $request->website;
    $data_in->no_akta_notaris = $request->no_akta_notaris;
    $data_in->no_kemenkumham = $request->no_kemenkumham;
    $data_in->nama_wakil = $request->nama_wakil;
    $data_in->jabatan = $request->jabatan;
    $data_in->ketua_umum = $request->ketua_umum;
    $data_in->nik_ketum = $request->nik_ketum;
    $data_in->no_hp = $request->no_hp;

    if (isset(Asosiasi::get()->where('id', $id)->first()['logo_asosiasi']))
      $filename = Asosiasi::get()->where('id', $id)->first()['logo_asosiasi'];
    else
      $filename = 'ass_' . $id . "." . $request->logo_asosiasi->extension();
    $data_in->logo_asosiasi = $filename;
    if ($validator->fails()) {
      $errors = $validator->errors();
      return redirect()->back()->withErrors($errors);
    } else {
      $data_in->save();
      if (isset($request->logo_asosiasi))
        $request->logo_asosiasi->move(public_path('img/profile'), $filename);
      return redirect()->back();
    }
  }

  public function edit_perusahaan(Request $request)
  {
    $id = $request->id;
    $obj = array(
      'status' => 3,
      'asosiasi' => Asosiasi::get(),
      'perusahaan' => Perusahaan::where('id', $id)->get(),
      'data_rayon' => DataRayon::get(),
      'noanggota' => Noanggota::get(),
      'provinsi' => Provinsi::get(),
      'asosiasi_list' => Asosiasi::get(),
      'kabupaten' => Kabupaten::get(),
      'kecamatan' => Kecamatan::get(),
      'kelurahan' => Kelurahan::get(),
      'data_rayon' => DataRayon::get(),
      'rayon' => Rayon::get(),
      'kategori' => Kategori::get(),
    );
    return view('dashboard.edit', $obj);
  }

  public function submit_perusahaan(Request $request)
  {
    $id = $request->id;
    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);
    $data_in = Perusahaan::firstOrNew(array('id' => $id));
    $data_in->nama = $request->nama;
    $data_in->email = $request->email;
    $data_in->alamat = $request->alamat;
    $data_in->id_prov = $request->id_prov;
    $data_in->id_kab = $request->id_kab;
    $data_in->telp = $request->telp;
    $data_in->website = $request->website;
    $data_in->no_akta_notaris = $request->no_akta_notaris;
    $data_in->npwp = $request->npwp;
    $data_in->no_kemenkumham = $request->no_kemenkumham;
    $data_in->nik = $request->nik;
    $data_in->nama_wakil = $request->nama_wakil;
    $data_in->jabatan = $request->jabatan;
    $data_in->no_hp = $request->no_hp;
    $data_in->logo_perusahaan = 'perusahaan_' . $id . ".png";
    $data_in->asos_id = $request->asos_id;
    $data_in->rayon_id = $request->rayon_id;

    // Cek apakah file logo perusahaan di upload
    if ($request->hasFile('logo_perusahaan')) {
      // Cek apakah logo sudah ada jika ada samakan namanya
      if (isset(Perusahaan::get()->where('id', $id)->first()['logo_perusahaan'])) {
        $filename = Perusahaan::get()->where('id', $id)->first()['logo_perusahaan'];
      } else {
        $filename = 'perusahaan_' . $id . "." . $request->logo_perusahaan->extension();
      }
    } else {
      $filename = Perusahaan::get()->where('id', $id)->first()['logo_perusahaan'];
    }
    $data_in->logo_perusahaan = $filename;

    if ($validator->fails()) {
      $errors = $validator->errors();
      return redirect()->back()->withErrors($errors);
    } else {
      $data_in->save();
      if (isset($request->logo_perusahaan))
        $request->logo_perusahaan->move(public_path('img/profile'), $filename);
      return redirect()->back();
    }
  }

  public function edit_professional(Request $request)
  {
    $id = $request->id;
    $obj = array(
      'status' => 4,
      'asosiasi' => Asosiasi::get(),
      'professional' => Professional::where('id', $id)->get(),
      'perusahaan' => Perusahaan::where('id', $id)->get(),
      'data_rayon' => DataRayon::get(),
      'noanggota' => Noanggota::get(),
      'provinsi' => Provinsi::get(),
      'asosiasi_list' => Asosiasi::get(),
      'kabupaten' => Kabupaten::get(),
      'kecamatan' => Kecamatan::get(),
      'kelurahan' => Kelurahan::get(),
      'data_rayon' => DataRayon::get(),
      'rayon' => Rayon::get(),
      'kategori' => Kategori::get(),
    );
    return view('dashboard.edit', $obj);
  }

  public function submit_professional(Request $request)
  {
    $id = $request->id;
    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);
    $data_in = Professional::firstOrNew(array('id' => $id));
    $data_in->nama = $request->nama;
    $data_in->email = $request->email;
    $data_in->keahlian = $request->keahlian;
    $data_in->alamat = $request->alamat;
    $data_in->rtrw = $request->rtrw;
    $data_in->id_kel = $request->id_kel;
    $data_in->id_kec = $request->id_kec;
    $data_in->id_kab = $request->id_kab;
    $data_in->id_prov = $request->id_prov;
    $data_in->kode_pos = $request->kode_pos;
    $data_in->npwp = $request->npwp;
    $data_in->tempat_lahir = $request->tempat_lahir;
    $data_in->tanggal_lahir = $request->tanggal_lahir;
    $data_in->nik = $request->nik;
    $data_in->nama_perusahaan = $request->nama_perusahaan;
    $data_in->email_perusahaan = $request->email_perusahaan;
    $data_in->foto = 'professional_' . $id . ".png";
    $data_in->foto_ktp = 'professional_ktp_' . $id . ".png";
    $data_in->asos_id = $request->asos_id;
    $data_in->rayon_id = $request->rayon_id;

    if ($validator->fails()) {
      return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
    } else {
      $data_in->save();
      return redirect()->back();
    }
  }

  public function edit_kendaraan(Request $request)
  {
    $id = $request->id;
    $obj = [
      'jenis_kendaraan' => JenisKendaraan::get(),
      'rayon' => Rayon::get(),
      'data_rayon' => DataRayon::get(),
      'lokasi' => Lokasi::get(),
      'status_kendaraan' => StatusKendaraan::get(),
      'ketersediaan_kendaraan' => KetersediaanKendaraan::get(),
      'mode_transportasi' => ModeTransportasi::get(),
      'asosiasi' => Asosiasi::get(),
      'perusahaan' => Perusahaan::get(),
      'professional' => Professional::get(),
      'kendaraan' => Kendaraan::get()->where('id', $id),
      'kendaraanl' => Kendaraan::get(),
    ];
    if (isset($jenis))
      $obj['kendaraan'] = Kendaraan::get()->where('id_jenis', $jenis);

    return view('dashboard.kendaraan_edit', $obj);
  }

  public function submit_kendaraan(Request $request)
  {
    $id = $request->id;
    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);
    $validator = Validator::make($request->all(), [
      'no' => 'required',
      'merk' => 'required',
      'ukuran_karoseri_tp' => 'required',
      'ukuran_karoseri_p' => 'required',
      'ukuran_karoseri_l' => 'required',
      'ukuran_karoseri_t' => 'required',
      'ukuran_mobil_p' => 'required',
      'ukuran_mobil_l' => 'required',
      'ukuran_mobil_t' => 'required',
      'berat_kosong' => 'required',
      'berat_max' => 'required',
      'model_mesin' => 'required',
      'kap_silinder' => 'required',
      'kecepatan_max' => 'required',
      'tenaga_max' => 'required',
      'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'id_jenis' => 'required'
    ]);
    $data_in = Kendaraan::firstOrNew(array('id' => $id));
    $ukuran_karoseri = [
      'tipe' => $request->ukuran_karoseri_tp,
      'panjang' => $request->ukuran_karoseri_p,
      'lebar' => $request->ukuran_karoseri_l,
      'tinggi' => $request->ukuran_karoseri_t,
      'dalam' => $request->ukuran_karoseri_d,
    ];
    $ukuran_mobil = [
      'panjang' => $request->ukuran_mobil_p,
      'lebar' => $request->ukuran_mobil_l,
      'tinggi' => $request->ukuran_mobil_t,
    ];
    $data_in->deskripsi = json_encode([
      'deskripsi' => $request->deskripsi,
      'no' => $request->no,
      'merk' => $request->merk
    ]);
    $data_in->ukuran = json_encode([
      'ukuran_karoseri' => $ukuran_karoseri,
      'ukuran_mobil' => $ukuran_mobil
    ]);

    $data_in->berat = json_encode([
      'berat_kosong' => $request->berat_kosong,
      'berat_max' => $request->berat_max
    ]);

    $data_in->spesifikasi = json_encode([
      'model_mesin' => $request->model_mesin,
      'kap_silinder' => $request->kap_silinder,
      'kecepatan_max' => $request->kecepatan_max,
      'tenaga_max' => $request->tenaga_max,
    ]);

    // Cek apakaha file gambar kendaraan di upload
    if ($request->hasFile('gambar')) {
      // Cek apakah gambar kendaraan adan jika ada samakan namanya
      if (isset(Kendaraan::get()->where('id', $id)->first()['gambar'])) {
        $filename = Kendaraan::get()->where('id', $id)->first()['gambar'];
      } else {
        $filename = Kendaraan::get()->count() + 1 . "." . $request->gambar->extension();
      }
    } else {
      $filename = Kendaraan::get()->where('id', $id)->first()['gambar'];
    }

    $data_in->gambar = $filename;

    $data_in->id_jenis = $request->id_jenis;
    if ($validator->fails()) {
      return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
    } else {
      if (isset($request->gambar))
        $request->gambar->move(public_path('img/kendaraan'), $filename);
      #   dd($data_in->getAttributes());
      $data_in->save();
      return redirect()->back();
    }
  }
}
