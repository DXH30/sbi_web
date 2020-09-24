<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
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
use App\Agenda;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
    //
    public function agenda($a = NULL, Request $request)
    {
        if ($a == 'c') {
            $validator = Validator::make($request->all(), [
                'id_rayon' => 'required',
                'wilayah' => 'required',
                'acara' => 'required',
                'waktu' => 'required',
                'tempat' => 'required',
                'contact_person' => 'required',
                'no_hp' => 'required'
            ]);
            $data_in = Agenda::firstOrNew(array('acara' => $request->acara));
            $data_in->id_rayon = $request->id_rayon;
            $data_in->wilayah = $request->wilayah;
            $data_in->acara = $request->acara;
            $data_in->waktu = $request->waktu;
            $data_in->tempat = $request->tempat;
            $data_in->contact_person = $request->contact_person;
            $data_in->no_hp = $request->no_hp;

            if ($validator->fails()) {
                return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
            } else {
                $data_in->save();
                return redirect()->back();
            }
        } elseif ($a == 'u') {
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'id_rayon' => 'required',
                'wilayah' => 'required',
                'acara' => 'required',
                'waktu' => 'required',
                'tempat' => 'required',
                'contact_person' => 'required',
                'no_hp' => 'required'
            ]);
            $data_in = Agenda::firstOrNew(array('id' => $request->id));
            $data_in->id_rayon = $request->id_rayon;
            $data_in->wilayah = $request->wilayah;
            $data_in->acara = $request->acara;
            $data_in->waktu = $request->waktu;
            $data_in->tempat = $request->tempat;
            $data_in->contact_person = $request->contact_person;
            $data_in->no_hp = $request->no_hp;
            if ($validator->fails()) {
                return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
            } else {
                $data_in->save();
                return redirect()->back();
            }
        } elseif ($a == 'd') {
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
            } else {
                Agenda::where('id', $request->id)->delete();
                return redirect()->back();
            }
        } else {
            $obj = [
                'rayon' => Rayon::get(),
                'agenda' => Agenda::get(),
                'asosiasi' => Asosiasi::get()
            ];
            return view('dashboard.agenda', $obj);
        }
    }

}
