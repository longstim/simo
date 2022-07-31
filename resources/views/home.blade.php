@extends('layouts.dashboard')
@section('page_heading','Dashboard')
@section('content')
<!-- Main content -->
<div clas "row">
                <div  class = "col-md-12"></div>
                <div class = "card mb-4 py-3 border-left-primary">
                <div class = "card-body">
                <h3> Welcome User </h3>
                <p align = "justify"> Selamat Datang di Aplikasi SIMO
                <br> Aplikasi Survey dan Monitoring IKM yang digunakan untuk Program </br>
                Dana Kemitraan Peningkatan Teknologi industri (DAPATI) dan </br>
                Penguatan Industri Melaui Optimalisasi Teknologi (PINOTI) 
                </p>
                </div>
                </div>
                </div>
 
     
 <!-- ./col -->

     


<!-- ChartJS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>


@endsection
