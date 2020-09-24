<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Provinsi;
use App\Kecamatan;
use App\Kabupaten;
use App\Kelurahan;
use App\DataRayon;
use App\ConsulBarang;
use App\PortHandling;
use App\Konsolidator;
use App\RegulatedAgent;
use App\AirportWarehouse;
use App\Packing;
use App\AgentCargo;
use App\PortToPort;
use App\DoorToDoor;
use App\Gudang;
use App\OrderTruckServices;


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

    public function getDataRayon($id_asos = NULL) {
        if ($id_asos == NULL) {
          $data_rayon = DataRayon::get();
        } else {
            $data_rayon = DataRayon::select('data_rayon.*', 'rayon.nama')
                ->where(['id_asos' => $id_asos])
                                  ->leftJoin('rayon', 'data_rayon.id_rayon', '=', 'rayon.id')
                                  ->get();
        }
        return response()->json($data_rayon);
    }

    public function getConsulBarang($id_user = NULL) {
        if ($id_user == NULL) {
          $data_consul = ConsulBarang::get();
        } else {
          $data_consul = ConsulBarang::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_consul);
    }

    public function getPortHandling($id_user = NULL) {
        if ($id_user == NULL) {
          $data_port = PortHandling::get();
        } else {
          $data_port = PortHandling::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_port);
    }

    public function getKonsolidator($id_user = NULL) {
        if ($id_user == NULL) {
          $data_konsolidator = Konsolidator::get();
        } else {
          $data_konsolidator = Konsolidator::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_konsolidator);
    }

    public function getRegulatedAgent($id_user = NULL) {
        if ($id_user == NULL) {
          $data_regulated = RegulatedAgent::get();
        } else {
          $data_regulated = RegulatedAgent::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_regulated);
    }

    public function getAirportWarehouse($id_user = NULL) {
        if ($id_user == NULL) {
          $data_airport = AirportWarehouse::get();
        } else {
          $data_airport = AirportWarehouse::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_airport);
    }

    public function getPacking($id_user = NULL) {
        if ($id_user == NULL) {
          $data_packing = Packing::get();
        } else {
          $data_packing = Packing::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_packing);
    }

    public function getAgentCargo($id_user = NULL) {
        if ($id_user == NULL) {
          $data_agent = AgentCargo::get();
        } else {
          $data_agent = AgentCargo::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_agent);
    }

    public function getPortToPort($id_user = NULL) {
        if ($id_user == NULL) {
          $data_port = PortToPort::get();
        } else {
          $data_port = PortToPort::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_port);
    }

    public function getDoorToDoor($id_user = NULL) {
        if ($id_user == NULL) {
          $data_door = DoorToDoor::get();
        } else {
          $data_door = DoorToDoor::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_door);
    }

    public function getGudang($id_user = NULL) {
        if ($id_user == NULL) {
          $data_gudang = Gudang::get();
        } else {
          $data_gudang = Gudang::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_gudang);
    }
    
    public function getOrderTruckServices($id_user = NULL) {
        if ($id_user == NULL) {
          $data_truck = OrderTruckServices::get();
        } else {
          $data_truck = OrderTruckServices::where(['user_id' => $id_user])
                                    ->get();
        }
        return response()->json($data_truck);
    }
}
