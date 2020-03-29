<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;

class MahasiswaController extends Controller
{
    public function getAllMahasiswa(Request $request) {
        $mahasiswa = Mahasiswa::paginate(10);

        if (!$mahasiswa->isEmpty()) {
            $res['result'] = true;
            $res['message'] = "Berhasil mendapatkan Mahasiswa";
        } else {
            $res['result'] = false;
            $res['message'] = "Gagal mendapatkan Mahasiswa";
        }

        $res['data'] = $mahasiswa;

        return response()->json($res);
    }

    public function searchMahasiswa(Request $request) {
        // $request == data yang dikirim dari postman/semisalnya
        $keyword = $request->q;

        $mahasiswa = Mahasiswa::where('nama', 'like', '%'.$keyword.'%')
                            ->orWhere('telp', 'like', '%'.$keyword.'%')
                            ->orWhere('alamat', 'like', '%'.$keyword.'%')
                            ->get();

        if ($mahasiswa->isEmpty()) {
            $res['result'] = false;
            $res['message'] = "Gagal mendapatkan Mahasiswa";
        } else {
            $res['result'] = true;
            $res['message'] = "Berhasil mendapatkan Mahasiswa";
        }

        $res['data'] = $mahasiswa;

        return response()->json($res);
    }

    public function mahasiswaById(Request $request) {
        $mahasiswa = Mahasiswa::find($request->id);

        if (empty($mahasiswa)) {
            $res['result'] = false;
            $res['message'] = "Gagal mendapatkan Mahasiswa";
        } else {
            $res['result'] = true;
            $res['message'] = "Berhasil mendapatkan Mahasiswa";
        }

        $res['data'] = $mahasiswa;

        return response()->json($res);
    }

    public function addMahasiswa(Request $request) {
        $nama = $request->nama;
        $telp = $request->telp;
        $alamat = $request->alamat;

        $mahasiswa = new Mahasiswa();
        $mahasiswa->nama = $nama;
        $mahasiswa->telp = $telp;
        $mahasiswa->alamat = $alamat;

        if ($mahasiswa->save()) {
            $res['result'] = true;
            $res['message'] = "Berhasil menyimpan Mahasiswa";
        } else {
            $res['result'] = false;
            $res['message'] = "Gagal menyimpan Mahasiswa";
        }

        $res['data'] = $mahasiswa;
        return response()->json($res);

    }

    public function editMahasiswa(Request $request) {
        $id = $request->id;
        $nama = $request->nama;
        $telp = $request->telp;
        $alamat = $request->alamat;

        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nama = $nama;
        $mahasiswa->telp = $telp;
        $mahasiswa->alamat = $alamat;

        if ($mahasiswa->update()) {
            $res['result'] = true;
            $res['message'] = "Berhasil menyimpan Mahasiswa";
        } else {
            $res['result'] = false;
            $res['message'] = "Gagal menyimpan Mahasiswa";
        }

        $res['data'] = $mahasiswa;
        return response()->json($res);
    }

    public function deleteMahasiswa(Request $request) {
        $id = $request->id;

        $mahasiswa = Mahasiswa::find($id);

        $res['result'] = false;
        $res['message'] = "Gagal menghapus Mahasiswa";

        if ($mahasiswa != null) {
            if ($mahasiswa->delete()) {
                $res['result'] = true;
                $res['message'] = "Berhasil menghapus Mahasiswa";
            }
        }

        return response()->json($res);
    }
}
