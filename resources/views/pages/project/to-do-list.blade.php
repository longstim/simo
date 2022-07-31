<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMO-Aplikasi Survey & Monitoring</title>
  <!-- Custom fonts for this template-->
  <link href="{{asset('simo-dash/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('simo-dash/css/sb-admin-2.min.css" rel="stylesheet')}}">
    <link rel="stylesheet" href="{{asset('simo-dash/assets/fullcalendar.css')}}"/>
    <link rel="stylesheet" href="{{asset('simo-dash/assets/bootstrap.css')}}"/>
    <!-- Custom fonts for this template-->
    <link href="{{asset('simo-dash/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('simo-dash/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('simo-dash/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <!-- DatePicker -->
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <script src="{{asset('simo-dash/assets/jquery.min.js')}}"></script>
    <script src="{{asset('simo-dash/assets/jquery-ui.min.js')}}"></script>
    <script src="{{asset('simo-dash/assets/moment.min.js')}}"></script>
    <script src="{{asset('simo-dash/assets/fullcalendar.min.js')}}"></script>
</head>
<body id="page-top">
 <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('/home')}}">
                <div class="sidebar-brand-icon">
                    <image src = "{{asset('image/whitesimo.png')}}" style =  "width : 125px;">
                </div>
                <div class="sidebar-brand-text">Apps</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{url('/home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Fitur
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{url('to-do-list')}}">
                    <i class="fas fa-fw fa-calendar"></i>
                    <span>To Do List</span>
                </a>
            </li>

            @if(Auth::user()->role=="admin")
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProject" aria-expanded="true" aria-controls="collapseProject">
                    <i class="fas fa-fw fa-database"></i>
                    <span>Project</span>
                </a>
                <div id="collapseProject" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sub Data</h6>
                        <a class="collapse-item" href="{{url('daftar-project')}}">Data Project</a>
                        <a class="collapse-item" href="{{url('project-personil')}}">Project Personil</a>
                    </div>
                </div>
            </li>
            @endif


            @if(Auth::user()->role!="admin") 
            <li class="nav-item">
                <a class="nav-link" href="{{url('daftar-project-personil')}}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Project</span></a>
            </li>
            @endif

             @if(Auth::user()->role=="admin")
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData" aria-expanded="true" aria-controls="collapseMasterData">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Master Data</span>
                </a>
                <div id="collapseMasterData" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sub Data</h6>
                        <a class="collapse-item" href="{{url('daftar-perusahaan')}}">Perusahaan</a>
                    </div>
                </div>
            </li>
            @endif

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>         
        </ul>
    
     
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
            
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{asset('simo-dash/img/undraw_profile.svg')}}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
        
                                <!--<div class="dropdown-divider"></div>-->

                                   <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">  
                                         <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                            {{ __('Logout') }}
                                   </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->



    <h2 class="text-center"><a href = "#">To Do List</a></h2>
    <br>
    <div class="container">
        <input type="hidden" name="id_project" id="txtIDProject">
        <div id ="calendar"></div>
    </div>
    <script>
        //persiapan jquerry
        $(document).ready(function(){

                var calendar = $('#calendar').fullCalendar({
                //izinkan tabel bisa diedit
                editable: true,
                //atur header calender
                header:{
                    left: 'prev, next today',
                    center :'title',
                    right: 'month, agendaWeek, agendaDay'
                },
                //tampilkan data dari database
                events : 'jsondataevent/',
                displayEventTime: false,
                //izinkan tabel/kalender bisa dipilih/edit
                selectable : true,
                selectHelper : true,
                select: function (start, end, allDay){
                    // tampilkan pesan input
                    var title = prompt("Masukkan Judul Kegiatan");
                    if(title){
                        //tampung tanggal yang dipilih ke dalam variabel start dan end
                        var start = $.fullCalendar.formatDate(start,"Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(end,"Y-MM-DD HH:mm:ss");
                        //Perintah ajax lempar data untuk disimpan
                        $.ajax({
                            url:"simo-dash/simpan.php",
                            type : "POST",
                            data : {
                                title:title,
                                start:start,
                                end:end
                            },
                            success:function(){
                                //jika simpan sukses refresh kalender dan tampilkan pesan sukses
                                calendar.fullCalendar('refetchEvents')
                                alert('Simpan Sukses');
                            }
                        });
                    }
                },
                //event ketika judul kegiatan diseret/didrop
                eventDrop: function(event){
                        var start = $.fullCalendar.formatDate(event.start,"Y-MM-DD HH:mm:ss");
                        var end = $.fullCalendar.formatDate(event.end,"Y-MM-DD HH:mm:ss"); 
                        var title = event.title;
                        var id = event.id;
                        //Perintah ajax lempar data untuk diubah
                        $.ajax({
                            url:"simo-dash/ubah.php",
                            type : "POST",
                            data : {
                                title:title,
                                start:start,
                                end:end,
                                id:id
                            },
                            success:function(){
                                //jika simpan sukses refresh kalender dan tampilkan pesan sukses
                                calendar.fullCalendar('refetchEvents');
                                alert('Edit Sukses');
                            }
                        });
                },
        
                //event ketika judul kegiatan diklik
                eventClick : function(event){
                    if (confirm("Apakah anda yakin akan menghapus kegiatan ini?")){
                        var id = event.id;
                         //Perintah ajax lempar data untuk dihapus
                         $.ajax({
                            url:"simo-dash/hapus.php",
                            type : "POST",
                            data : {
                                id:id
                            },
                            success:function(){
                                //jika simpan sukses refresh kalender dan tampilkan pesan sukses
                                calendar.fullCalendar('refetchEvents')
                                alert('Hapus Sukses');
                            }
                        });
                      
                    }
                }
            });
            
        });
        
        </script>
          
        <footer id="footer" class="sticky-footer bg-white">
                <div class="container my-auto"> 
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SIMO 2022</span>  
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>


    
     <!-- Bootstrap core JavaScript-->
    
<script src="{{asset('simo-dash/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- Core plugin JavaScript-->
 <script src="{{asset('simo-dash/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('simo-dash/js/sb-admin-2.min.js')}}"></script>

</body>
</html>