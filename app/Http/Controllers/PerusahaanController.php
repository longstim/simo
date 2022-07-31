<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use DB;
Use Redirect;
use Auth;
use File;


class PerusahaanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function daftarperusahaan()
    {
        $perusahaan=DB::table('md_perusahaan')
                  ->orderBy('id', 'desc')
                  ->get();

        return view('pages.perusahaan.daftar_perusahaan', compact('perusahaan'));

    }

    public function tambahperusahaan()
    {
        return view('pages.perusahaan.form_tambah-perusahaan');
    }

   
    public function prosestambahperusahaan(Request $request)
    {

        $validatedData = $request->validate([
            'nama_perusahaan' => 'required',
        ]);


        $totalNumber    = DB::table('md_perusahaan')
                            ->get()
                            ->count();

        if($totalNumber > 0)
        {
            $lastNumber     = DB::table('md_perusahaan')
                            ->orderBy('id', 'desc')
                            ->first();
            $lastNumber     = $lastNumber->id + 1;
        }
        else 
        {
            $lastNumber     = $totalNumber + 1;
        }

        $path= public_path().'/dokumen/perusahaan/';

        if($request->hasFile('surat_izin_usaha'))
        {
            $upload_dokumen = $request->file('surat_izin_usaha');
            $extension = $upload_dokumen->getClientOriginalExtension();
            $surat_izin_usaha= number4($lastNumber)."_Surat-Izin_Usaha.".$extension;
            $upload_dokumen->move($path, $surat_izin_usaha);
        }   

        if($request->hasFile('npwp'))
        {
            $upload_dokumen = $request->file('npwp');
            $extension = $upload_dokumen->getClientOriginalExtension();
            $npwp= number4($lastNumber)."_NPWP.".$extension;
            $upload_dokumen->move($path, $npwp);
        }   


        $data = array(
          'nama_perusahaan' => $request->input('nama_perusahaan'),
          'alamat_perusahaan' => $request->input('alamat_perusahaan'),
          'jenis_usaha' => $request->input('jenis_usaha'),
          'nama_pemilik' => $request->input('nama_pemilik'),
          'jumlah_tenaga_kerja' => $request->input('jumlah_tenaga_kerja'),
          'nilai_investasi' => $request->input('nilai_investasi'),
          'bentuk_badan_usaha' => $request->input('bentuk_badan_usaha'),
          'kapasitas_produksi' => $request->input('kapasitas_produksi'),
          'bahan_baku' => $request->input('bahan_baku'),
          'bahan_penolong' => $request->input('bahan_penolong'),
          'peralatan' => $request->input('peralatan'),
          'cakupan_penjualan' => $request->input('cakupan_penjualan'),
          'surat_izin_usaha' => $surat_izin_usaha,
          'npwp' => $npwp,
          'created_by' => Auth::user()->username,
        );

        $insertID = DB::table('md_perusahaan')->insertGetId($data);

        return Redirect::to('daftar-perusahaan')->with('message','Berhasil menyimpan data');
    }

    public function ubahperusahaan($id_perusahaan)
    {
        $perusahaan = DB::table('md_perusahaan')->where('id','=',$id_perusahaan)->first();

        return view('pages.perusahaan.form_ubah-perusahaan', compact('perusahaan'));
    }

    public function prosesubahperusahaan(Request $request)
    {

        $id_perusahaan = $request->input('id');

        $validatedData = $request->validate([
            'nama_perusahaan' => 'required',
        ]);

        $perusahaan=DB::table('md_perusahaan')
                    ->where('id', '=', $id_perusahaan)
                    ->first();

        $lastNumber=$id_perusahaan;

        $surat_izin_usaha=$perusahaan->surat_izin_usaha;
        $npwp=$perusahaan->npwp;

        $path= public_path().'/dokumen/perusahaan/';

        if($request->hasFile('surat_izin_usaha'))
        {
            $upload_dokumen = $request->file('surat_izin_usaha');
            $extension = $upload_dokumen->getClientOriginalExtension();
            $surat_izin_usaha= number4($lastNumber)."_Surat-Izin_Usaha.".$extension;
            $upload_dokumen->move($path, $surat_izin_usaha);
        }   

        if($request->hasFile('npwp'))
        {
            $upload_dokumen = $request->file('npwp');
            $extension = $upload_dokumen->getClientOriginalExtension();
            $npwp= number4($lastNumber)."_NPWP.".$extension;
            $upload_dokumen->move($path, $npwp);
        }   


        $data = array(
          'nama_perusahaan' => $request->input('nama_perusahaan'),
          'alamat_perusahaan' => $request->input('alamat_perusahaan'),
          'jenis_usaha' => $request->input('jenis_usaha'),
          'nama_pemilik' => $request->input('nama_pemilik'),
          'jumlah_tenaga_kerja' => $request->input('jumlah_tenaga_kerja'),
          'nilai_investasi' => $request->input('nilai_investasi'),
          'bentuk_badan_usaha' => $request->input('bentuk_badan_usaha'),
          'kapasitas_produksi' => $request->input('kapasitas_produksi'),
          'bahan_baku' => $request->input('bahan_baku'),
          'bahan_penolong' => $request->input('bahan_penolong'),
          'peralatan' => $request->input('peralatan'),
          'cakupan_penjualan' => $request->input('cakupan_penjualan'),
          'surat_izin_usaha' => $surat_izin_usaha,
          'npwp' => $npwp,
        );

        DB::table('md_perusahaan')->where('id', '=', $id_perusahaan)->update($data);

        return Redirect::to('daftar-perusahaan')->with('message','Berhasil menyimpan data');
    }

    public function profilperusahaan($id_perusahaan)
    {
        $perusahaan=DB::table('md_perusahaan')
                    ->where('md_perusahaan.id', '=', $id_perusahaan)
                    ->first();

        return view('pages.perusahaan.view_profil-perusahaan', compact('perusahaan'));
        
    }

    public function hapusperusahaan($id_perusahaan)
    {
        $data = DB::table('md_perusahaan')->where('id','=',$id_perusahaan)->delete();

        return Redirect::to('daftar-perusahaan')->with('message','Berhasil menghapus data');
    }

}
