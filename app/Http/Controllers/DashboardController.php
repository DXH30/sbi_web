<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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

    return redirect()->route('keanggotaan');
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
    $obj = [
      'noanggota' => Noanggota::get(),
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
        if (Asosiasi::get()->where('user_id', Auth::id())->first() !== NULL) {
            $id_asos = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
        } else {
            $id_asos = 0;
        }
        $obj['asosiasi'] = Asosiasi::where('user_id', Auth::id())->get();
        break;
    case 3:
        if (Perusahaan::get()->where('user_id', Auth::id())->first() !== NULL) {
            $id_asos = Perusahaan::get()->where('user_id', Auth::id())->first()['asos_id'];
        } else {
            $id_asos = 0;
        }
        $obj['perusahaan'] = Perusahaan::where('user_id', Auth::id())->get();
        // $id_asos = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
        // $obj['data_rayon'] = DataRayon::where('id_asos', $id_asos)->get();
        break;
    case 4:
        if (Professional::get()->where('user_id', Auth::id())->first() !== NULL) {
            $id_asos = Professional::get()->where('user_id', Auth::id())->first()['asos_id'];
        } else {
            $id_asos = 0;
        }
        $obj['professional'] = Professional::where('user_id', Auth::id())->get();
        // $id_asos = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
        // $obj['data_rayon'] = DataRayon::where('id_asos', $id_asos)->get();
        break;
    case 6:
        $id_asos = DataRayon::get()->where('user_id', Auth::id())->first()['asos_id'];
        $obj['asosiasi'] = Asosiasi::where('id', $id_asos);
        $obj['data_rayon'] = DataRayon::get()->where('user_id', Auth::id())->first();
        $obj['user'] = User::get();
        $obj['rayon'] = Rayon::get();
        break;
    }

    if ($a == NULL) {
        return view('dashboard.profile', $obj);
    } elseif ($a == 'c') {
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
        } elseif (Auth::user()->group_id == 2) {
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
                'logo_asosiasi' => 'image|mimes:png,svg|max:2048',
                'file_akte' => 'mimetypes:application/pdf|max:20000',
                'file_npwp' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'file_kemen' => 'mimetypes:application/pdf|max:20000',
                'file_domisili' => 'mimetypes:application/pdf|max:20000',
                'file_ktp' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'file_struktur' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
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
            $data_in->nib = $request->nib;
            $data_in->kode_kbli = $request->kode_kbli;
            $data_in->nama_kbli = $request->nama_kbli;
            $data_in->no_kemenkumham = $request->no_kemenkumham;
            $data_in->nama_wakil = $request->nama_wakil;
            $data_in->jabatan = $request->jabatan;
            $data_in->ketua_umum = $request->ketua_umum;
            $data_in->nik_ketum = $request->nik_ketum;
            $data_in->no_hp = $request->no_hp;

            if (isset(Asosiasi::get()->where('user_id', Auth::id())->first()['logo_asosiasi']) && 
            Asosiasi::get()->where('user_id', Auth::id())->first()['logo_asosiasi'] !== "")
                $filename = Asosiasi::get()->where('user_id', Auth::id())->first()['logo_asosiasi'];
            elseif (null !== ($request->logo_asosiasi))
                $filename = 'ass_' . Auth::id() . "." . $request->logo_asosiasi->extension();
            else
                $filename = '';

            if (isset(Asosiasi::get()->where('user_id', Auth::id())->first()['file_akte']) &&
            Asosiasi::get()->where('user_id', Auth::id())->first()['file_akte'] !== "")
                $file_akte = Asosiasi::get()->where('user_id', Auth::id())->first()['file_akte'];
            elseif (null !== ($request->file_akte))
                $file_akte = 'file_akte_' . Auth::id() . "." . $request->file_akte->extension();
            else
                $file_akte = '';

            if (isset(Asosiasi::get()->where('user_id', Auth::id())->first()['file_npwp']) &&
            Asosiasi::get()->where('user_id', Auth::id())->first()['file_npwp'] !== "")
                $file_npwp = Asosiasi::get()->where('user_id', Auth::id())->first()['file_npwp'];
            elseif (null !== ($request->file_npwp))
                $file_npwp = 'file_npwp_' . Auth::id() . "." . $request->file_npwp->extension();
            else
                $file_npwp = '';

            if (isset(Asosiasi::get()->where('user_id', Auth::id())->first()['file_kemen']) &&
            Asosiasi::get()->where('user_id', Auth::id())->first()['file_kemen'] !== "")
                $file_kemen = Asosiasi::get()->where('user_id', Auth::id())->first()['file_kemen'];
            elseif (null !== ($request->file_kemen))
                $file_kemen = 'file_kemen_' . Auth::id() . "." . $request->file_kemen->extension();
            else
                $file_kemen = '';

            if (isset(Asosiasi::get()->where('user_id', Auth::id())->first()['file_domisili']) &&
            Asosiasi::get()->where('user_id', Auth::id())->first()['file_domisili'] !== "")
                $file_domisili = Asosiasi::get()->where('user_id', Auth::id())->first()['file_domisili'];
            elseif (null !== ($request->file_domisili))
                $file_domisili = 'file_domisili_' . Auth::id() . "." . $request->file_domisili->extension();
            else
                $file_domisili = '';

            if (isset(Asosiasi::get()->where('user_id', Auth::id())->first()['file_ktp']) &&
            Asosiasi::get()->where('user_id', Auth::id())->first()['file_ktp'] !== "")
                $file_ktp = Asosiasi::get()->where('user_id', Auth::id())->first()['file_ktp'];
            elseif (null !== ($request->file_ktp))
                $file_ktp = 'file_ktp_' . Auth::id() . "." . $request->file_ktp->extension();
            else
                $file_ktp = '';

            if (isset(Asosiasi::get()->where('user_id', Auth::id())->first()['file_struktur']) &&
            Asosiasi::get()->where('user_id', Auth::id())->first()['file_struktur'] !== "")
                $file_struktur = Asosiasi::get()->where('user_id', Auth::id())->first()['file_struktur'];
            elseif (null !== ($request->file_struktur))
                $file_struktur = 'file_struktur_' . Auth::id() . "." . $request->file_struktur->extension();
            else
                $file_struktur = '';

            $data_in->logo_asosiasi = $filename;
            $data_in->file_akte = $file_akte;
            $data_in->file_npwp = $file_npwp;
            $data_in->file_kemen = $file_kemen;
            $data_in->file_domisili = $file_domisili;
            $data_in->file_ktp = $file_ktp;
            $data_in->file_struktur = $file_struktur;

            $data_in->user_id = Auth::id();
            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                $data_in->save();
#                dd($filename);exit;

                if (isset($request->logo_asosiasi))
                    $request->logo_asosiasi->move(public_path('img/profile'), $filename);

                if (isset($request->file_akte))
                    $request->file_akte->move(public_path('img/profile'), $file_akte);

                if (isset($request->file_npwp))
                    $request->file_npwp->move(public_path('img/profile'), $file_npwp);

                if (isset($request->file_kemen))
                    $request->file_kemen->move(public_path('img/profile'), $file_kemen);

                if (isset($request->file_domisili))
                    $request->file_domisili->move(public_path('img/profile'), $file_domisili);

                if (isset($request->file_ktp))
                    $request->file_ktp->move(public_path('img/profile'), $file_ktp);

                if (isset($request->file_struktur))
                    $request->file_struktur->move(public_path('img/profile'), $file_struktur);

                User::where('id', Auth::id())->update(['have_profile' => 1]);
                Asosiasi::where('id', $data_in->id)->update(['noanggota' => 'A-'.$data_in->id]);
                return redirect()->back();
            }
        } elseif (Auth::user()->group_id == 3) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required',
                'alamat' => 'required',
                'prov_id' => 'required',
                'kab_id' => 'required',
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
            $data_in->prov_id = $request->prov_id;
            $data_in->kab_id = $request->kab_id;
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
            $data_in->asos_id = null;
            $data_in->rayon_id = null;
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
                Perusahaan::where('id', $data_in->id)->update(['noanggota' => 'PER-'.$data_in->asos_id.'-'.$data_in->id]);
                return redirect()->back();
            }
        } elseif (Auth::user()->group_id == 4) {
            $validator = Validator::make($request->all(), [
                'nama' => 'required',
                'email' => 'required',
                'keahlian' => 'required',
                'alamat' => 'required',
                'rtrw' => 'required',
                'kab_id' => 'required',
                'prov_id' => 'required',
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
            $data_in->kel_id = $request->kel_id;
            $data_in->kec_id = $request->kec_id;
            $data_in->kab_id = $request->kab_id;
            $data_in->prov_id = $request->prov_id;
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
            $id = Auth::id();

            # Fungsi untuk input file
            if (isset(Professional::get()->where('user_id', $id)->first()['foto']) && isset(Professional::get()->where('user_id', $id)->first()['foto_ktp'])){
                $filename = Professional::get()->where('user_id', $id)->first()['foto'];
                $filename_ktp = Professional::get()->where('user_id',  $id)->first()['foto_ktp'];
            } else {
                $filename = 'professional_' . $id . "." . $request->foto->extension();
                $filename_ktp = 'professionalktp_' . $id . "." . $request->foto_ktp->extension();
            }
            $data_in->foto = $filename;
            $data_in->foto_ktp = $filename_ktp;

            if ($validator->fails()) {
                $errors = $validator->errors();
                return redirect()->back()->withErrors($errors);
            } else {
                $data_in->save();
                if (isset($request->foto) && isset($request->foto_ktp)) {
                    $request->foto->move(public_path('img/profile'), $filename);
                    $request->foto_ktp->move(public_path('img/profile'), $filename_ktp);
                }
                User::where('id', Auth::id())->update(['have_profile' => 1]);
                Professional::where('id', $data_in->id)->update(['noanggota' => 'PER-'.$data_in->asos_id.'-'.$data_in->id]);
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
      } elseif ($a == 'd') {
          Kategori::where('id', $request->id)->delete();
          return redirect()->back();
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
          // Buat user untuk data rayon
          $id_asos = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
          $username = "$id_asos";
          if ($request->id_rayon == 1) {
              $username .= "dpp";
          } elseif ($request->id_rayon == 2) {
              $username .= "dpw";
          } elseif ($request->id_rayon == 3) {
              $username .= "dpc";
          } elseif ($request->id_rayon == 4) {
              $username .= "dpd";
          }
          $username .= "_".$request->wilayah;
          $username = strtolower($username);
          $username = str_replace(' ', '_', $username);
          // Buat password random dengan ketentuan 5 digit angka
          $password_default = strval(rand(9999, 99999));
          $password = Hash::make($password_default);
          $user_in = new User;
          $user_in->name = $username;
          $user_in->password = $password;
          $user_in->email = $username;
          $user_in->email_verified_at = date('Y-m-d H:i:s');
          $user_in->group_id = 6;
          $user_in->verified = 1;
          $user_in->have_profile = 1;
          $user_in->save();
          // Buat data_rayon
          $validator = Validator::make($request->all(), [
              'id_rayon' => 'required',
              'wilayah' => 'required'
          ]);
          $data_in = new DataRayon;
          $data_in->id_rayon = $request->id_rayon;
          $data_in->wilayah = $request->wilayah;
          $data_in->id_parent = $request->id_parent;
          $data_in->default_password = $password_default;
          $data_in->user_id = $user_in->id;
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
          // Ambil user_id dari id rayon
          $user_id = DataRayon::get()->where('id', $request->id)->first()['user_id'];
          // Hapus user dengan user_id dari data rayon

          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              User::where('id', $user_id)->delete();
              DataRayon::where('id', $request->id)->delete();
              return redirect()->back();
          }
      } else {
          $id_asos = Asosiasi::get()->where('user_id', Auth::id())->first()['id'];
          $obj = [
              'data_rayon' => DataRayon::where('id_asos', $id_asos)->get(),
                  'rayon' => Rayon::get(),
                  'asosiasi' => Asosiasi::get(),
                  'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'user' => User::get(),
              ];
              $obj['dpp'] = DataRayon::where(['id_rayon' => 1, 'id_asos' => $id_asos])->get();
              $obj['dpw'] = DataRayon::where(['id_rayon' => 2, 'id_asos' => $id_asos])->get();
              $obj['dpc'] = DataRayon::where(['id_rayon' => 3, 'id_asos' => $id_asos])->get();
              $obj['dpd'] = DataRayon::where(['id_rayon' => 4, 'id_asos' => $id_asos])->get();

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

  public function kode_pos($a = NULL, Request $request)
  {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'kode',
              'id_kec',
              'id_kel',
              'id_kab',
              'id_prov'
          ]);
          $data_in = KodePos::firstOrNew(array('kode' => $request->kode));
          $data_in->id_kec = $request->id_kec;
          $data_in->id_kel = $request->id_kel;
          $data_in->id_kab = $request->id_kab;
          $data_in->id_prov = $request->id_prov;

          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back();
          }
      } elseif ($a == 'u') {
          $validator = Validator::make($request->all(), [
              'kode' => 'required'
          ]);
          $data_in = KodePos::firstOrNew(array('id' => $request->id));

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
              KodePos::where('id', $request->id)->delete();
              return redirect()->back();
          }
      } else {
          $obj = [
              'kode_pos' => KodePos::get(),
                  'provinsi' => Provinsi::get(),
                  'kabupaten' => Kabupaten::get(),
                  'kecamatan' => Kecamatan::get(),
                  'kelurahan' => Kelurahan::get()
              ];
          return view('dashboard.kode_pos', $obj);
      }
  }

  public function bandara($a = NULL, Request $request)
  {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'kode',
              'nama',
              'id_kab',
              'id_prov',
              'status'
          ]);
          $data_in = Bandara::firstOrNew(array('kode' => $request->kode));
          $data_in->nama = $request->nama;
          $data_in->id_kab = $request->id_kab;
          $data_in->id_prov = $request->id_prov;
          $data_in->status = $request->status;

          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back();
          }
      } elseif ($a == 'u') {
          $validator = Validator::make($request->all(), [
              'kode' => 'required'
          ]);
          $data_in = Bandara::firstOrNew(array('id' => $request->id));

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
              Bandara::where('id', $request->id)->delete();
              return redirect()->back();
          }
      } else {
          $obj = [
              'bandara' => Bandara::get(),
                  'provinsi' => Provinsi::get(),
                  'kabupaten' => Kabupaten::get()
              ];
          return view('dashboard.bandara', $obj);
      }
  }

  public function pelabuhan($a = NULL, Request $request)
  {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'kode',
              'nama',
              'id_kab',
              'id_prov',
              'status'
          ]);
          $data_in = Pelabuhan::firstOrNew(array('kode' => $request->kode));
          $data_in->nama = $request->nama;
          $data_in->id_kab = $request->id_kab;
          $data_in->id_prov = $request->id_prov;
          $data_in->status = $request->status;

          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back();
          }
      } elseif ($a == 'u') {
          $validator = Validator::make($request->all(), [
              'kode' => 'required'
          ]);
          $data_in = Pelabuhan::firstOrNew(array('id' => $request->id));

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
              Pelabuhan::where('id', $request->id)->delete();
              return redirect()->back();
          }
      } else {
          $obj = [
              'pelabuhan' => Pelabuhan::get(),
                  'provinsi' => Provinsi::get(),
                  'kabupaten' => Kabupaten::get()
              ];
          return view('dashboard.pelabuhan', $obj);
      }
  }


  public function stasiun($a = NULL, Request $request)
  {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'kode',
              'nama',
              'id_kab',
              'id_prov',
              'status'
          ]);
          $data_in = Stasiun::firstOrNew(array('kode' => $request->kode));
          $data_in->nama = $request->nama;
          $data_in->id_kab = $request->id_kab;
          $data_in->id_prov = $request->id_prov;
          $data_in->status = $request->status;

          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back();
          }
      } elseif ($a == 'u') {
          $validator = Validator::make($request->all(), [
              'kode' => 'required'
          ]);
          $data_in = Stasiun::firstOrNew(array('id' => $request->id));

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
              Stasiun::where('id', $request->id)->delete();
              return redirect()->back();
          }
      } else {
          $obj = [
              'stasiun' => Stasiun::get(),
                  'provinsi' => Provinsi::get(),
                  'kabupaten' => Kabupaten::get()
              ];
          return view('dashboard.stasiun', $obj);
      }
  }

  public function terminal($a = NULL, Request $request)
  {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'kode',
              'nama',
              'id_kab',
              'id_prov',
              'status'
          ]);
          $data_in = Terminal::firstOrNew(array('kode' => $request->kode));
          $data_in->nama = $request->nama;
          $data_in->id_kab = $request->id_kab;
          $data_in->id_prov = $request->id_prov;
          $data_in->status = $request->status;

          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back();
          }
      } elseif ($a == 'u') {
          $validator = Validator::make($request->all(), [
              'kode' => 'required'
          ]);
          $data_in = Terminal::firstOrNew(array('id' => $request->id));

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
              Terminal::where('id', $request->id)->delete();
              return redirect()->back();
          }
      } else {
          $obj = [
              'terminal' => Terminal::get(),
                  'provinsi' => Provinsi::get(),
                  'kabupaten' => Kabupaten::get()
              ];
          return view('dashboard.terminal', $obj);
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

              if (isset(Kendaraan::get()->where('id', $request->id)->first()['gambar']))
                  $filename = Kendaraan::get()->where('id', $request->id)->first()['gambar'];
              else
                  $filename = $request->id.'.jpg';
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
                  #          'id_status' => 'required',
                  'jumlah' => 'required'
              ]);

              $data_in = new KetersediaanKendaraan();
              $data_in->id_kendaraan = $request->id;
              $data_in->id_user = Auth::id();
              $data_in->id_letter = $request->id_letter;
              #        $data_in->id_status = $request->id_status;
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
                  'kendaraan' => Kendaraan::get()->where('id_jenis', $jenis),
                  'kendaraanl' => Kendaraan::get(),
              ];
          if (isset($jenis))
              $obj['kendaraan'] = Kendaraan::get()->where('id_jenis', $jenis);

          if (!isset($_GET['mt'])) {
              return view('dashboard.kendaraan_pilih', $obj);
          } else {
              $obj['jenis_kendaraan'] = JenisKendaraan::get()->where('mode_id', $_GET['mt']);
              $obj['kendaraanl'] = Kendaraan::select(['kendaraan.*', 'jenis_kendaraan.mode_id'])
                  ->join('jenis_kendaraan', 'jenis_kendaraan.id', '=', 'kendaraan.id_jenis')
                  ->where('mode_id', $_GET['mt'])
                  ->get();
              $obj['mt'] = $_GET['mt'];
              $obj['kode_pos'] = KodePos::get();
              // 1 darat, 2 laut, 3 api, 4 udara
              if ($_GET['mt'] == 1) {
                  $obj['terminal'] = Terminal::get();
              } else if ($_GET['mt'] == 2) {
                  $obj['pelabuhan'] = Pelabuhan::get();
              } else if ($_GET['mt'] == 4) {
                  $obj['stasiun'] = Stasiun::get();
              } else if ($_GET['mt'] == 3) {
                  $obj['bandara'] = Bandara::Get();
              }
              return view('dashboard.kendaraan', $obj);
          }
      }
  }

  public function generate_nomor_anggota($a = NULL, Request $request)
  {
      if ($a == NULL) {
          $nomor = uniqid();
          $data_in = Noanggota::firstOrNew(array(
              'nomor' => $nomor,
          ));
          $data_in->save();
      } elseif ($a == 'd') {
          $id = $request->input('id');
          Noanggota::where('id', $id)->delete();
      }
      return redirect()->back();
  }

  public function keanggotaan($a = NULL, Request $request)
  {
      $this->middleware(CheckToken::class);
      if ($a == 'u') {
          $id = $request->input('id');
          $token = $request->input('token');
          $token_v = User::get()->where('id', $id)->first()['token'];

          if ($token == $token_v) {
              return redirect()->back()->withErrors('Token salah!');
          } else {
              User::where('id', $id)->update(['verified' => 1]);
              return redirect()->route('dashboard');
          }
      } elseif ($a == 'd') {
          $id = $request->input('id');
          try {
              User::where('id', $id)->delete();
          } catch (QueryException $e) {
              return redirect()->back()->with('message', 'Data user yang anda hapus sedang digunakan');
          }
          return redirect()->back();
      } else {
          $obj = [
              'user' => User::get(),
                  'asosiasi' => Asosiasi::get(),
                  'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'noanggota' => Noanggota::get()
              ];
          if (auth()->user()->group_id == 2) {
              $asos_id = Asosiasi::get()->where('user_id', auth()->user()->id)->first()['id'];
              $obj['noanggota'] = Noanggota::get();
              $obj['perusahaan'] = Perusahaan::get()->where('asos_id', $asos_id);
              # Mengambil list
              $obj['dpp'] = DataRayon::where(['id_rayon' => 1, 'id_asos' => $asos_id])->get();
              $obj['dpw'] = DataRayon::where(['id_rayon' => 2, 'id_asos' => $asos_id])->get();
              $obj['dpc'] = DataRayon::where(['id_rayon' => 3, 'id_asos' => $asos_id])->get();
              $obj['dpd'] = DataRayon::where(['id_rayon' => 4, 'id_asos' => $asos_id])->get();
              $obj['professional'] = Professional::get()->where('asos_id', $asos_id);
          }
          if (auth()->user()->group_id == 6) {
              $asos_id = DataRayon::get()->where('user_id', auth()->user()->id)->first()['id_asos'];
              $rayon_id = DataRayon::get()->where('user_id', auth()->user()->id)->first()['id'];
              $jenis_rayon = DataRayon::get()->where('user_id', auth()->user()->id)->first()['id_rayon'];
              if ($jenis_rayon == 1) {
                  $ids = array();
                  $dpw = DataRayon::get()->where('id_parent', $rayon_id);
                  foreach ($dpw as $id_dpw) {
                      array_push($ids, $id_dpw['id']);
                      $dpc = DataRayon::get()->where('id_parent', $id_dpw['id']);
                      foreach ($dpc as $id_dpc) {
                          array_push($ids, $id_dpc['id']);
                          $dpd = DataRayon::get()->where('id_parent', $id_dpc['id']);
                          foreach ($dpd as $id_dpd) {
                              array_push($ids, $id_dpd['id']);
                          }
                      }
                  }
                 # dd($ids);exit;
              } elseif ($jenis_rayon == 2) {
                  $ids = array();
                  $dpc = DataRayon::get()->where('id_parent', $rayon_id);
                  foreach ($dpc as $id_dpc) {
                      array_push($ids, $id_dpc['id']);
                      $dpd = DataRayon::get()->where('id_parent', $id_dpd['id']);
                      foreach ($dpd as $id_dpd) {
                          array_push($ids, $id_dpd['id']);
                      }
                  }
              } elseif ($jenis_rayon == 3) {
                  $ids = array();
                  $dpd = DataRayon::get()->where('id_parent', $rayon_id);
                  foreach ($dpd as $id_dpd) {
                      array_push($ids, $id_dpd['id']);
                  }
              } elseif ($jenis_rayon == 4) {
                  $ids = array();
                  $dpd = DataRayon::get()->where('id', $rayon_id);
                  array_push($ids, $dpd->first()['id']); 
              } else {
                  $ids = array();
              }
              $obj['asosiasi'] = Asosiasi::get();
              $obj['perusahaan'] = Perusahaan::get()->where('rayon_id', $rayon_id);
              $obj['professional'] = Professional::get()->where('rayon_id', $rayon_id);
              # Menggabungkan semua yang ada di sub perusahaan dan professional
              foreach($ids as $id) {
                  $perusahaan = Perusahaan::get()->where('rayon_id', $id);
                  foreach ($perusahaan as $p) {
                      $obj['perusahaan']->push($p);
                  }
                  $professional = Professional::get()->where('rayon_id', $id);
                  foreach ($professional as $p) {
                      $obj['professional']->push($p);
                  }
              }
          } 
          return view('dashboard.keanggotaan', $obj);
      }
  }

  public function consul_barang($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'asal_kota_id' => 'required',
              'tujuan_kota_id' => 'required',
              'type_truck_id' => 'required',
              'sisa_load' => 'required',
              'tanggal' => 'required',
              'jenis_barang' => 'required'
          ]);
          $data_in = new ConsulBarang;
          $data_in->user_id = Auth::id();
          $data_in->asal_kota_id = $request->asal_kota_id;
          $data_in->tujuan_kota_id = $request->tujuan_kota_id;
          $data_in->type_truck_id = $request->type_truck_id;
          $data_in->sisa_load = $request->sisa_load;
          $data_in->tanggal = $request->tanggal;
          $data_in->jenis_barang = $request->jenis_barang;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }
      } else if ($a == 'd') {
          $id = $request->id;
          ConsulBarang::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'consul_barang' => ConsulBarang::where('user_id', Auth::id())->get(),
                  'type_truck' => DB::table('ketersediaan_kendaraan')
                  ->join('kendaraan', 'ketersediaan_kendaraan.id_kendaraan', '=', 'kendaraan.id')
                  ->select('ketersediaan_kendaraan.id', 'kendaraan.deskripsi')
                  ->get()
              ];
          return view('dashboard.darat.consul_barang',$obj);
      }
  }

  public function port_handling($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'kab_id' => 'required',
              'kel_id' => 'required',
              'kode_pos' => 'required',
              'bandara' => 'required',
              'minimal_kg' => 'required',
              'estimasi_hari' => 'required',
              'harga_kg' => 'required'
          ]);
          $data_in = new PortHandling;
          $data_in->user_id = Auth::id();
          $data_in->kab_id = $request->kab_id;
          $data_in->kel_id = $request->kel_id;
          $data_in->kec_id = $request->kec_id;
          $data_in->kode_pos = $request->kode_pos;
          $data_in->bandara = $request->bandara;
          $data_in->minimal_kg = $request->minimal_kg;
          $data_in->estimasi_hari = $request->estimasi_hari;
          $data_in->harga_kg = $request->harga_kg;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }
      } else if ($a == 'd') {
          $id = $request->id;
          PortHandling::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'port_handling' => PortHandling::where('user_id', Auth::id())->get()
              ];
          return view('dashboard.darat.port_handling', $obj);
      }
  }

  public function konsolidator($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'bandara' => 'required',
              'harga_kg' => 'required',
              'alamat' => 'required',
              'kab_id' => 'required',
              'kec_id' => 'required',
              'kode_pos' => 'required',
              'contact_person' => 'required',
              'no_hp' => 'required'
          ]);
          $data_in = new Konsolidator;
          $data_in->user_id = Auth::id();
          $data_in->bandara = $request->bandara;
          $data_in->harga_kg = $request->harga_kg;
          $data_in->alamat = $request->alamat;
          $data_in->kab_id = $request->kab_id;
          $data_in->kel_id = $request->kel_id;
          $data_in->kec_id = $request->kec_id;
          $data_in->kode_pos = $request->kode_pos;
          $data_in->contact_person = $request->contact_person;
          $data_in->no_hp = $request->no_hp;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }

      } else if ($a == 'd') {
          $id = $request->id;
          Konsolidator::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'konsolidator' => Konsolidator::where('user_id', Auth::id())->get()
              ];
          return view('dashboard.darat.konsolidator', $obj);
      }
  }

  public function regulated_agent($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'bandara' => 'required',
              'harga_kg' => 'required',
              'administrasi' => 'required',
              'kab_id' => 'required',
              'kec_id' => 'required',
              'kel_id' => 'required',
              'kode_pos' => 'required',
              'contact_person' => 'required',
              'no_hp' => 'required'
          ]);
          $data_in = new RegulatedAgent;
          $data_in->user_id = Auth::id();
          $data_in->bandara = $request->bandara;
          $data_in->alamat = $request->alamat;
          $data_in->harga_kg = $request->harga_kg;
          $data_in->administrasi = $request->administrasi;
          $data_in->kab_id = $request->kab_id;
          $data_in->kec_id = $request->kec_id;
          $data_in->kel_id = $request->kel_id;
          $data_in->kode_pos = $request->kode_pos;
          $data_in->contact_person = $request->contact_person;
          $data_in->no_hp = $request->no_hp;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }
      } else if ($a == 'd') {
          $id = $request->id;
          RegulatedAgent::where('id', $id)->delete();
          return redirect()->back();
      } else {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'regulated_agent' => RegulatedAgent::where('user_id', Auth::id())->get()
              ];
          return view('dashboard.darat.regulated_agent', $obj);
      }
  }

  public function airport_warehouse($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'bandara' => 'required',
              'harga_kg' => 'required',
              'administrasi' => 'required',
              'kab_id' => 'required',
              'kec_id' => 'required',
              'kel_id' => 'required',
              'kode_pos' => 'required',
              'contact_person' => 'required',
              'no_hp' => 'required'
          ]);
          $data_in = new AirportWarehouse;
          $data_in->user_id = Auth::id();
          $data_in->bandara = $request->bandara;
          $data_in->alamat = $request->alamat;
          $data_in->harga_kg = $request->harga_kg;
          $data_in->administrasi = $request->administrasi;
          $data_in->kab_id = $request->kab_id;
          $data_in->kec_id = $request->kec_id;
          $data_in->kel_id = $request->kel_id;
          $data_in->kode_pos = $request->kode_pos;
          $data_in->contact_person = $request->contact_person;
          $data_in->no_hp = $request->no_hp;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }
      } else if ($a == 'd') {
          $id = $request->id;
          AirportWarehouse::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'airport_warehouse' => AirportWarehouse::where('user_id', Auth::id())->get()
              ];
          return view('dashboard.darat.airport_warehouse', $obj);
      }
  }

  public function packing($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'bandara' => 'required',
              'airwaybill' => 'required',
              'administrasi' => 'required',
              'dus_rapping' => 'required',
              'kayu_dus_rapping' => 'required',
              'alamat' => 'required',
              'kab_id' => 'required',
              'contact_person' => 'required',
              'no_hp' => 'required'
          ]);
          $data_in = new Packing;
          $data_in->user_id = Auth::id();
          $data_in->bandara = $request->bandara;
          $data_in->airwaybill = $request->airwaybill;
          $data_in->administrasi = $request->administrasi;
          $data_in->dus_rapping = $request->dus_rapping;
          $data_in->kayu_dus_rapping = $request->kayu_dus_rapping;
          $data_in->alamat = $request->alamat;
          $data_in->kab_id = $request->kab_id;
          $data_in->contact_person = $request->contact_person;
          $data_in->no_hp = $request->no_hp;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }
      } else if ($a == 'd') {
          $id = $request->id;
          Packing::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'packing' => Packing::where('user_id', Auth::id())->get()
              ];
          return view('dashboard.darat.packing', $obj);
      }
  }

  public function agent_cargo($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'bandara' => 'required',
              'asal_kota_id' => 'required',
              'tujuan_kota_id' => 'required',
              'rate_scheme' => 'required',
              'commodity' => 'required',
              'commodity_code' => 'required',
              'charge_kg' => 'required',
              'other_charge' => 'required'
          ]);
          $data_in = new AgentCargo;
          $data_in->user_id = Auth::id();
          $data_in->bandara = $request->bandara;
          $data_in->asal_kota_id = $request->asal_kota_id;
          $data_in->tujuan_kota_id = $request->tujuan_kota_id;
          $data_in->rate_scheme = $request->rate_scheme;
          $data_in->commodity = $request->commodity;
          $data_in->commodity_code = $request->commodity_code;
          $data_in->charge_kg = $request->charge_kg;
          $data_in->other_charge = $request->other_charge;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }
      } else if ($a == 'd') {
          $id = $request->id;
          AgentCargo::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'agent_cargo' => AgentCargo::where('user_id', Auth::id())->get()
              ];
          return view('dashboard.darat.agent_cargo', $obj);
      }
  }

  public function port_to_port($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'bandara' => 'required',
              'asal_kota_id' => 'required',
              'tujuan_kota_id' => 'required',
              'rate_scheme' => 'required',
              'commodity' => 'required',
              'commodity_code' => 'required',
              'charge_kg' => 'required',
              'other_charge' => 'required',
              'admin_charge' => 'required',
              'handle_charge' => 'required'
          ]);
          $data_in = new PortToPort;
          $data_in->user_id = Auth::id();
          $data_in->bandara = $request->bandara;
          $data_in->asal_kota_id = $request->asal_kota_id;
          $data_in->tujuan_kota_id = $request->tujuan_kota_id;
          $data_in->rate_scheme = $request->rate_scheme;
          $data_in->commodity = $request->commodity;
          $data_in->commodity_code = $request->commodity_code;
          $data_in->charge_kg = $request->charge_kg;
          $data_in->other_charge = $request->other_charge;
          $data_in->admin_charge = $request->admin_charge;
          $data_in->handle_charge = $request->handle_charge;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }
      } else if ($a == 'd') {
          $id = $request->id;
          PortToPort::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'port_to_port' => PortToPort::where('user_id', Auth::id())->get()
              ];
          return view('dashboard.darat.port_to_port',$obj);
      }
  }

  public function door_to_door($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'asal_kota_id' => 'required',
              'tujuan_kota_id' => 'required',
              'harga' => 'required',
              'administrasi' => 'required',
              'minimal' => 'required',
              'jenis_barang' => 'required'
          ]);
          $data_in = new DoorToDoor;
          $data_in->user_id = Auth::id();
          $data_in->asal_kota_id = $request->asal_kota_id;
          $data_in->tujuan_kota_id = $request->tujuan_kota_id;
          $data_in->harga = $request->harga;
          $data_in->administrasi = $request->administrasi;
          $data_in->minimal = $request->minimal;
          $data_in->jenis_barang = $request->jenis_barang;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }

      } else if ($a == 'd') {
          $id = $request->id;
          DoorToDoor::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'door_to_door' => DoorToDoor::where('user_id', Auth::id())->get()
              ];
          return view('dashboard.darat.door_to_door', $obj);
      }
  }

  public function order_truck_services($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'pickup_location' => 'required',
              'destination' => 'required',
              'type_truck_id' => 'required',
              'load_date' => 'required',
              'unloading_date' => 'required',
              'total_units' => 'required',
              'estimated_total_weight' => 'required',
              'type_of_goods' => 'required'
          ]);
          $data_in = new OrderTruckServices;
          $data_in->user_id = Auth::id();
          $data_in->pickup_location = $request->pickup_location;
          $data_in->destination = $request->destination;
          $data_in->type_truck_id = $request->type_truck_id;
          $data_in->load_date = $request->load_date;
          $data_in->unloading_date = $request->unloading_date;
          $data_in->total_units = $request->total_units;
          $data_in->estimated_total_weight = $request->estimated_total_weight;
          $data_in->type_of_goods = $request->type_of_goods;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }

      } else if ($a == 'd') {
          $id = $request->id;
          OrderTruckServices::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'order_truck_services' => OrderTruckServices::where('user_id', Auth::id())->get()
              ];
          return view('dashboard.darat.order_truck_services', $obj);
      }
  }

  public function gudang($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'alamat' => 'required',
              'kel_id' => 'required',
              'kec_id' => 'required',
              'kab_id' => 'required',
              'kode_pos' => 'required',
              'jenis' => 'required',
              'deskripsi' => 'required',
              'fasilitas' => 'required',
              'size_pallet' => 'required'
          ]);
          # echo json_encode($request->all(),true);exit;
          $data_in = new Gudang;
          $data_in->user_id = Auth::id();
          $data_in->alamat = $request->alamat;
          $data_in->kel_id = $request->kel_id;
          $data_in->kec_id = $request->kec_id;
          $data_in->kab_id = $request->kab_id;
          $data_in->kode_pos = $request->kode_pos;
          $data_in->jenis = $request->jenis;
          $data_in->deskripsi = $request->deskripsi;
          $data_in->kapasitas = json_encode(array(
              'kap_max_cbm' => $request->kap_max_cbm,
              'kap_sisa_cbm' => $request->kap_sisa_cbm,
              'kap_max_pallet' => $request->kap_max_pallet,
              'kap_sisa_pallet' => $request->kap_sisa_pallet
          ), true);
          $data_in->fasilitas = json_encode($request->fasilitas);
          $data_in->sewa = json_encode(array(
              's_cbm_h' => $request->s_cbm_h,
              's_cbm_b' => $request->s_cbm_b,
              's_cbm_t' => $request->s_cbm_t,
              's_pal_h' => $request->s_pal_h,
              's_pal_b' => $request->s_pal_b,
              's_pal_t' => $request->s_pal_t
          ), true);
          $data_in->size_pallet = $request->size_pallet;
          if (isset(Gudang::get()->where('user_id', Auth::id())->first()['foto_gudang']))
              $filename = Gudang::get()->where('user_id', Auth::id())->first()['foto_gudang'];
          else
              $filename = 'gudang_' . Auth::id() . "." . $request->foto_gudang->extension();
          $data_in->foto_gudang = $filename;

          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              if (isset($request->foto_gudang))
                  $request->foto_gudang->move(public_path('img/'), $filename);
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }
      } else if ($a == 'd') {
          $id = $request->id;
          Gudang::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'gudang' => Gudang::where('user_id', Auth::id())->get()
              ];
          return view('dashboard.darat.gudang', $obj);
      }
  }

  public function kendaraan_darat() {
      $obj = [
          'asosiasi' => Asosiasi::get(),
              'perusahaan' => Perusahaan::get(),
              'professional' => Professional::get(),
              'rayon' => Rayon::get(),
              'data_rayon' => DataRayon::get(),
              'lokasi' => Lokasi::get(),
              'mode_transportasi' => ModeTransportasi::get(),
              'jenis_kendaraan' => JenisKendaraan::get(),
              'ketersediaan_kendaraan' => KetersediaanKendaraan::get(),
              'kendaraan' => Kendaraan::get()
          ];
      return view('dashboard.kendaraan_darat', $obj);
  }

  public function kendaraan_udara() {
      $obj = [
          'asosiasi' => Asosiasi::get(),
              'perusahaan' => Perusahaan::get(),
              'professional' => Professional::get(),
              'rayon' => Rayon::get(),
              'data_rayon' => DataRayon::get(),
              'lokasi' => Lokasi::get(),
              'mode_transportasi' => ModeTransportasi::get(),
              'jenis_kendaraan' => JenisKendaraan::get(),
              'ketersediaan_kendaraan' => KetersediaanKendaraan::get(),
              'kendaraan' => Kendaraan::get()
          ];
      return view('dashboard.kendaraan_udara', $obj);
  }

  public function daftar_asosiasi($a = NULL, Request $request) {
      if ($a == 'c') {
          $validator = Validator::make($request->all(), [
              'asos_id' => 'required'
          ]);
          $data_in = new DaftarAsosiasi;
          $data_in->user_id = Auth::id();
          $data_in->asos_id = $request->asos_id;
          if ($validator->fails()) {
              return redirect()->back()->withErrors(["Mohon lengkapi data terlebih dahulu"]);
          } else {
              $data_in->save();
              return redirect()->back()->withErrors(["Berhasil input data"]);
          }
      } else if ($a == 'd') {
          $id = $request->id;
          DaftarAsosiasi::where('id', $id)->delete();
          return redirect()->back();
      } else if ($a == NULL) {
          $obj = [
              'perusahaan' => Perusahaan::get(),
                  'professional' => Professional::get(),
                  'daftar_asosiasi' => DaftarAsosiasi::where('user_id', Auth::id())->get(),
                  'asosiasi_list' => Asosiasi::get(),
              ];
          return view('dashboard.daftar_asosiasi', $obj);
      }
  }
}
