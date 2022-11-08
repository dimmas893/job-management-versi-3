@extends('layouts.template_leader')
@section('content')

{{-- add new employee modal end --}}

{{-- edit employee modal start --}}
<div class="modal fade" id="editpekerjaanModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Laporan Kerja</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="edit_pekerjaan_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_image" id="emp_image">
        <div class="modal-body p-4 bg-light">
            <div class="my-2">
              <label for="file">File</label>
              <input type="file" name="file" id="file" class="form-control" placeholder="Masukan file"required>
          </div>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_pekerjaan_btn" class="btn btn-success">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>


<ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" href="#approve" role="tab" data-toggle="tab">Daftar Pekerjaan</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#belumapprove" role="tab" data-toggle="tab">Pekerjaan Belum Dikerjakan</a>
    </li>
</ul>

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

@section('js')
      <script>
    $(function() {

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('anggota-edit') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
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
          url: '{{ route('anggota-update') }}',
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
            $("#edit_pekerjaan_btn").text('Submit');
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
              url: '{{ route('anggota-delete') }}',
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
          url: '/anggota/all',
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
            url: '/anggota/belumkerjakan',
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