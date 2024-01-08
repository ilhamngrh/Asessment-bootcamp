<?php

namespace App\Http\Controllers\api;

use App\Models\Matkul;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\MatakuliahResource;

class MatkulController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $prodies = Matkul::latest()->paginate(10);

        //return with Api Resource
        return new MatakuliahResource(true, 'List Data Prodi', $prodies);
    }

    /**
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show()
    {
        $prodi = Matkul::with('mahasiswas.matkuls',)->first();

        if ($prodi) {
            //return with Api Resource
            return new MatakuliahResource(true, 'List Data Mahasiswa By Matakuliah', $prodi);
        }

        //return with Api Resource
        return new MatakuliahResource(false, 'Data prodi Tidak Ditemukan!', null);
    }

    /**
     * prodiSidebar
     *
     * @return void
     */
    public function prodiSidebar()
    {
        $prodies = Matkul::orderBy('name', 'ASC')->get();

        //return with Api Resource
        return new MatakuliahResource(true, 'List Data prodies Sidebar', $prodies);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [

            'nama_matkul' => 'required',

            'deskripsi' => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //create matkul
        $matkul = Matkul::create([

            'nama_matkul'   => $request->nama_matkul,

            'deskripsi' => $request->deskripsi
        ]);

        //return response
        return new MatakuliahResource(true, 'Data matkul Berhasil Ditambahkan!', $matkul);
    }

    //update dan delete
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nama_matkul' => 'required',

            'deskripsi' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find matkul by ID
        $matkul = Matkul::find($id);

        // Update matkul data
        $matkul->update([
            'nama_matkul'   => $request->nama_matkul,

            'deskripsi' => $request->deskripsi
        ]);

        // Return response
        return new MatakuliahResource(true, 'Data matkul Berhasil Diubah!', $matkul);
    }

    public function destroy($id)
    {

        //find matkul by ID
        $matkul = Matkul::find($id);
        //delete matkul
        $matkul->delete();

        //return response
        return new MatakuliahResource(true, 'Data matkul Berhasil Dihapus!', null);
    }
}
