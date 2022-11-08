@extends('layouts.template_leader')
@section('content')

<div class="modal fade" id="add_pekerjaan_modal"  aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New pekerjaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_pekerjaan_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="my-2">
            <label for="anggota">Nama Anggota</label>
                <select name="user_anggota_id" style="width:100%;" class="form-control js-example-basic-single">
                    @php
                        $anggota = \App\Models\User::where('jabatan', 'anggota')->get();
                    @endphp
                  <option value="disable">--Pilih Anggota--</option>
                    @foreach ($anggota as $p)
                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                </select>
          </div>
          <div class="my-2">
            <label for="Jenis_pekerjaan">Status Pekerjaan</label>
            <select name="jenis_pekerjaan" class="form-control">
                <option value="disable">--Pilih Jenis Anggota--</option>
                <option value="Normal">Normal</option>
                <option value="Sedang">Sedang</option>
                <option value="Mendesak">Mendesak</option>
            </select>
          </div>
          <div class="my-2">
            <label for="Deskripsi">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" placeholder="Masukan Deskripsi" cols="30" rows="10" required>Masukan Deskripsi</textarea> 
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_pekerjaan_btn" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editpekerjaanModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit pekerjaan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_pekerjaan_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="anggota">Nama Anggota</label>
                <input type="text" id="user_anggota_id" class="form-control" disabled>
            </div>
            <div class="my-2">
              <label for="jenis_pekerjaan">Status Pekerjaan</label>
              <input type="text" id="jenis_pekerjaan" class="form-control" disabled>
              </select>
            </div>
            <div class="my-2">
              <label for="Deskripsi">Deskripsi</label>
              <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Masukan Deskripsi" cols="30" rows="10" required> </textarea> 
          </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_pekerjaan_btn" class="btn btn-success">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
{{-- edit employee modal end --}}

{{-- <div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Tambah Pekerjaan
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div> --}}

<div class="d-flex">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" href="#approve" role="tab" data-toggle="tab">Daftar Pekerjaan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#belumapprove" role="tab" data-toggle="tab">Pekerjaan Belum Dikerjakan</a>
      </li>
    </ul>
    <button class="btn btn-primary ml-auto p-2" data-bs-toggle="modal" data-bs-target="#add_pekerjaan_modal"><i
      class="bi-plus-circle me-2"></i>Add Pekerjaan
    </button>
</div>

<div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active show" id="approve">
           <div class="row">
              <div class="col-12">
                  <div class="card mt-2">
                      <div class="card-body"> 
                          <div class="table-responsive">
                              <div id="pekerjaan_all"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
    </div>
    <div role="tabpanel" class="tab-pane fade in" id="belumapprove">
           <div class="row">
              <div class="col-12">
                  <div class="card mt-2">
                      <div class="card-body"> 
                          <div class="table-responsive">
                              <div id="pekerjaan_belum"></div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
    </div>
    
  </div>
@endsection
@section('css')
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2(); 
});
</script>
      <script>
    $(function() {

      // add new employee ajax request
      $("#add_pekerjaan_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_pekerjaan_btn").text('Adding...');
        $.ajax({
          url: '{{ route('leader-store') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'pekerjaan Added Successfully!',
                'success'
              )
              pekerjaan_all();
                pekerjaan_belum();
            }
            $("#add_pekerjaan_btn").text('Save');
            $("#add_pekerjaan_form")[0].reset();
            $("#add_pekerjaan_modal").modal('hide');
          }
        });
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('leader-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#user_anggota_id").val(response.anggota.name);
            $("#jenis_pekerjaan").val(response.jenis_pekerjaan);
            $("#deskripsi").val(response.deskripsi);
            $("#emp_id").val(response.id);
          }
        });
      });

      // update employee ajax request
      $("#edit_pekerjaan_form").submit(function(e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_pekerjaan_btn").text('Updating...');
        $.ajax({
          url: '{{ route('leader-update') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'pekerjaan Updated Successfully!',
                'success'
              )
              pekerjaan_all();
                pekerjaan_belum();
            }
            $("#edit_pekerjaan_btn").text('Update');
            $("#edit_pekerjaan_form")[0].reset();
            $("#editpekerjaanModal").modal('hide');
          }
        });
      });

      // delete employee ajax request
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('leader-delete') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                
                pekerjaan_belum();
                pekerjaan_all();
              }
            });
          }
        })
      });

      // fetch all employees ajax request
      pekerjaan_all();

      function pekerjaan_all() {
        $.ajax({
          url: '/leader/all',
          method: 'get',
          success: function(response) {
            $("#pekerjaan_all").html(response);
            $("table").DataTable({
              order: [0, 'asc'],
                destroy: true
            });
          }
        });
      }

      pekerjaan_belum();

        function pekerjaan_belum() {
        $.ajax({
            url: '/leader/belumkerjakan',
            method: 'get',
            success: function(response) {
            $("#pekerjaan_belum").html(response);
            $("table").DataTable({
                destroy: true,  
                order: [0, 'asc']
            });
            }
        });
        }
    });
  </script>
@endsection