<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Session\Store;

class ReserveConfirmController extends Controller
{
    public function index(Request $request)
    {
        $data = DB::table('reservation')
            ->where('reservation_idx',  $request->session()->get('idx'))
            ->first();

        $contract_db = DB::table('partner_contract_information')
            ->where('id', $data->partner_idx)
            ->first();

        return view('product.reserveconfirm', [
            'data' => $data,
            'contract' => $contract_db
        ]);
    }
}
