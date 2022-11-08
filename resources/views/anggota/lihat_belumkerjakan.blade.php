@extends('layouts.template_leader')
@section('content')
<div class="card" style="width: 18rem;">
    {{-- <img src="/storage/images/{{$pekerjaan->file}} " class="card-img-top" alt="..."> --}}
    <div class="card-body">
        <div class="row">
          <label for="deskripsi"><b>Leader : </b></label>
          <p class="card-text">{{ $pekerjaan->leader->name }}</p>

          <label for="deskripsi"><b>Deskripsi Pekerjaan : </b></label>
          <p class="card-text">{{ $pekerjaan->deskripsi }}</p>
        </div>
    </div>
    <a href="/dimmas" class="btn btn-primary">Kembali</a>
  </div>
@endsection