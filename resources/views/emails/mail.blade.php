<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Actionable emails e.g. reset password</title>
    <link href="{{assets('styles.css')}}" media="all" rel="stylesheet" type="text/css" />
</head>

<body>

    <table class="body-wrap">
        <tr>
            <td></td>
            <td class="container" width="600">
                <div class="content">
                    <table class="main" width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="content-wrap">
                                <table cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>
                                            {{-- <img class="img-fluid" src="img/header.jpg" /> --}}
                                            <h1>SBI OCTOMODA</h1>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            <h3>Halo {{ $name }},</h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Selamat datang di Website SBI Octomoda, mohon konfirmasi alamat emailmu
                                            dengan mengklik tombol dibawah ini.
                                            Jika anda merasa tidak pernah melakukan registrasi di SBI Octomoda harap
                                            abaikan pesan ini.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block">
                                            Kami mungkin perlu mengirimkan Anda Informasi penting
                                            tentang layanan kami sehingga kami membutuhkan alamat email
                                            yang akurat.
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="content-block aligncenter">
                                        <a href="{{url(`/konfirmasi?id=$userid&token=$token`)}}" class="btn-primary">Konfirmasi email</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <div class="footer">
                        <table width="100%">
                            <tr>
                                <td class="aligncenter content-block">Oleh <a href="{{url('/')}}">SBI OCTOMODA</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </td>
            <td></td>
        </tr>
    </table>
</body>

</html>
