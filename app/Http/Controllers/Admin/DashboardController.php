<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\Donatur;

class DashboardController extends Controller
{
    public function index()
    {
        // memanggil untuk menghitung semua data di tabel donatur 
        $donaturs = Donatur::count();

        // memanggil untuk menghitung semua data dari campaign
        $campaigns = Campaign::count();

        // memanggil untuk menghitung semua data dari donasi
        $donations = Donation::where('status', 'success')->sum('amount');

        return view('admin.dashboard.index', compact('donaturs', 'campaigns', 'donations'));
    }
}
