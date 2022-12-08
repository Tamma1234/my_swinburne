<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function index() {
        $provinces = Province::all();
        return view('admin.province.index', compact('provinces'));
    }
}
