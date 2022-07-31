<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'IndexController@index')->name('home');


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

//Perusahaan
Route::get('daftar-perusahaan', 'PerusahaanController@daftarperusahaan');
Route::get('tambah-perusahaan', 'PerusahaanController@tambahperusahaan');
Route::post('proses-tambah-perusahaan', 'PerusahaanController@prosestambahperusahaan');
Route::get('ubah-perusahaan/{id_perusahaan}', 'PerusahaanController@ubahperusahaan');
Route::post('proses-ubah-perusahaan', 'PerusahaanController@prosesubahperusahaan');
Route::get('profil-perusahaan/{id_perusahaan}', 'PerusahaanController@profilperusahaan');
Route::get('hapus-perusahaan/{id_perusahaan}', 'PerusahaanController@hapusperusahaan');

//Project
Route::get('daftar-project', 'ProjectController@daftarproject');
Route::get('project-personil', 'ProjectController@projectpersonil');
Route::get('daftar-project-personil', 'ProjectController@daftarprojectpersonil');
Route::get('tambah-project', 'ProjectController@tambahproject');
Route::post('proses-tambah-project', 'ProjectController@prosestambahproject');
Route::get('ubah-project/{id_project}', 'ProjectController@ubahproject');
Route::post('proses-ubah-project', 'ProjectController@prosesubahproject');
Route::post('proses-tambah-project-detail', 'ProjectController@prosestambahprojectdetail');
Route::post('proses-ubah-project-detail', 'ProjectController@prosesubahprojectdetail');
Route::get('jsondatapegawai/{id_pegawai}','ProjectController@jsondatapegawai');
Route::get('jsondataprojectdetail/{id_projectdetail}','ProjectController@jsondataprojectdetail');
Route::get('hapus-project/{id_project}', 'ProjectController@hapusproject');
Route::get('hapus-project-detail/{id_project}/{id_projectdetail}', 'ProjectController@hapusprojectdetail');
Route::get('daftar-laporan/{id_project}', 'ProjectController@daftarlaporan');
Route::get('tambah-laporan/{id_project}', 'ProjectController@tambahlaporan');
Route::post('proses-tambah-laporan', 'ProjectController@prosestambahlaporan');
Route::get('to-do-list', 'ProjectController@todolist');
Route::get('jsondataevent','ProjectController@jsondataevent');

//Survey Monitoring
Route::get('survey-monitoring/{id_project}', 'SurveyMonitoringController@surveymonitoring');
Route::get('tambah-survey-monitoring/{id_project}', 'SurveyMonitoringController@tambahsurveymonitoring');
Route::post('proses-tambah-survey-monitoring', 'SurveyMonitoringController@prosestambahsurveymonitoring');
Route::get('hapus-survey-monitoring/{id_simo}', 'SurveyMonitoringController@hapussurveymonitoring');

Route::get('profil-user/{id_user}', 'PengaturanController@profiluser');
Route::post('proses-ubah-profil-user', 'PengaturanController@prosesubahprofiluser');

