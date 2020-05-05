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
use App\StatusKendaraan;
use Highlight\Mode;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke()
    {
        // $this->middleware(CheckToken::class);
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
            'kategori' => Kategori::get(),
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
                    'kat_id' => 'required',
                    'nama' => 'required',
                    'telp_kantor' => 'required',
                    'npwp' => 'required',
		    'alamat_kantor' => 'required',
		    'kab_id' => 'required',
		    'prov_id' => 'required',
		    'kode_pos' => 'required',
		    'website' => 'required',
		    'no_akta_notaris' => 'required',
		    'no_kemenkumham' => 'required',
		    'nama_wakil' => 'required',
		    'jabatan' => 'required',
                    'ketua_umum' => 'required',
                    'nik_ketum' => 'required',
                    'no_hp' => 'required',
                    'logo_asosiasi' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                ]);

                $data_in = Asosiasi::firstOrNew(array('user_id' => Auth::id()));
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

                if (isset(Asosiasi::get()->where('user_id', Auth::id())->first()['logo_asosiasi']))
                    $filename = Asosiasi::get()->where('user_id', Auth::id())->first()['logo_asosiasi'];
                else
                    $filename = 'ass_' . Auth::id() . "." . $request->logo_asosiasi->extension();
                $data_in->logo_asosiasi = $filename;

                $data_in->user_id = Auth::id();
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return redirect()->back()->withErrors($errors);
                } else {
                    $data_in->save();
                    if (isset($request->logo_asosiasi))
                        $request->logo_asosiasi->move(public_path('img/profile'), $filename);
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
                    'asos_id' => 'required',
                    'rayon_id' => 'required',
                    'logo_perusahaan' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
                $data_in->rayon_id = $request->rayon_id;
		
		if (isset(Perusahaan::get()->where('user_id', Auth::id())->first()['logo_perusahaan']))
                    $filename = Perusahaan::get()->where('user_id', Auth::id())->first()['logo_perusahaan'];
                else
                    $filename = 'perusahaan_' . Auth::id() . "." . $request->logo_perusahaan->extension();
                $data_in->logo_perusahaan = $filename;

                $data_in->user_id = Auth::id();
                if ($validator->fails()) {
                    $errors = $validator->errors();
                    return redirect()->back()->withErrors($errors);
                } else {
                    $data_in->save();
                    if (isset($request->logo_perusahaan))
                        $request->logo_perusahaan->move(public_path('img/profile'), $filename);
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
                    'id_kab' => 'required',
                    'id_prov' => 'required',
                    'kode_pos' => 'required',
                    'npwp' => 'required',
                    'tempat_lahir' => 'required',
                    'tanggal_lahir' => 'required',
                    'nik' => 'required',
                    'nama_perusahaan' => 'required',
                    'email_perusahaan' => 'required',
                    'asos_id' => 'required',
                    'rayon_id' => 'required'
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
                $data_in->rayon_id = $request->rayon_id;

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
                'rayon' => Rayon::get(),
                'asosiasi' => Asosiasi::get(),
                'perusahaan' => Perusahaan::get(),
                'professional' => Professional::get()
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
	if (isset($request->jn))
	    $jenis = $request->jn;
	else
	    $jenis = 0;
        if ($a == 'c') {
            // Untuk input jenis kendaraan (asosiasi)
            if (Auth::user()->group_id == 1) {
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

                $data_in = Kendaraan::firstOrNew(array('id' => $request->id));
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

                $filename =  Kendaraan::get()->count()+1 .".". $request->gambar->extension();

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

            // Untuk input ketersediaan kendaraan (perusahaan)
            // Untuk input ketersediaan kendaraan (profesional)
            if (Auth::user()->group_id == 3 || Auth::user()->group_id == 4) {
                $validator = Validator::make($request->all(), [
                    'id' => 'required',
                    'id_letter' => 'required',
                    'id_status' => 'required',
                    'jumlah' => 'required'
                ]);

                $data_in = new KetersediaanKendaraan();
                $data_in->id_kendaraan = $request->id;
                $data_in->id_user = Auth::id();
                $data_in->id_letter = $request->id_letter;
                $data_in->id_status = $request->id_status;
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
                'rayon' => Rayon::get(),
                'data_rayon' => DataRayon::get(),
                'lokasi' => Lokasi::get(),
		'status_kendaraan' => StatusKendaraan::get(),
		'ketersediaan_kendaraan' => KetersediaanKendaraan::get(),
		'mode_transportasi' => ModeTransportasi::get(),
		'asosiasi' => Asosiasi::get(),
                'perusahaan' => Perusahaan::get(),
                'professional' => Professional::get(),
		'kendaraan' => Kendaraan::get()->where('id_jenis', $jenis)

            ];
	    if (isset($jenis))
		$obj['kendaraan'] = Kendaraan::get()->where('id_jenis', $jenis);
	    
            return view('dashboard.kendaraan', $obj);
        }
    }

    public function keanggotaan($a = NULL, Request $request)
    {
        $this->middleware(CheckToken::class);
        if ($a == 'u') {
            $id = $request->input('id');
            $token = $request->input('token');
            $token_v = User::get()->where('id', $id)->first()['token'];
            if ($token == $token_v) {
                User::where('id', $id)->update(['verified' => 1]);
                return redirect()->route('dashboard');
            } else {
                return redirect()->back()->withErrors('Token salah!');
            }
        } else {
            $obj = [
                'user' => User::get(),
                'asosiasi' => Asosiasi::get(),
                'perusahaan' => Perusahaan::get(),
                'professional' => Professional::get()
            ];
            if (auth()->user()->group_id == 2) {
                $asos_id = Asosiasi::get()->where('user_id', auth()->user()->id)->first()['id'];
                $obj['perusahaan'] = Perusahaan::get()->where('asos_id', $asos_id);
                $obj['professional'] = Professional::get()->where('asos_id', $asos_id);
            }
            return view('dashboard.keanggotaan', $obj);
        }
    }
}
