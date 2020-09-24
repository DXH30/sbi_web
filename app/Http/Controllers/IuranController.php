<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Middleware\CheckProfile;
use App\Http\Middleware\CheckToken;
use App\User;
use App\Group;
use App\Asosiasi;
use App\Noanggota;
use App\Provinsi;
use App\Kecamatan;
use App\Kabupaten;
use App\Kelurahan;
use App\Kendaraan;
use App\KetersediaanKendaraan;
use App\Perusahaan;
use App\Professional;
use App\JenisKendaraan;
use App\ModeTransportasi;
use App\Lokasi;
use App\KodePos;
use App\Bandara;
use App\Pelabuhan;
use App\Stasiun;
use App\Terminal;
use App\Rayon;
use App\DataRayon;
use App\Admin;
use App\Kategori;
use App\StatusKendaraan;
use Highlight\Mode;
use App\ConsulBarang;
use App\PortHandling;
use App\Konsolidator;
use App\RegulatedAgent;
use App\AirportWarehouse;
use App\Packing;
use App\AgentCargo;
use App\PortToPort;
use App\DoorToDoor;
use App\OrderTruckServices;
use App\Gudang;
use App\DaftarAsosiasi;
use App\Iuran;
use App\DataIuran;

class IuranController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke() {
        # Jika group_id = asosiasi maka tampilkan halaman input iuran untuk asosiasi
        # Jika group_id = perusahaan atau professional maka tampilkan input iuran
        $obj = [
            'asosiasi' => Asosiasi::get(),
            'rayon' => Rayon::get(),
            'data_rayon' => DataRayon::get(),
            'lokasi' => Lokasi::get(),
            'perusahaan' => Perusahaan::get(),
            'professional' => Professional::get(),
            'mode_transportasi' => ModeTransportasi::get(),
            'jenis_kendaraan' => JenisKendaraan::get(),
            'ketersediaan_kendaraan' => KetersediaanKendaraan::get(),
            'kendaraan' => Kendaraan::get(),
            'iuran' => Iuran::get()
        ];

        if (Auth::user()->group_id == 2) {
            $asos_id = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
            $obj['data_iuran'] = DataIuran::get();
            return view('dashboard.iuran_asosiasi', $obj);
        } else if (Auth::user()->group_id == 3 || Auth::user()->group_id == 4) {
            # Ambil semua asos_id dengan user id di tabel daftar asosiasi
            # Join kan dimana asos_id dengan iuran yang terdapat di asos_id tersebut
            # Join kan dengan tabel iuran
            $obj['daftar_asosiasi'] = DaftarAsosiasi::where('user_id', Auth::id())->get();
            $obj['iuran'] = Iuran::get();
            $obj['data_iuran'] = DataIuran::get();
            $obj['perusahaan'] = Perusahaan::where('user_id', Auth::id())->get();
            # Jika daftar_asosiasi-->asos_id == iuran->asos_id, maka tampilkan iuran->harga_perbulan, dan iuran harga_per_tahun

            return view('dashboard.iuran_perusahaan', $obj);
        }
    }

    public function hapus(Request $request) {
        $id = $request->id;
        Iuran::where(['id' => $id])->delete();
        return redirect()->back();
    }

    public function input(Request $request) {
        if (Auth::user()->group_id == 2) {
            $validator = Validator::make($request->all(), [
                'waktu_mulai' => 'required',
                'waktu_selesai' => 'required'
            ]);
            $data_in = new Iuran;
            $data_in->asos_id = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
            $data_in->waktu_mulai = $request->waktu_mulai;
            $data_in->waktu_selesai = $request->waktu_selesai;
            $data_in->harga_per_bulan = $request->harga_per_bulan;
            $data_in->harga_per_tahun = $request->harga_per_tahun;
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                $data_in->save();
                return redirect()->back();
            }
        } else if (Auth::user()->group_id == 3 || Auth::user()->group_id == 4) {
            $validator = Validator::make($request->all(), [
                'iuran_id' => 'required',
                'bukti_pembayaran' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $data_in = new DataIuran;
            $data_in->user_id = Auth::id();
            $data_in->iuran_id = $request->iuran_id;
            $filename = 'bukti_pembayaran_' . $data_in->iuran_id . '.' . $request->bukti_pembayaran->extension();
            $data_in->bukti_pembayaran = $filename;
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                $request->bukti_pembayaran->move(public_path('img/bukti_pombayaran'), $filename);
                $data_in->save();
                return redirect()->back();
            }
        }
    }

    public function konfirmasi(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_dataiuran' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        } else {
            DataIuran::where('id', $request->id_dataiuran)->update(['terkonfirmasi' => true]);
            return redirect()->back();
        }
    }

    public function unkonfirmasi(Request $request) {
        $validator = Validator::make($request->all(), [
            'id_dataiuran' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirect()->back()->withErrors($errors);
        } else {
            DataIuran::where('id', $request->id_dataiuran)->update(['terkonfirmasi' => false]);
            return redirect()->back();
        }
    }

}
