<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Exception;
use Illuminate\Support\Carbon;
use App\Helpers\ApiFormatter;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    public function getResepObat(Request $request)
    {
        try {
            $data = DB::table('resep_obat')
            ->whereDate('tgl_peresepan', now())
            ->get();
        } catch (Exception $errmsg) {
            return ApiFormatter::createAPI(400, 'Failed' . $errmsg);
        }
        return ApiFormatter::createAPI(200, 'Success', $data);
    }
    // END DATA IKT
}
