<?php

namespace App\Http\Controllers;

use App\Models\Aporte;
use App\Models\Comunario;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalComunarios = Comunario::count();

        $comunariosActivos = Comunario::where('estado', true)
            ->count();

        $totalAportesActivos = Aporte::where('estado', 'activo')
            ->count();

        return view('dashboard', compact(
            'totalComunarios',
            'comunariosActivos',
            'totalAportesActivos'
        ));
    }
}