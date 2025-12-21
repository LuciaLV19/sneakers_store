<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // Mostrar todos los descuentos
    public function index()
    {
        $discounts = Discount::all();
        return view('admin.discounts.index', compact('discounts'));
    }

    // Formulario para crear un nuevo descuento
    public function create()
    {
        return view('admin.discounts.create');
    }

    // Guardar un nuevo descuento
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|unique:discounts,name|numeric|min:0|max:100',
        ]);

        Discount::create($request->all());

        return redirect()->route('admin.discounts.index')->with('success', 'Discount created successfully.');
    }

    // Mostrar un descuento específico
    public function show(Discount $discount)
    {
        return view('admin.discounts.show', compact('discount'));
    }

    // Formulario para editar un descuento
    public function edit(Discount $discount)
    {
        return view('admin.discounts.edit', compact('discount'));
    }

    // Actualizar un descuento
    public function update(Request $request, Discount $discount)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        $discount->update($request->all());

        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated successfully.');
    }

    // Eliminar un descuento
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discounts.index')->with('success', 'Discount deleted successfully.');
    }
}
