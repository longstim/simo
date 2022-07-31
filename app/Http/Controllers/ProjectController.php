<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DateTime;
use DB;
Use Redirect;
use Auth;
use File;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function daftarproject()
    {
        $project=DB::table('td_project_header')
                  ->leftjoin('md_perusahaan', 'td_project_header.id_perusahaan', '=', 'md_perusahaan.id')
                  ->select('td_project_header.*', 'md_perusahaan.nama_perusahaan')
                  ->orderBy('id', 'desc')
                  ->get();

        return view('pages.project.daftar_project', compact('project'));

    }

    public function projectpersonil()
    {
        $project=DB::table('td_project_detail')
                  ->leftjoin('td_project_header', 'td_project_detail.id_project', '=', 'td_project_header.id')
                  ->leftjoin('md_perusahaan', 'td_project_header.id_perusahaan', '=', 'md_perusahaan.id')
                  ->leftjoin('md_pegawai', 'td_project_detail.id_pegawai', '=', 'md_pegawai.id')
                  ->leftjoin('td_jabatan_pegawai', 'md_pegawai.id', '=', 'td_jabatan_pegawai.id_pegawai')
                  ->leftjoin('md_jabatan', 'td_jabatan_pegawai.id_jabatan', '=', 'md_jabatan.id')
                  ->leftjoin('md_jenjang_jabatan', 'td_jabatan_pegawai.id_jenjang_jabatan', '=', 'md_jenjang_jabatan.id')
                  ->leftjoin('td_pendidikan_pegawai', 'md_pegawai.id', '=', 'td_pendidikan_pegawai.id_pegawai')
                  ->select('td_project_header.*', 'md_perusahaan.nama_perusahaan', 'md_pegawai.nama AS nama_pegawai', 'md_pegawai.nip AS nip', 'md_jabatan.jabatan AS jabatan', 'md_jenjang_jabatan.jenjang_jabatan AS jenjang_jabatan', 'td_pendidikan_pegawai.tingkat AS tingkat_pendidikan', 'td_pendidikan_pegawai.jurusan AS jurusan')
                  ->orderBy('id', 'desc')
                  ->get();

        $newProject=array();

        foreach($project as $key => $data)
        {
            $newProject[$key]=$data;

            $tanggal_selesai = new DateTime($data->tanggal_selesai);
            $tanggal_hariini = new DateTime();

            if($tanggal_hariini > $tanggal_selesai)
            {
                $newProject[$key]->status = "Selesai";
            }
            else
            {
                $newProject[$key]->status = "Process";
            }
        }


        return view('pages.project.project-personil', compact('newProject'));

    }


    public function daftarprojectpersonil()
    {
        $id_user = Auth::user()->id;

        $pegawai=DB::table('md_pegawai')
                  ->where('md_pegawai.status','=','aktif')
                  ->where('users.id','=',$id_user)
                  ->leftjoin('users', 'md_pegawai.nip', '=', 'users.username')
                  ->select('md_pegawai.*')
                  ->first();

        $project=DB::table('td_project_header')
                  ->where('td_project_detail.id_pegawai','=',$pegawai->id)
                  ->leftjoin('md_perusahaan', 'td_project_header.id_perusahaan', '=', 'md_perusahaan.id')
                  ->leftjoin('td_project_detail', 'td_project_header.id', '=', 'td_project_detail.id_project')
                  ->select('td_project_header.*', 'md_perusahaan.nama_perusahaan')
                  ->orderBy('id', 'desc')
                  ->get();


        $newProject=array();

        foreach($project as $key => $data)
        {
            $newProject[$key]=$data;

            $tanggal_selesai = new DateTime($data->tanggal_selesai);
            $tanggal_hariini = new DateTime();

            if($tanggal_hariini > $tanggal_selesai)
            {
                $newProject[$key]->status = "Selesai";
            }
            else
            {
                $newProject[$key]->status = "Process";
            }
        }


        return view('pages.project.daftar_project-personil', compact('newProject'));

    }

    public function tambahproject()
    {
        $perusahaan = DB::table('md_perusahaan')->get();

        return view('pages.project.form_tambah-project', compact('perusahaan'));
    }

    public function prosestambahproject(Request $request)
    {

        $tanggalmulai= $request->input('tanggal_mulai');
        $newTanggalMulai = Carbon::createFromFormat('d/m/Y', $tanggalmulai)->format('Y-m-d');

        $tanggalselesai= $request->input('tanggal_selesai');
        $newTanggalSelesai = Carbon::createFromFormat('d/m/Y', $tanggalselesai)->format('Y-m-d');

        $data = array(
          'nama_project' => $request->input('nama_project'),
          'id_perusahaan' => $request->input('perusahaan'),
          'jenis_project' => $request->input('jenis_project'),
          'tanggal_mulai' => $newTanggalMulai,
          'tanggal_selesai' => $newTanggalSelesai,
          'budget' => $request->input('budget'),
          'created_by' => Auth::user()->username,
        );

       $insertID = DB::table('td_project_header')->insertGetId($data);

        $nama_folder = "Project_".number4($insertID);
        $path= public_path(). '/dokumen/project/'.$nama_folder;

        if (!File::exists($path))
        {
            $result = File::makeDirectory($path, 0777, true);

            $datafolder = array(
                'folder_project' => $nama_folder,
            );

            DB::table('td_project_header')->where('id', '=', $insertID)->update($datafolder);
        }



       return Redirect::to('ubah-project/'.$insertID)->with('message','Berhasil menyimpan data');
    }

    public function ubahproject($id_project)
    {
        $perusahaan = DB::table('md_perusahaan')->get();

        $project_header=DB::table('td_project_header')
              ->where('id', '=', $id_project)
              ->first();

        $project_detail=DB::table('td_project_detail')
              ->where('id_project', '=', $id_project)
              ->leftjoin('md_pegawai', 'td_project_detail.id_pegawai', '=', 'md_pegawai.id')
              ->leftjoin('td_jabatan_pegawai', 'md_pegawai.id', '=', 'td_jabatan_pegawai.id_pegawai')
              ->leftjoin('md_jabatan', 'td_jabatan_pegawai.id_jabatan', '=', 'md_jabatan.id')
              ->leftjoin('md_jenjang_jabatan', 'td_jabatan_pegawai.id_jenjang_jabatan', '=', 'md_jenjang_jabatan.id')
              ->leftjoin('td_pendidikan_pegawai', 'md_pegawai.id', '=', 'td_pendidikan_pegawai.id_pegawai')
              ->select('td_project_detail.*', 'md_pegawai.nama AS nama_pegawai', 'md_pegawai.nip AS nip', 'md_jabatan.jabatan AS jabatan', 'md_jenjang_jabatan.jenjang_jabatan AS jenjang_jabatan', 'td_pendidikan_pegawai.tingkat AS tingkat_pendidikan', 'td_pendidikan_pegawai.jurusan AS jurusan')
              ->orderBy('id','asc')
              ->get();

        $pegawai=DB::table('md_pegawai')
            ->where('status','=','aktif')
            ->get();

        return view('pages.project.form_ubah-project', compact('project_header', 'project_detail', 'perusahaan', 'pegawai'));
    }

    public function prosesubahproject(Request $request)
    {
        $tanggalmulai= $request->input('tanggal_mulai');
        $newTanggalMulai = Carbon::createFromFormat('d/m/Y', $tanggalmulai)->format('Y-m-d');

        $tanggalselesai= $request->input('tanggal_selesai');
        $newTanggalSelesai = Carbon::createFromFormat('d/m/Y', $tanggalselesai)->format('Y-m-d');

        $data = array(
          'nama_project' => $request->input('nama_project'),
          'id_perusahaan' => $request->input('perusahaan'),
          'jenis_project' => $request->input('jenis_project'),
          'tanggal_mulai' => $newTanggalMulai,
          'tanggal_selesai' => $newTanggalSelesai,
          'budget' => $request->input('budget'),
        );

      $insertID = DB::table('td_project_header')
                    ->where('id', '=', $request->input('id_header'))
                    ->update($data);

      return Redirect::to('ubah-project/'.$request->input('id_header').'#detailrow')->with('message','Berhasil menyimpan data');
    }


    public function prosestambahprojectdetail(Request $request)
    {

      $data = array(
        'id_project' => $request->input('id_header'),
        'id_pegawai' => $request->input('pegawai'),
        'jabatan_project' => $request->input('jabatan_project'),
        'tugas' => $request->input('tugas'),
      );

      $insertID = DB::table('td_project_detail')->insertGetId($data);

      return Redirect::to('ubah-project/'.$request->input('id_header').'#detailrow')->with('message','Berhasil menyimpan data');
    }

    public function hapusproject($id_project)
    {
        $data = DB::table('td_project_header')->where('id','=',$id_project)->delete();

        $datadetail = DB::table('td_project_detail')->where('id_project','=',$id_project)->delete();

        return Redirect::to('daftar-project')->with('message','Berhasil menghapus data');
    }

    public function hapusprojectdetail($id_project, $id_projectdetail)
    {
        $datadetail = DB::table('td_project_detail')->where('id','=',$id_projectdetail)->delete();

        return Redirect::to('ubah-project/'.$id_project)->with('message','Berhasil menghapus data');
    }

    public function prosesubahprojectdetail(Request $request)
    {

      $data = array(
        'id_project' => $request->input('id_header2'),
        'id_pegawai' => $request->input('pegawai2'),
        'jabatan_project' => $request->input('jabatan_project2'),
        'tugas' => $request->input('tugas2'),
      );
      
      DB::table('td_project_detail')->where('id','=',$request->input('id_detail2'))->update($data);

      return Redirect::to('ubah-project/'.$request->input('id_header2').'#detailrow')->with('message','Berhasil menyimpan data');
    }

    public function jsondatapegawai($id_pegawai)
    {
        $pegawai=DB::table('md_pegawai')->where('md_pegawai.id','=',$id_pegawai)
              ->leftjoin('td_jabatan_pegawai', 'md_pegawai.id', '=', 'td_jabatan_pegawai.id_pegawai')
              ->leftjoin('md_jabatan', 'td_jabatan_pegawai.id_jabatan', '=', 'md_jabatan.id')
              ->leftjoin('md_jenjang_jabatan', 'td_jabatan_pegawai.id_jenjang_jabatan', '=', 'md_jenjang_jabatan.id')
              ->leftjoin('td_pendidikan_pegawai', 'md_pegawai.id', '=', 'td_pendidikan_pegawai.id_pegawai')
              ->select('md_pegawai.*', 'md_jabatan.jabatan AS jabatan', 'td_pendidikan_pegawai.tingkat AS tingkat_pendidikan', 'td_pendidikan_pegawai.jurusan AS jurusan')
              ->first();

        $hasil = array(
            "jabatan" => $pegawai->jabatan,
            "pendidikan" =>$pegawai->tingkat_pendidikan.' '.$pegawai->jurusan,
        );

        return json_encode($hasil);
    }

    public function jsondataprojectdetail($id_projectdetail)
    {

        $datadetail = DB::table('td_project_detail')
              ->where('td_project_detail.id','=',$id_projectdetail)
              ->leftjoin('md_pegawai', 'td_project_detail.id_pegawai', '=', 'md_pegawai.id')
              ->leftjoin('td_jabatan_pegawai', 'md_pegawai.id', '=', 'td_jabatan_pegawai.id_pegawai')
              ->leftjoin('md_jabatan', 'td_jabatan_pegawai.id_jabatan', '=', 'md_jabatan.id')
              ->leftjoin('md_jenjang_jabatan', 'td_jabatan_pegawai.id_jenjang_jabatan', '=', 'md_jenjang_jabatan.id')
              ->leftjoin('td_pendidikan_pegawai', 'md_pegawai.id', '=', 'td_pendidikan_pegawai.id_pegawai')
              ->select('td_project_detail.*', 'md_pegawai.nama AS nama_pegawai', 'md_pegawai.nip AS nip', 'md_jabatan.jabatan AS jabatan', 'md_jenjang_jabatan.jenjang_jabatan AS jenjang_jabatan', 'td_pendidikan_pegawai.tingkat AS tingkat_pendidikan', 'td_pendidikan_pegawai.jurusan AS jurusan')
              ->first();


        $hasil = array(
            "id" => $datadetail->id,
            "id_pegawai" => $datadetail->id_pegawai,
            "nama" => $datadetail->nama_pegawai,
            "jabatan" => $datadetail->jabatan,
            "pendidikan" =>$datadetail->tingkat_pendidikan.' '.$datadetail->jurusan,
            "jabatan_project" =>  $datadetail->jabatan_project,
            "tugas" => $datadetail->tugas,
        );

        return json_encode($hasil);
    }


    public function daftarlaporan($id_project)
    {

        $project=DB::table('td_project_header')
                  ->where('td_project_header.id', '=', $id_project)
                  ->leftjoin('md_perusahaan', 'td_project_header.id_perusahaan', '=', 'md_perusahaan.id')
                  ->select('td_project_header.*', 'md_perusahaan.nama_perusahaan')
                  ->first();

        $laporan=DB::table('td_laporan')
                  ->where('td_laporan.id_project', '=', $id_project)
                  ->orderBy('bulan', 'asc')
                  ->orderBy('tahun', 'asc')
                  ->get();


        
        $datagrafik=array();

        for($i=1;$i<=12;$i++)
        {
           $datagrafik[$i]['produktivitas']="0";
           $datagrafik[$i]['penjualan']="0";
           $datagrafik[$i]['biaya_produksi']="0";

            foreach($laporan as $val)
            {
                if($val->bulan==$i)
                {
                    $datagrafik[$i]['produktivitas']=$val->produktivitas;
                    $datagrafik[$i]['penjualan']=$val->penjualan;
                    $datagrafik[$i]['biaya_produksi']=$val->biaya_produksi;
                }
            }
        }

        return view('pages.project.daftar_laporan', compact('project', 'laporan', 'datagrafik'));
    }

    public function tambahlaporan($id_project)
    {
        $project=DB::table('td_project_header')
                  ->where('td_project_header.id', '=', $id_project)
                  ->leftjoin('md_perusahaan', 'td_project_header.id_perusahaan', '=', 'md_perusahaan.id')
                  ->select('td_project_header.*', 'md_perusahaan.nama_perusahaan')
                  ->first();

        return view('pages.project.form_tambah-laporan', compact('project'));
    }

    public function prosestambahlaporan(Request $request)
    {
        $id_project = $request->input('id_project');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');

        $laporan = DB::table('td_laporan')
                ->where('id_project', '=', $id_project)
                ->where('bulan', '=', $bulan)
                ->where('tahun', '=', $tahun)
                ->first();

        if(empty($laporan))
        {
            $data = array(
              'id_project' => $id_project,
              'bulan' => $request->input('bulan'),
              'tahun' => $request->input('tahun'),
              'produktivitas' => $request->input('produktivitas'),
              'penjualan' => $request->input('penjualan'),
              'biaya_produksi' => $request->input('biaya_produksi'),
              'created_by' => Auth::user()->username,
            );

            $insertID = DB::table('td_laporan')->insertGetId($data);
            
        }
        else
        {
            $data = array(
              'produktivitas' => $request->input('produktivitas'),
              'penjualan' => $request->input('penjualan'),
              'biaya_produksi' => $request->input('biaya_produksi'),
              'created_by' => Auth::user()->username,
              'created_at' => Carbon::now()->toDateTimeString(),
            );

            DB::table('td_laporan')->where('id','=', $laporan->id)->update($data);
        }

        return Redirect::to('daftar-laporan/'.$id_project)->with('message','Berhasil menyimpan data');
    }

    public function todolist()
    {
        return view('pages.project.to-do-list');
    }

    public function jsondataevent()
    {
        $event=DB::table('events')->get();


        foreach($event as $data)
        {
            $hasil[] = array(
                'id' =>$data->id,
                'title' =>$data->title,
                'start' =>$data->start_event,
                'end' =>$data->end_event,
            );
        }

        return json_encode($hasil);
    }
}
