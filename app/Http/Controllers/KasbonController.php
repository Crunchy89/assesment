<?php

namespace App\Http\Controllers;

use App\Jobs\AddKasbon;
use Illuminate\Http\Request;
use App\Models\Kasbon;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class KasbonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // var_dump($request->bulan);
        // die;
        $validate = Validator::make($request->all(), [
            'bulan' => 'string|required|date_format:Y-m',
            'belum_disetujui' => 'integer|nullable',
        ]);
        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()], 422);
        }
        $arr = explode('-', $request->bulan);
        $bulan = $arr[1];
        $tahun = $arr[0];
        $data = Kasbon::whereMonth('kasbon.created_at', $bulan)
            ->whereYear('kasbon.created_at', $tahun)
            ->Where(function ($query) use ($request) {
                if ($request->belum_disetujui == 1)
                    $query->whereNull('kasbon.tanggal_disetujui');
                else
                    $query->whereNotNull('kasbon.tanggal_disetujui');
            })
            ->paginate(10);
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pegawai_id' => 'required|exists:pegawai,id|lama_bekerja|maks_kasbon',
            'total_kasbon' => 'integer|total_pinjam',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $data = Kasbon::create([
            'tanggal_diajukan' => now(),
            'pegawai_id' => $request->pegawai_id,
            'total_kasbon' => $request->total_kasbon,
        ]);
        if ($data)
            return response()->json($data, 201);
        else
            return response()->json(['error' => 'Gagal menambah data'], 500);
    }

    public function update(Request $request, $id)
    {
        $kasbon = Kasbon::whereId($id)->first();
        if ($kasbon) {
            if ($kasbon->tanggal_disetujui == null) {
                $kasbon->update([
                    'tanggal_disetujui' => now(),
                ]);
                return response()->json($kasbon, 200);
            }
            return response()->json(['error' => 'Kasbon sudah disetujui'], 200);
        } else
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }

    public function setujuiMasal(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'tanggal_diajukan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $data = Kasbon::whereMonth('kasbon.tanggal_diajukan', DB::raw("MONTH('$request->tanggal_diajukan')"))
            ->whereYEAR('kasbon.tanggal_diajukan', DB::raw("YEAR('$request->tanggal_diajukan')"))
            ->whereNull('kasbon.tanggal_disetujui')
            ->get();
        if ($data->count() > 0) {
            AddKasbon::dispatch($data);
            return response()->json(['pesan' => $data->count() . ' kasbon telah di setujui'], 200);
        }
        return response()->json(['error' => 'Semua Kasbon bulan ini telah disetujui'], 200);
    }
}
