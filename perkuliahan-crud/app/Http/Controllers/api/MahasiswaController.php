<?php

namespace App\Http\Controllers\api;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MahasiswaResource;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all mahasiswas
        $mhs = Mahasiswa::with('matkuls',)->when(request()->q, function ($posts) {
            $posts = $posts->where('nama', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);;

        //return collection of mahasiswas as a resource
        return new MahasiswaResource(true, 'List Data Mahasiswa', $mhs);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'alamat' => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //create mahasiswa
        $mhs = Mahasiswa::create([
            'nim'     => $request->nim,
            'nama'   => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan' => $request->jurusan,
            'angkatan' => $request->angkatan,
            'alamat' => $request->alamat
        ]);

        //return response
        return new MahasiswaResource(true, 'Data mahasiswa Berhasil Ditambahkan!', $mhs);
    }


    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nim' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'alamat' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find Mahasiswa by ID
        $mhs = Mahasiswa::find($id);

        // Update Mahasiswa data
        $mhs->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'jurusan' => $request->jurusan,
            'angkatan' => $request->angkatan,
            'alamat' => $request->alamat,
        ]);

        // Return response
        return new MahasiswaResource(true, 'Data Mahasiswa Berhasil Diubah!', $mhs);
    }

    public function destroy($id)
    {

        //find mahasiswa by ID
        $mahasiswa = Mahasiswa::find($id);
        //delete mahasiswa
        $mahasiswa->delete();

        //return response
        return new mahasiswaResource(true, 'Data mahasiswa Berhasil Dihapus!', null);
    }
}
