<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Provinsi;
use App\Kecamatan;
use App\Kabupaten;
use App\Kelurahan;

class ApiController extends Controller
{
    public function __invoke(Request $request)
    {
        $response = [
            'success' => true,
            'message' => "Selamat datang di API SBi"
        ];
        return response()->json($response, 200);
    }

    public function getUsers(Request $request)
    {
        // $user = User::where('id', $request->input('id'))->get();
        $user = User::get();
        return response()->json($user, 200);
    }

    public function registerUsers(Request $request)
    {
        return 1;
    }

    public function getProvinsi($id_prov = NULL)
    {
        if ($id_prov == NULL)
            $provinsi = Provinsi::get();
        else
            $provinsi = Provinsi::where('id_prov', $id_prov)->get();
        return response()->json($provinsi);
    }

    public function getKabupaten($id_prov = NULL)
    {
        if ($id_prov == NULL)
            $kabupaten = Kabupaten::get();
        else
            $kabupaten = Kabupaten::where('id_prov', $id_prov)->get();
        return response()->json($kabupaten);
    }

    public function getKecamatan($id_kab = NULL, $id_kec = NULL)
    {
        if ($id_kab == NULL)
            $kecamatan = Kecamatan::get();
        else {
            if ($id_kec == NULL)
                $kecamatan = Kecamatan::where('id_kab', $id_kab)->get();
            else
                $kecamatan = Kecamatan::where(['id_kab' => $id_kab, 'id_kec' => $id_kec])->get();
        }
        return response()->json($kecamatan);
    }

    public function getKelurahan($id_kec = NULL, $id_kel = NULL)
    {
        if ($id_kec == NULL)
            $kelurahan = Kelurahan::get();
        else {
            if ($id_kel == NULL)
                $kelurahan = Kelurahan::where('id_kec', $id_kec)->get();
            else
                $kelurahan = Kelurahan::where(['id_kec' => $id_kec, 'id_kel' => $id_kel])->get();
        }
        return response()->json($kelurahan);
    }
}
