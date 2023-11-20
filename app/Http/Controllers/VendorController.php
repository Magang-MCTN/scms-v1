<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PengadaanController;
use App\Models\Pengadaan;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {

        return view('vendor-page.index');
    }
}
