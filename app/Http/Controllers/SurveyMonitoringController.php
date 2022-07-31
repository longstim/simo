<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;
use File;

class SurveyMonitoringController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function surveymonitoring($id_project)
    {
        $project_header=DB::table('td_project_header')
                  ->where('td_project_header.id', '=', $id_project)
                  ->leftjoin('md_perusahaan', 'td_project_header.id_perusahaan', '=', 'md_perusahaan.id')
                  ->select('td_project_header.*', 'md_perusahaan.nama_perusahaan', 'md_perusahaan.surat_izin_usaha', 'md_perusahaan.npwp')
                  ->first();

        $project_detail = DB::table('td_project_detail')
                  ->where('td_project_detail.id_project', '=', $id_project)
                  ->leftjoin('md_pegawai', 'td_project_detail.id_pegawai', '=', 'md_pegawai.id')
                  ->select('td_project_detail.*', 'md_pegawai.nama')
                  ->get();

        $surveymonitoring = DB::table('td_survey_monitoring')
                  ->where('td_survey_monitoring.id_project', '=', $id_project)
                  ->leftjoin('users', 'td_survey_monitoring.created_by', '=', 'users.username')
                  ->select('td_survey_monitoring.*', 'users.name AS created_by')
                  ->orderBy('id', 'desc')
                  ->get();

        $budget = $project_header->budget;
        $realisasi = DB::table('td_survey_monitoring')
                        ->where('id_project','=', $id_project)
                        ->sum('biaya');

        $persenRealisasiAnggaran=round(((double)$realisasi/(double)$budget) * 100);

        $anggaran=array(
            'budget' => $budget,
            'realisasi' => $realisasi,
            'persenrealisasi' => $persenRealisasiAnggaran
        );

        return view('pages.survey.view_survey-monitoring', compact('project_header', 'project_detail', 'surveymonitoring', 'anggaran'));

    }

    public function tambahsurveymonitoring($id_project)
    {
        $project=DB::table('td_project_header')
                  ->where('td_project_header.id', '=', $id_project)
                  ->leftjoin('md_perusahaan', 'td_project_header.id_perusahaan', '=', 'md_perusahaan.id')
                  ->select('td_project_header.*', 'md_perusahaan.nama_perusahaan')
                  ->first();

        return view('pages.survey.form_tambah-survey-monitoring', compact('project'));

    }

    public function prosestambahsurveymonitoring(Request $request)
    {

        $id_project = $request->input('id_project');

        $tanggalmulai= $request->input('tanggal_mulai');
        $newTanggalMulai = Carbon::createFromFormat('d/m/Y', $tanggalmulai)->format('Y-m-d');

        $tanggalselesai= $request->input('tanggal_selesai');
        $newTanggalSelesai = Carbon::createFromFormat('d/m/Y', $tanggalselesai)->format('Y-m-d');

        $totalNumber    = DB::table('td_survey_monitoring')
                            ->get()
                            ->count();

        if($totalNumber > 0)
        {
            $lastNumber     = DB::table('td_survey_monitoring')
                            ->orderBy('id', 'desc')
                            ->first();
            $lastNumber     = $lastNumber->id + 1;
        }
        else 
        {
            $lastNumber     = $totalNumber + 1;
        }

        $project_header=DB::table('td_project_header')
                        ->where('id','=', $id_project)
                        ->first();

        $nama_folder = 'Survey-Monitoring_'.number4($lastNumber);
        $path= public_path().'/dokumen/project/'.$project_header->folder_project.'/'.$nama_folder;

        if (!File::exists($path))
        {
            $result = File::makeDirectory($path, 0777, true);
        }

        $no=0;

        $dataLampiran=array();

        if($request->hasfile('filenames'))
        {
            foreach($request->file('filenames') as $file)
            {
                ++$no;
                $name = $project_header->folder_project.'_'.number3($no).time().'.'.$file->extension();
                $file->move($path, $name);  
                $dataLampiran[] = $name;  
            }
        }

        $data = array(
          'id_project' => $id_project,
          'judul_kegiatan' => $request->input('judul_kegiatan'),
          'jenis_kegiatan' => $request->input('jenis_kegiatan'),
          'tanggal_mulai' => $newTanggalMulai,
          'tanggal_selesai' => $newTanggalSelesai,
          'keterangan' => $request->input('keterangan'),
          'biaya' => $request->input('biaya'),
          'folder_survey_monitoring' => $nama_folder,
          'created_by' => Auth::user()->username,
        );

        $insertID = DB::table('td_survey_monitoring')->insertGetId($data);

        foreach($dataLampiran as $val)
        {
            $lampiran=array(
                'id_survey_monitoring' => $insertID,
                'nama_file' => $val,
            );
            
            DB::table('td_lampiran_survey_monitoring')->insert($lampiran);
        }

        return Redirect::to('survey-monitoring/'.$id_project)->with('message','Berhasil menyimpan data');
    }


    public function hapussurveymonitoring($id_simo)
    {

        $simo = DB::table('td_survey_monitoring')->where('id', '=', $id_simo)->first();

        $id_project = $simo->id_project;
        $project_header = DB::table('td_project_header')->where('id', '=', $id_project)->first();

        $nama_folder = $simo->folder_survey_monitoring;
        $path= public_path().'/dokumen/project/'.$project_header->folder_project.'/'.$nama_folder;

        $result = File::deleteDirectory($path, 0777, true);

        $data = DB::table('td_survey_monitoring')->where('id','=',$id_simo)->delete();

        $datalampiran = DB::table('td_lampiran_survey_monitoring')->where('id_survey_monitoring','=', $id_simo)->delete();

        return Redirect::to('survey-monitoring/'.$id_project)->with('message','Berhasil menghapus data');
    }

}
