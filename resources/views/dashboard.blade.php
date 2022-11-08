@extends('layouts.template_leader')
@section('content')
<div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                       <div class="card border-left-primary shadow h-100 py-2">
                           <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                   <div class="col mr-2">
                                       <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                           Total Leader</div>
                                       <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $leader }}</div>
                                   </div>
                                   <div class="col-auto">  
                                    <i class="fa-light fa-user"></i>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                    <div class="col-xl-3 col-md-6 mb-4">
                       <div class="card border-left-primary shadow h-100 py-2">
                           <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                   <div class="col mr-2">
                                       <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                           Total Anggota</div>
                                       <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $anggota }}</div>
                                   </div>
                                   <div class="col-auto">  
                                    <i class="fa-solid fa-user"></i>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
{{-- 

                   <div class="col-xl-3 col-md-6 mb-4">
                       <div class="card border-left-primary shadow h-100 py-2">
                           <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                   <div class="col mr-2">
                                       <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                           Menunggu Approve</div>
                                       <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $level_1_belum_approve }}</div>
                                   </div>
                                   <div class="col-auto">  
                                       <i class="fa-solid fa-pause"></i>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>

                      <div class="col-xl-3 col-md-6 mb-4">
                       <div class="card border-left-primary shadow h-100 py-2">
                           <div class="card-body">
                               <div class="row no-gutters align-items-center">
                                   <div class="col mr-2">
                                       <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                           Total Barang</div>
                                       <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $barang }}</div>
                                   </div>
                                   <div class="col-auto">  
                                       <i class="fa-solid fa-folder"></i>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div> --}}
</div>
@endsection