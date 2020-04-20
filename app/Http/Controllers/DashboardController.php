<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Middleware\CheckProfile;
use App\User;
use App\Group;
use App\Asosiasi;
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
use App\Rayon;
use App\DataRayon;
use App\Admin;
use App\Kategori;
use Highlight\Mode;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckProfile::class);
    }

    public function __invoke()
    {
        $obj = array();
        if (Auth::user()->have_profile == 0) {
            return redirect()->route('profile');
        }

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
            'kendaraan' => Kendaraan::get()
        ];

        return view('dashboard.index', $obj);
    }

    public function profile($a = NULL, Request $request)
    {
        $id_asos = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
        $obj = [
            'group_id' => User::select('group_id')->where('id', auth()->user()->id),
            'group_name' => Group::select('name')->where('id', auth()->user()->group_id),
            'provinsi' => Provinsi::get(),
            'kabupaten' => Kabupaten::get(),
            'kecamatan' => Kecamatan::get(),
            'kelurahan' => Kelurahan::get(),
            'asosiasi_list' => Asosiasi::get(),
            'data_rayon' => DataRayon::get(),
            'rayon' => Rayon::get(),
        ];

        // $obj['data_rayon'] = DataRayon::where('id_asos', $id_asos)->get();

        switch (Auth::user()->group_id) {
            case 1:
                $obj['admin'] = Admin::where('user_id', Auth::id())->get();
                break;
            case 2:
                $obj['asosiasi'] = Asosiasi::where('user_id', Auth::id())->get();
                break;
            case 3:
                $obj['perusahaan'] = Perusahaan::where('user_id', Auth::id())->get();
                // $id_asos = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
                // $obj['data_rayon'] = DataRayon::where('id_asos', $id_asos)->get();
                break;
            case 4:
                $obj['professional'] = Professional::where('user_id', Auth::id())->get();
                // $id_asos = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
                // $obj['data_rayon'] = DataRayon::where('id_asos', $id_asos)->get();
                break;
        }

        if ($a == NULL) {
            return view('dashboard.profile', $obj);
        } else if ($a == 'c') {
            if (Auth::user()->group_id == 1) {
                $validator = Validator::make($request->all(), [
                    'nama' => 'required',
                    'no_telp' => 'required'
                ]);
                $data_in = Admin::firstOrNew(array('user_id' => Auth::id()));
                $data_in->nama = $request->nama;
                $data_in->no_telp = $request->no_telp;
                $data_in->user_id = Auth::id();
                if ($validator->fails()) {
                    return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
                } else {
                    $data_in->save();
                    User::where('id', Auth::id())->update(['have_profile' => 1]);
                    return redirect()->back();
                }
            } else if (Auth::user()->group_id == 2) {
                $validator = Validator::make($request->all(), [
                    'nama' => 'required',
                    'telp_kantor' => 'required',
                    'npwp' => 'required',
                    'ketua_umum' => 'required',
                    'nik_ketum' => 'required',
                    'no_hp' => 'required'
                ]);

                $data_in = Asosiasi::firstOrNew(array('user_id' => Auth::id()));
                $data_in->nama = $request->nama;
                $data_in->telp_kantor = $request->telp_kantor;
                $data_in->npwp = $request->npwp;
                $data_in->ketua_umum = $request->ketua_umum;
                $data_in->nik_ketum = $request->nik_ketum;
                $data_in->no_hp = $request->no_hp;
                $data_in->logo_asosiasi = 'asosiasi_' . Auth::id() . ".png";
                $data_in->user_id = Auth::id();
                if ($validator->fails()) {
                    return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
                } else {
                    $data_in->save();
                    User::where('id', Auth::id())->update(['have_profile' => 1]);
                    return redirect()->back();
                }
            } else if (Auth::user()->group_id == 3) {
                $validator = Validator::make($request->all(), [
                    'nama' => 'required',
                    'email' => 'required',
                    'alamat' => 'required',
                    'id_prov' => 'required',
                    'id_kab' => 'required',
                    'telp' => 'required',
                    'website' => 'required',
                    'no_akta_notaris' => 'required',
                    'npwp' => 'required',
                    'no_kemenkumham' => 'required',
                    'nik' => 'required',
                    'nama_wakil' => 'required',
                    'jabatan' => 'required',
                    'no_hp' => 'required',
                    'asos_id' => 'required'
                ]);

                $data_in = Perusahaan::firstOrNew(array('user_id' => Auth::id()));
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
                $data_in->logo_perusahaan = 'perusahaan_' . Auth::id() . ".png";
                $data_in->user_id = Auth::id();
                $data_in->asos_id = $request->asos_id;
                if ($validator->fails()) {
                    return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
                } else {
                    $data_in->save();
                    User::where('id', Auth::id())->update(['have_profile' => 1]);
                    return redirect()->back();
                }
            } else if (Auth::user()->group_id == 4) {
                $validator = Validator::make($request->all(), [
                    'nama' => 'required',
                    'email' => 'required',
                    'keahlian' => 'required',
                    'alamat' => 'required',
                    'rtrw' => 'required',
                    'id_kel' => 'required',
                    'id_kec' => 'required',
                    'id_kab' => 'required',
                    'id_prov' => 'required',
                    'kode_pos' => 'required',
                    'npwp' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'nik' => 'required',
                    'nama_perusahaan' => 'required',
                    'email_perusahaan' => 'required',
                    'asos_id' => 'required'
                ]);

                $data_in = Professional::firstOrNew(array('user_id' => Auth::id()));
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
                $data_in->foto = 'professional_' . Auth::id() . ".png";
                $data_in->foto_ktp = 'professional_ktp_' . Auth::id() . ".png";
                $data_in->user_id = Auth::id();
                $data_in->asos_id = $request->asos_id;

                if ($validator->fails()) {
                    return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
                } else {
                    $data_in->save();
                    User::where('id', Auth::id())->update(['have_profile' => 1]);
                    return redirect()->back();
                }
            }
        }
    }

    public function kategori($a = NULL, Request $request)
    {
        if ($a == 'c') {
            $validator = Validator::make($request->all(), [
                'nama' => 'required'
            ]);
            $data_in = Kategori::firstOrNew(array('nama' => $request->nama));
            if ($validator->fails()) {
                return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
            } else {
                $data_in->save();
                return redirect()->back();
            }
        } elseif ($a == 'u') {
            $validator = Validator::make($request->all(), [
                'nama' => 'required'
            ]);
            $data_in = Rayon::firstOrNew(array('id' => $request->id));
            if ($validator->fails()) {
                return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
            } else {
                $data_in->save();
                return redirect()->back();
            }
        } else {
            $obj = [
                'kategori' => Kategori::get()
            ];
            return view('dashboard.kategori', $obj);
        }
    }

    public function rayon($a = NULL, Request $request)
    {
        if ($a == 'c') {
            $validator = Validator::make($request->all(), [
                'nama' => 'required'
            ]);
            $data_in = Rayon::firstOrNew(array('nama' => $request->nama));
            if ($validator->fails()) {
                return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
            } else {
                $data_in->save();
                return redirect()->back();
            }
        } elseif ($a == 'u') {
            $validator = Validator::make($request->all(), [
                'nama' => 'required'
            ]);
            $data_in = Rayon::firstOrNew(array('id' => $request->id));
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
                Rayon::where('id', $request->id)->delete();
                return redirect()->back();
            }
        } else {
            $obj = [
                'rayon' => Rayon::get()
            ];
            return view('dashboard.rayon', $obj);
        }
    }

    public function data_rayon($a = NULL, Request $request)
    {
        if ($a == 'c') {
            $validator = Validator::make($request->all(), [
                'id_rayon' => 'required',
                'wilayah' => 'required'
            ]);
            $data_in = new DataRayon;
            $data_in->id_rayon = $request->id_rayon;
            $data_in->wilayah = $request->wilayah;
            $data_in->id_asos = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
            if ($validator->fails()) {
                return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
            } else {
                $data_in->save();
                return redirect()->back();
            }
        } elseif ($a == 'u') {
            $validator = Validator::make($request->all(), [
                'nama' => 'required'
            ]);
            $data_in = DataRayon::firstOrNew(array('id' => $request->id));
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
                DataRayon::where('id', $request->id)->delete();
                return redirect()->back();
            }
        } else {
            $obj = [
                'data_rayon' => DataRayon::get(),
                'rayon' => Rayon::get()
            ];
            return view('dashboard.data_rayon', $obj);
        }
    }

    public function lokasi($a = NULL, Request $request)
    {
        if ($a == 'c') {
            $validator = Validator::make($request->all(), [
                'lettercode' => 'required',
                'lokasi' => 'required'
            ]);
            $data_in = Lokasi::firstOrNew(array('lettercode' => $request->lettercode));
            $data_in->lokasi = $request->lokasi;

            if ($validator->fails()) {
                return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
            } else {
                $data_in->save();
                return redirect()->back();
            }
        } elseif ($a == 'u') {
            $validator = Validator::make($request->all(), [
                'code' => 'required'
            ]);
            $data_in = Lokasi::firstOrNew(array('id' => $request->id));

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
                Lokasi::where('id', $request->id)->delete();
                return redirect()->back();
            }
        } else {
            $obj = [
                'lokasi' => Lokasi::get()
            ];
            return view('dashboard.lokasi', $obj);
        }
    }

    public function mode_transportasi($a = NULL, Request $request)
    {
        if ($a == 'c') {
            $validator = Validator::make($request->all(), [
                'mode' => 'required'
            ]);
            $data_in = ModeTransportasi::firstOrNew(array('mode' => $request->mode));
            if ($validator->fails()) {
                return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
            } else {
                $data_in->save();
                return redirect()->back();
            }
        } elseif ($a == 'u') {
            $validator = Validator::make($request->all(), [
                'mode' => 'required'
            ]);
            $data_in = ModeTransportasi::firstOrNew(array('id' => $request->id));
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
                ModeTransportasi::where('id', $request->id)->delete();
                return redirect()->back();
            }
        } else {
            $obj = [
                'mode_transportasi' => ModeTransportasi::get()
            ];
            return view('dashboard.mode_transportasi', $obj);
        }
    }

    public function jenis_kendaraan($a = NULL, Request $request)
    {
        if ($a == 'c') {
            $validator = Validator($request->all(), [
                'jenis' => 'required',
                'mode_id' => 'required'
            ]);
            $data_in = new JenisKendaraan();
            $data_in->jenis = $request->jenis;
            $data_in->mode_id = $request->mode_id;
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
                JenisKendaraan::where('id', $request->id)->delete();
                return redirect()->back();
            }
        } else {
            $obj = [
                'jenis_kendaraan' => JenisKendaraan::get(),
                'mode_transportasi' => ModeTransportasi::get()
            ];
            return view('dashboard.jenis_kendaraan', $obj);
        }
    }

    public function kendaraan($a = NULL, Request $request)
    {
        if ($a == 'c') {
            // Untuk input jenis kendaraan (asosiasi)
            if (Auth::user()->group_id == 1) {
                $validator = Validator::make($request->all(), [
                    'no' => 'required',
                    'merk' => 'required',
                    'ukuran_karoseri' => 'required',
                    'ukuran_mobil' => 'required',
                    'berat_kosong' => 'required',
                    'berat_max' => 'required',
                    'model_mesin' => 'required',
                    'kap_silinder' => 'required',
                    'kecepatan_max' => 'required',
                    'tenaga_max' => 'required',
                    'gambar' => 'required',
                    'id_jenis' => 'required'
                ]);

                $data_in = Kendaraan::firstOrNew(array('id' => $request->id));
                $data_in->no = $request->no;
                $data_in->merk = $request->merk;
                $data_in->ukuran = json_encode([
                    'ukuran_karoseri' => $request->ukuran_karoseri,
                    'ukuran_mobil' => $request->ukuran_mobil
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

                $data_in->gambar = $request->gambar;
                $data_in->id_jenis = $request->id_jenis;
                if ($validator->fails()) {
                    return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
                } else {
                    $data_in->save();
                    return redirect()->back();
                }
            }

            // Untuk input ketersediaan kendaraan (perusahaan)
            // Untuk input ketersediaan kendaraan (profesional)
            if (Auth::user()->group_id == 3 || Auth::user()->group_id == 4) {
                $validator = Validator::make($request->all(), [
                    'id_kendaraan' => 'required',
                    'id_rayon' => 'required',
                    'id_letter' => 'required',
                    'jumlah'
                ]);
                $data_in = new KetersediaanKendaraan();
                $data_in->id_kendaraan = $request->id_kendaraan;
                $data_in->id_user = Auth::id();
                $data_in->id_rayon = $request->id_rayon;
                $data_in->id_letter = $request->id_letter;
                $data_in->jumlah = $request->jumlah;
                if ($validator->fails()) {
                    return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
                } else {
                    $data_in->save();
                    return redirect()->back();
                }
            }
        } elseif ($a == 'd') {
            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
            } else {
                if (Auth::user()->group_id == 1)
                    Kendaraan::where('id', $request->id)->delete();
                elseif (Auth::user()->group_id == 3 || Auth::user()->group_id == 4)
                    KetersediaanKendaraan::where('id', $request->id)->delete();
                return redirect()->back();
            }
        } else {
            $obj = [
                'jenis_kendaraan' => JenisKendaraan::get(),
                'kendaraan' => Kendaraan::get(),
                'rayon' => Rayon::get(),
                'lokasi' => Lokasi::get()
            ];
            return view('dashboard.kendaraan', $obj);
        }
    }
}
