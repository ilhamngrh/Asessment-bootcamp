<?php

namespace App\Http\Controllers\api;

use App\Models\Dosen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\DosenResource;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get all Dosens
        $dosen = Dosen::latest()->paginate(5);

        //return collection of Dosens as a resource
        return new DosenResource(true, 'List Data Dosen', $dosen);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //create Dosen
        $dosen = Dosen::create([
            'nip'     => $request->nip,
            'nama'   => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat
        ]);

        //return response
        return new DosenResource(true, 'Data Dosen Berhasil Ditambahkan!', $dosen);
    }

    //update dan delete
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nip' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find Dosen by ID
        $dosen = Dosen::find($id);

        // Update Dosen data
        $dosen->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
        ]);

        // Return response
        return new DosenResource(true, 'Data Dosen Berhasil Diubah!', $dosen);
    }

    public function destroy($id)
    {

        //find Dosen by ID
        $dosen = Dosen::find($id);
        //delete Dosen
        $dosen->delete();

        //return response
        return new DosenResource(true, 'Data Dosen Berhasil Dihapus!', null);
    }
}
