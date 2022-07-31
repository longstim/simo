<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;
Use Redirect;
use Auth;


class PengaturanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function daftarrole()
    {
        $role=DB::table('roles')->get();

        return view('pages.pengaturan.daftarrole', compact('role'));
    }

    public function daftarpermission()
    {

        $permission=DB::table('permissions')->get();

        return view('pages.pengaturan.daftarpermission', compact('permission'));
    }

    public function tambahpermission()
    {
        $permission=DB::table('permissions')->get();

        return view('pages.pengaturan.form_tambahpermission',compact('permission'));
    }

    public function prosestambahpermission(Request $request)
    {
        Permission::create(['name' => $request->input('permission')]);

        return Redirect::to('permission')->with('message','Berhasil menyimpan data');
    }

    public function daftaruser()
    {

        $user=DB::table('users')
            ->leftjoin('model_has_roles AS t1', 'users.id', '=', 't1.model_id')
            ->leftjoin('roles AS t2', 't1.role_id', '=', 't2.id')
            ->select('users.*', 't2.name AS role')
            ->get();

        return view('pages.pengaturan.daftaruser', compact('user'));
    }

    public function ubahuser($id_user)
    {
        $user=DB::table('users')->where('id','=',$id_user)
            ->leftjoin('model_has_roles AS t1', 'users.id', '=', 't1.model_id')
            ->select('users.*', 't1.role_id AS role_id')
            ->first();

        $role=DB::table('roles')->get();

        return view('pages.pengaturan.form_ubahuser',compact('user', 'role'));
    }

    public function prosesubahuser(Request $request)
    {
        $user = User::find($request->input('id'));

        $role=DB::table('roles')->where('id','=',$request->input('role'))->first();

        $user->syncRoles($role->name);

        return Redirect::to('user')->with('message','Berhasil menyimpan data');
    }

    public function profiluser($id_user)
    {
        $user=DB::table('users')->where('id','=',$id_user)->first();

        return view('pages.pengaturan.profil-user',compact('user'));
    }

    public function prosesubahprofiluser(Request $request)
    {
        $id_user = $request->input('id');

        $datauser = array(
          'email' => $request->input('email'),
        );

        if(!empty($request->input('password')))
        {
          $validatedData = $request->validate([
            'password' => 'required|string|min:6|confirmed',
          ]);

          $datauser = array(
            'password' => Hash::make($request->input('password')),
            'updated_at' => date("Y-m-d H:i:s"),
          );
        }
        
        DB::table('users')->where('id','=',$id_user)->update($datauser);
  
        return Redirect::to('profil-user/'.$id_user)->with('message','Berhasil menyimpan data');
    }
}
