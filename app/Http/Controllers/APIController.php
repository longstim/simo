<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;
use DateTime;
use DateInterval;
use DatePeriod;
use Notification;

class APIController extends Controller
{
    function loginAndroid(Request $request) 
    {

        setlocale(LC_ALL, 'IND');

        $logg = DB::table('users')->where('username', '=', $request->username)->first();

        if (!empty($logg) AND Hash::check($request->password, $logg->password)) 
        {
            $result["success"] = "1";
            $result["message"] = "success";
            
            //untuk memanggil data sesi Login
            $result["id"] = $logg->id;
            $result["nama"] = $logg->name;
            $result["nip"] = $logg->username;
            $result["email"] = $logg->email;

            $tanggal = date("Y-m-d");

            $hari_ini=getNamaHariIni();
            $tglHari_ini = date("d-m-Y");

            $result["tanggal"] = $hari_ini.", ".$tglHari_ini;

            $absen = DB::select('select username, Cast(waktu_login as Date) as "tanggal", MIN(waktu_login) as "waktu_masuk", MAX(waktu_login) as "waktu_pulang" from td_login_history where username = "'.$request->username.'" and Date(waktu_login)="'.$tanggal.'" group by username, Cast(waktu_login as Date)');

            $result["jammasuk"] = "-";
            $result["jampulang"] = "-";

            if(!empty($absen))
            {
                $timestampmasuk = strtotime($absen[0]->waktu_masuk);
                $timestamppulang = strtotime($absen[0]->waktu_pulang);

                $result["jammasuk"] = date("H:i", $timestampmasuk);
                $result["jampulang"] = date("H:i", $timestamppulang);
            }
   
            echo json_encode($result);
        } 
        else 
        {
           $result["success"] = "0";
           $result["message"] = "error";
           echo json_encode($result);
        }
    }

    function checkIN(Request $request) 
    {
        setlocale(LC_ALL, 'IND');
        
        $data = array(
          'username' => $request->username,
          'waktu_login' => Carbon::now()->toDateTimeString(),
        );

        $insertID = DB::table('td_login_history')->insertGetId($data);

        $tanggal = date("Y-m-d");

        $absen = DB::select('select username, Cast(waktu_login as Date) as "tanggal", MIN(waktu_login) as "waktu_masuk", MAX(waktu_login) as "waktu_pulang" from td_login_history where username = "'.$request->username.'" and Date(waktu_login)="'.$tanggal.'" group by username, Cast(waktu_login as Date)');

        $result["jammasuk"] = "-";
        $result["jampulang"] = "-";

        $hari_ini=getNamaHariIni();
        $tglHari_ini = date("d-m-Y");

        $result["tanggal"] = $hari_ini.", ".$tglHari_ini;

        if(!empty($absen))
        {
            $result["success"] = "1";
            $result["message"] = "success";

            $timestampmasuk = strtotime($absen[0]->waktu_masuk);
            $timestamppulang = strtotime($absen[0]->waktu_pulang);

            $result["jammasuk"] = date("H:i", $timestampmasuk);
            $result["jampulang"] = date("H:i", $timestamppulang);

            echo json_encode($result);
        }
        else 
        {
           $result["success"] = "0";
           $result["message"] = "error";
           echo json_encode($result);
        }
    }

    function getDataAwal(Request $request) 
    {
        setlocale(LC_ALL, 'IND');

        $tanggal = date("Y-m-d");

        $absen = DB::select('select username, Cast(waktu_login as Date) as "tanggal", MIN(waktu_login) as "waktu_masuk", MAX(waktu_login) as "waktu_pulang" from td_login_history where username = "'.$request->username.'" and Date(waktu_login)="'.$tanggal.'" group by username, Cast(waktu_login as Date)');

        $result["jammasuk"] = "-";
        $result["jampulang"] = "-";

        $hari_ini=getNamaHariIni();
        $tglHari_ini = date("d-m-Y");

        $result["tanggal"] = $hari_ini.", ".$tglHari_ini;

        if(!empty($absen))
        {
            $result["success"] = "1";
            $result["message"] = "success";

            $timestampmasuk = strtotime($absen[0]->waktu_masuk);
            $timestamppulang = strtotime($absen[0]->waktu_pulang);

            $result["jammasuk"] = date("H:i", $timestampmasuk);
            $result["jampulang"] = date("H:i", $timestamppulang);

            echo json_encode($result);
        }
        else 
        {
           $result["success"] = "0";
           $result["message"] = "error";
           echo json_encode($result);
        }
    }
}
