<?php

namespace App\Http\Controllers\api;

use App\Models\Prodi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProdiResource;
use Illuminate\Support\Facades\Validator;

class ProdisController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $prodies = Prodi::latest()->paginate(10);

        //return with Api Resource
        return new ProdiResource(true, 'List Data Prodi', $prodies);
    }

    /**
     * show
     *
     * @param  mixed $slug
     * @return void
     */
    public function show()
    {
        $prodi = Prodi::with('mahasiswas.prodis',)->first();

        if ($prodi) {
            //return with Api Resource
            return new ProdiResource(true, 'List Data Mahasiswa By Matakuliah', $prodi);
        }

        //return with Api Resource
        return new ProdiResource(false, 'Data prodi Tidak Ditemukan!', null);
    }

    /**
     * prodiSidebar
     *
     * @return void
     */
    public function prodiSidebar()
    {
        $prodies = Prodi::orderBy('name', 'ASC')->get();

        //return with Api Resource
        return new ProdiResource(true, 'List Data prodies Sidebar', $prodies);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [

            'nama' => 'required',

            'deskripsi' => 'required'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //create Prodi
        $Prodi = Prodi::create([

            'nama'   => $request->nama,

            'deskripsi' => $request->deskripsi
        ]);

        //return response
        return new ProdiResource(true, 'Data Prodi Berhasil Ditambahkan!', $Prodi);
    }

    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'nama' => 'required',

            'deskripsi' => 'required'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find Prodi by ID
        $Prodi = Prodi::find($id);

        // Update Prodi data
        $Prodi->update([
            'nama'   => $request->nama,

            'deskripsi' => $request->deskripsi
        ]);

        // Return response
        return new ProdiResource(true, 'Data Prodi Berhasil Diubah!', $Prodi);
    }

    public function destroy($id)
    {

        //find Prodi by ID
        $Prodi = Prodi::find($id);
        //delete Prodi
        $Prodi->delete();

        //return response
        return new ProdiResource(true, 'Data Prodi Berhasil Dihapus!', null);
    }
}
