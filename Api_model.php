<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->library('phpmailer_lib');
    } 

    public function checkLogin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $result = $this->db->where('email', $email)->get('users');

        if($result->num_rows() > 0)
        {
            $row = $result->row_array();
            $hash_password = $row['password'];

            if (password_verify($password, $hash_password)) {
                $tokenData = array();
                $tokenData['id'] = $row['id'];
                $tokenData['email'] = $row['email'];
                $token = AUTHORIZATION::generateToken($tokenData);
                header('Content-Type: application/json');
                echo json_encode(array('message' => 'Login Success', 'id_user' => $row['id'], 'email' => $row['email'], 'token' => $token, 'status' => TRUE, 'status_code' => 200));
                return TRUE;
            } else {
                header('Content-Type: application/json');
                echo json_encode(array('message' => 'Email Atau Password Anda Salah', 'status' => false,  'status_code' => 400));
                return TRUE;
            }
        }
        else
        {
            header('Content-Type: application/json');
            echo json_encode(array('message' => 'Email Atau Password Anda Salah', 'status' => false,  'status_code' => 400));
            return TRUE;
        }
    }

    public function registerUsers()
    {
        $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $cek_name = $this->db->where('name', $this->input->post('username'))->get('users');
        $cek_email = $this->db->where('email', $this->input->post('email'))->get('users');

        if($cek_name->num_rows() > 0 || $cek_email->num_rows() > 0)
        {
            header('Content-Type: application/json');
            echo json_encode(array('message' => 'Username Atau Email Anda Sudah Terdaftar', 'status' => false,  'status_code' => 400));
            $mail = $this->phpmailer_lib->load();
        }
        else
        {
            $data_users = array(
                'name'   => $this->input->post('username'),
                'email'      => $this->input->post('email'),
                'password'      => password_hash($this->input->post('password'), CRYPT_BLOWFISH),
                'group_id'      => $this->input->post('group_id'),
                'token'      => mt_rand(10000, 99999),
                'created_at' => $dt->format('Y-m-d H:i:s'),
            );

            $save = $this->db->insert('users', $data_users);

            if($save)
            {
                header('Content-Type: application/json');
                echo json_encode(array('message' => 'Sukses Register', 'user_id' => $this->db->insert_id(), 'email' => $this->input->post('email'), 'status' => true,  'status_code' => 200));
                $mail = $this->phpmailer_lib->load();
            } 
            else
            {
                return FALSE;
            }
        }
    }

    public function registerAsosiasi()
    {
        $image = $this->input->post('logo_asos');
        // $file_name = $this->input->post('file_name');
        $realImage = base64_decode($image);
        $filename = '/var/www/html/didik/sbi_web/public/img/profile/ass_'.$this->input->post('user_id').'.png';

        file_put_contents($filename, $realImage);

        $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $data = array(
            'nama'      => $this->input->post('nama_asos'),
            'kat_id'   => $this->input->post('kategori'),
            'email_asos'      => $this->input->post('email'),
            'alamat_kantor'      => $this->input->post('alamat'),
            'prov_id'      => $this->input->post('provinsi'),
            'kab_id'      => $this->input->post('kota'),
            'telp_kantor'      => $this->input->post('telepon_asos'),
            'website'      => $this->input->post('website'),
            'kode_pos'      => $this->input->post('kodepos'),
            'no_akta_notaris'      => $this->input->post('no_akte'),
            'npwp'      => $this->input->post('npwp'),
            'no_kemenkumham'      => $this->input->post('no_kemen'),
            'nama_wakil'      => $this->input->post('nama_notaris'),
            'jabatan'      => $this->input->post('jabatan'),
            'no_hp'      => $this->input->post('no_hp'),
            'logo_asosiasi'      => 'ass_'.$this->input->post('user_id').'.png',
            'user_id'      => $this->input->post('user_id'),
            'created_at' => $dt->format('Y-m-d H:i:s'),
        );

        $save = $this->db->insert('asosiasi', $data);
        $asos_id = $this->db->insert_id();

        if($save)
        {
            $iuran = array(
                'harga_per_bulan'      => $this->input->post('iuran'),
                'harga_per_tahun'      => $this->input->post('biaya_daftar'),
                'asos_id'     => $asos_id,
            );

            $save_iuran = $this->db->insert('iuran', $iuran);
            // $iuran_id = $this->db->insert_id();

            if($save_iuran)
            {
                header('Content-Type: application/json');
                echo json_encode(array('message' => 'Sukses Register Asosiasi', 'status' => true,  'status_code' => 200));
            }
            else
            {
                return FALSE;
            }
        } 
        else
        {
            return FALSE;
        }
    }

    public function registerPerusahaan()
    {
        $image = $this->input->post('logo_perus');
        // $file_name = $this->input->post('file_name');
        $realImage = base64_decode($image);
        $filename = '/var/www/html/didik/sbi_web/public/img/profile/perus_'.$this->input->post('user_id').'.png';

        file_put_contents($filename, $realImage);

        $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $data = array(
            'asos_id'      => $this->input->post('nama_asos'),
            'rayon_id'   => $this->input->post('rayon'),
            'nama'      => $this->input->post('nama_perus'),
            'email'      => $this->input->post('email'),
            'alamat'      => $this->input->post('alamat_kantor'),
            'prov_id'      => $this->input->post('provinsi'),
            'kab_id'      => $this->input->post('kota'),
            'telp'      => $this->input->post('telepon_kantor'),
            'website'      => $this->input->post('website'),
            'no_akta_notaris'      => $this->input->post('no_akte'),
            'npwp'      => $this->input->post('npwp'),
            'no_kemenkumham'      => $this->input->post('no_kemen'),
            'nik'      => $this->input->post('nik'),
            'nama_wakil'      => $this->input->post('nama_direktur'),
            'no_hp'      => $this->input->post('no_hp'),
            'nib'      => $this->input->post('nib'),
            'kode_kbli'      => $this->input->post('kode_kbli'),
            'nama_kbli'      => $this->input->post('nama_kbli'),
            'logo_perusahaan'      => 'perus_'.$this->input->post('user_id').'.png',
            'user_id'      => $this->input->post('user_id'),
            'created_at' => $dt->format('Y-m-d H:i:s'),
        );

        $save = $this->db->insert('perusahaan', $data);

        if($save)
        {
            header('Content-Type: application/json');
            echo json_encode(array('message' => 'Sukses Register Perusahaan', 'status' => true,  'status_code' => 200));
        } 
        else
        {
            return FALSE;
        }
    }

    public function registerProfessional()
    {
        $kk = $this->input->post('kk');
        $realImage_kk = base64_decode($kk);
        $filename_kk = '/var/www/html/didik/sbi_web/public/img/profile/kartu_keluarga_'.$this->input->post('user_id').'.pdf';
        file_put_contents($filename_kk, $realImage_kk);

        $surat_kel = $this->input->post('surat_kel');
        $realImage_surat_kel = base64_decode($surat_kel);
        $filename_surat_kel = '/var/www/html/didik/sbi_web/public/img/profile/surat_kelahiran_'.$this->input->post('user_id').'.pdf';
        file_put_contents($filename_surat_kel, $realImage_surat_kel);

        $foto_prof = $this->input->post('foto_prof');
        $realImage_foto_prof = base64_decode($foto_prof);
        $filename_foto_prof = '/var/www/html/didik/sbi_web/public/img/profile/foto_prof_'.$this->input->post('user_id').'.png';
        file_put_contents($filename_foto_prof, $realImage_foto_prof);

        $ktp = $this->input->post('ktp');
        $realImage_ktp = base64_decode($ktp);
        $filename_ktp = '/var/www/html/didik/sbi_web/public/img/profile/ktp_'.$this->input->post('user_id').'.png';
        file_put_contents($filename_ktp, $realImage_ktp);

        $dt = new DateTime("now", new DateTimeZone('Asia/Jakarta'));
        $data_prof = array(
            'asos_id'      => $this->input->post('nama_asos'),
            'rayon_id'   => $this->input->post('rayon'),
            'nama'      => $this->input->post('nama_prof'),
            'email'      => $this->input->post('email'),
            'keahlian'      => $this->input->post('keahlian'),
            'npwp'      => $this->input->post('npwp'),
            'tempat_lahir'      => $this->input->post('ttl'),
            'no_ktp'      => $this->input->post('noktp'),
            'alamat'      => $this->input->post('alamat'),
            'rtrw'      => $this->input->post('rt') . "-" . $this->input->post('rw'),
            'id_kel'      => $this->input->post('kelurahan'),
            'id_kec'      => $this->input->post('kecamatan'),
            'id_kab'      => $this->input->post('kota'),
            'id_prov'      => $this->input->post('provinsi'),
            'nama_perusahaan'      => $this->input->post('nama_perus'),
            'email_perusahaan'      => $this->input->post('email_perus'),
            'telepon'      => $this->input->post('telepon'),
            'file_kk'      => 'kartu_keluarga_'.$this->input->post('user_id').'.pdf',
            'file_ktp'      => 'surat_kelahiran_'.$this->input->post('user_id').'.pdf',
            'foto'      => 'foto_prof_'.$this->input->post('user_id').'.png',
            'foto_ktp'      => 'ktp_'.$this->input->post('user_id').'.png',
            'user_id'      => $this->input->post('user_id'),
            'created_at' => $dt->format('Y-m-d H:i:s'),
        );

        $save_prof = $this->db->insert('professional', $data_prof);

        if($save_prof)
        {
            header('Content-Type: application/json');
            echo json_encode(array('message' => 'Sukses Register Profesional', 'status' => true,  'status_code' => 200));
        } 
        else
        {
            return FALSE;
        }
    }

    public function getKategori()
    {
        $id = $this->input->post('id');
        if($id != '')
        {
            $this->db->where('id', $id);
        }

        return $this->db
            ->get('kategori')
            ->result();
    }

    public function getAsosiasi()
    {
        $id = $this->input->post('id');
        if($id != '')
        {
            $this->db->where('id', $id);
        }

        return $this->db
            ->select('distinct(nama) as name, id')
            ->get('asosiasi')
            ->result();
    }

    public function getProvinsi()
    {
        $id_prov = $this->input->post('id_prov');
        if($id_prov != '')
        {
            $this->db->where('id_prov', $id_prov);
        }

        return $this->db
            ->get('provinsi')
            ->result();
    }

    public function getKabupaten()
    {
        $id_prov = $this->input->post('id_prov');
        if($id_prov != '')
        {
            $this->db->where('id_prov', $id_prov);
        }

        return $this->db
            ->get('kabupaten')
            ->result();
    }

    public function getKecamatan()
    {
        $id_kab = $this->input->post('id_kab');
        if($id_kab != '')
        {
            $this->db->where('id_kab', $id_kab);
        }

        return $this->db
            ->get('kecamatan')
            ->result();
    }

    public function getKelurahan()
    {
        $id_kec = $this->input->post('id_kec');
        if($id_kec != '')
        {
            $this->db->where('id_kec', $id_kec);
        }

        return $this->db
            ->get('kelurahan')
            ->result();
    }

    public function getDataRayon()
    {
        $id_asos = $this->input->post('id_asos');
        if($id_asos != '')
        {
            $this->db->where('id_asos', $id_asos);
        }

        return $this->db
            ->join('rayon', 'data_rayon.id_rayon = rayon.id', 'left')
            ->get('data_rayon')
            ->result();
    }

    public function getConsulBarang()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('consul_barang')
            ->result();
    }

    public function getPortHandling()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('port_handling')
            ->result();
    }

    public function getKonsolidator()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('konsolidator')
            ->result();
    }

    public function getRegulatedAgent()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('regulated_agent')
            ->result();
    }

    public function getAirportWarehouse()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('airport_warehouse')
            ->result();
    }

    public function getPacking()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('packing')
            ->result();
    }

    public function getAgentCargo()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('agent_cargo')
            ->result();
    }

    public function getPortToPort()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('port_to_port')
            ->result();
    }

    public function getDoorToDoor()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('door_to_door')
            ->result();
    }

    public function getGudang()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('gudang')
            ->result();
    }

    public function getOrderTruckServices()
    {
        $user_id = $this->input->post('user_id');
        if($user_id != '')
        {
            $this->db->where('user_id', $user_id);
        }

        return $this->db
            ->get('order_truck_services')
            ->result();
    }


}

/* End of file Api_model.php */
/* Location: ./application/models/Api_model.php */
