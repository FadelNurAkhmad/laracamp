<?php

namespace App\Http\Requests\User\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Set yang boleh akses hanya orang yg sudah login, kalau sudah login maka lanjut ke modul, kalau belum maka ke hal login
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $expiredValidation = date('Y-m', time()); // ambil sekarang tahun berap dan bulan berapa

        return [
            'name' => 'required|string', // validasi name wajib diisi
            'email' => 'required|email|unique:users,email,'.Auth::id().',id', // checkout kalau email dg id sama, gpp kalau sama, tidak error
            'occupation' => 'required|string',
            'card_number' => 'required|numeric|digits_between:8,16',
            'expired' => 'required|date|date_format:Y-m|after_or_equal:'.$expiredValidation, // memakai date yg sekarang biar dinamis, yaitu bulan sekarang atau setelahnya
            'cvc' => 'required|numeric|digits:3'
        ];
    }
}
