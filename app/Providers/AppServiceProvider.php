<?php

namespace App\Providers;

use App\Models\Kasbon;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Validator::extend('lama_bekerja', function ($attribute, $value, $parameters, $validator) {
            $data = Pegawai::whereRaw("tanggal_masuk <= DATE_SUB(NOW(),INTERVAL 1 YEAR)")->where('id', $value)->first();
            if ($data)
                return true;
            return false;
        });
        Validator::replacer('lama_bekerja', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, __('Pegawai belum bekerja lebih dari 1 tahun'));
        });
        Validator::extend('maks_kasbon', function ($attribute, $value, $parameters, $validator) {
            $data = Kasbon::where('pegawai_id', $value)->get()->count();
            if ($data < 3)
                return true;
            return false;
        });
        Validator::replacer('maks_kasbon', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, __('Pegawai sudah mengajukan 3 kali kasbon'));
        });
        Validator::extend('total_pinjam', function ($attribute, $value, $parameters, $validator) {
            $id = $validator->getData()['pegawai_id'];
            $total_gaji = Pegawai::whereId($id)->first();
            if ($total_gaji) {
                $data = Kasbon::selectRaw('SUM(total_kasbon) as total')
                    ->whereRaw('MONTH(created_at) = MONTH(NOW())')
                    ->where('pegawai_id', $id)
                    ->first();
                if (($data->total + $value) <= ($total_gaji->getRawOriginal('total_gaji') * 0.5))
                    return true;
                return false;
            }
        });
        Validator::replacer('total_pinjam', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, __('Total pinjaman melebihi 50% gaji'));
        });
    }
}
