<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // === Discounts code  ===
    public function discountsIndex()
    {
        // Lógica para obtener los descuentos existentes
        // $discounts = Discount::all(); 
        
        return view('admin.settings.discounts', [
            // 'discounts' => $discounts
        ]);
    }

    public function discountsStore(Request $request)
    {
        // Lógica para crear/actualizar un código de descuento
        // return redirect()->route('admin.discounts.index')->with('success', 'Descuento guardado.');
    }

    // === Envío y Tarifas ===
    public function shippingIndex()
    {
        // Lógica para obtener las configuraciones de envío
        // $shippingSettings = Shipping::first();

        return view('admin.settings.shipping', [
            // 'settings' => $shippingSettings
        ]);
    }

    public function shippingStore(Request $request)
    {
        // Lógica para guardar las nuevas tarifas o reglas de envío
        // return redirect()->route('admin.shipping.index')->with('success', 'Tarifas de envío actualizadas.');
    }
}