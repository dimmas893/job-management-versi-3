<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LeaderController extends Controller
{
    // set index page view
    public function index()
    {
        return view('leader.index');
    }

    // handle fetch all eamployees ajax request
    public function all()
    {
        $emps = Pekerjaan::where('file', '!=' , null)->where('user_leader_id', Auth::user()->id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-sm text-center align-middle">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Leader</th>
                <th>Name Anggota</th>
                <th>Jenis Pekerjaan</th>
                <th>Descripsi Pekerjaan</th>
                <th>Laporan</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->leader->name . '</td>
                <td>' . $emp->anggota->name . '</td>
                <td>' . $emp->jenis_pekerjaan . '</td>
                <td>' . $emp->deskripsi . '</td>
                <td><img src="/storage/images/' . $emp->file . '" width="50" class="img-thumbnail rounded-circle"></td>
                <td><p style="color:chartreuse">Selesai</p> </td>
                <td>
                    <a href="/leader/lihat/' . $emp->id . '"><i class="fa-solid fa-eye h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    public function lihat($id)
    {
        $pekerjaan = Pekerjaan::Find($id);
        return view('leader.lihat', compact('pekerjaan'));
    }

    public function belumkerjakan()
    {
        $emps = Pekerjaan::where('file', null)->where('user_leader_id', Auth::user()->id)->get();
        $output = '';
        $p = 1;
        if ($emps->count() > 0) {
            $output .= '<table class="table table-sm text-center align-middle">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Leader</th>
                <th>Name Anggota</th>
                <th>Jenis Pekerjaan</th>
                <th>Descripsi Pekerjaan</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>';
            foreach ($emps as $emp) {
                $output .= '<tr>
                <td>' . $p++ . '</td>
                <td>' . $emp->leader->name . '</td>
                <td>' . $emp->anggota->name . '</td>
                <td>' . $emp->jenis_pekerjaan . '</td>
                <td>' . $emp->deskripsi . '</td>
                <td><p style="color:red">Belum Selesai</p> </td>
                <td>
                <a href="#" id="' . $emp->id . '" class="text-success mx-1 editIcon" data-bs-toggle="modal" data-bs-target="#editpekerjaanModal"><i class="bi-pencil-square h4"></i></a>

                  <a href="#" id="' . $emp->id . '" class="text-danger mx-1 deleteIcon"><i class="bi-trash h4"></i></a>
                </td>
              </tr>';
            }
            $output .= '</tbody></table>';
            echo $output;
        } else {
            echo '<h1 class="text-center text-secondary my-5">No record present in the database!</h1>';
        }
    }

    // handle insert a new Guru ajax request
    public function store(Request $request)
    {
        $empData = [
            'user_leader_id' => Auth::user()->id,
            'user_anggota_id' => $request->user_anggota_id,
            'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'deskripsi' => $request->deskripsi,
        ];
        Pekerjaan::create($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle edit an Guru ajax request
    public function edit(Request $request)
    {
        $id = $request->id;
        $emp = Pekerjaan::with('anggota')->find($id);
        return response()->json($emp);
    }

    // handle update an Guru ajax request
    public function update(Request $request)
    {
        $emp = Pekerjaan::find($request->emp_id);

        $empData = [
            // 'user_leader_id' => 1,
            // 'user_anggota_id' => $request->user_anggota_id,
            // 'jenis_pekerjaan' => $request->jenis_pekerjaan,
            'deskripsi' => $request->deskripsi,
        ];

        $emp->update($empData);
        return response()->json([
            'status' => 200,
        ]);
    }

    // handle delete an Guru ajax request
    public function delete(Request $request)
    {
        $id = $request->id;
        $emp = Pekerjaan::find($id);
        if($emp->image){
            Storage::delete('public/images/' . $emp->image);
            Pekerjaan::destroy($id);
        }

        if($emp->image == null){
            Pekerjaan::destroy($id);
        }
    }
}

