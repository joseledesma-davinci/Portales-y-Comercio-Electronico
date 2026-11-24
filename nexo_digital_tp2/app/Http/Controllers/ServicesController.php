<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Contracts\View\View;

/**
 * Controlador de catálogo público de servicios.
 */
class ServicesController extends Controller
{
    /**
     * Lista los servicios activos para usuarios públicos.
     */
    public function index(): View
    {
        $services = Service::query()
            ->where('is_active', true)
            ->orderBy('price')
            ->get();

        return view('services.index', [
            'services' => $services,
        ]);
    }

    /**
     * Muestra el detalle de un servicio específico.
     */
    public function show(int $id): View
    {
        $service = Service::query()
            ->where('is_active', true)
            ->findOrFail($id);

        return view('services.show', [
            'service' => $service,
        ]);
    }
}
