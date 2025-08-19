<?php

namespace App\Http\Controllers;

use App\Models\Disfraz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DisfrazController extends Controller
{
    // 👥 Cliente (Catálogo)
    public function index()
    {
        $cantidadCarrito = session('carrito') ? count(session('carrito')) : 0;
        $disfraces = Disfraz::all();

        return view('home', compact('cantidadCarrito', 'disfraces'));
    }

    // 📦 Admin - Inventario (listado completo)
    public function inventario()
    {
        $disfraces = Disfraz::all();
        return view('inventario.index', compact('disfraces'));
    }

    // ➕ Crear nuevo disfraz
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'talla' => 'required|string|max:3',
            'cantidad' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = $request->only(['nombre', 'descripcion', 'precio', 'talla', 'cantidad']);

        // 📸 Guardar imagen si existe
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('disfraces', 'public');
            $data['imagen'] = $path;
        }

        Disfraz::create($data);

        return redirect()->back()->with('success', 'Disfraz agregado correctamente');
    }

    // ✏️ Editar disfraz
    public function update(Request $request, $id)
    {
        $disfraz = Disfraz::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'talla' => 'required|string|max:3',
            'cantidad' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $data = $request->only(['nombre', 'descripcion', 'precio', 'talla', 'cantidad']);

        // 📸 Si sube nueva imagen, reemplazar
        if ($request->hasFile('imagen')) {
            // borrar la anterior si existe
            if ($disfraz->imagen && Storage::disk('public')->exists($disfraz->imagen)) {
                Storage::disk('public')->delete($disfraz->imagen);
            }

            $path = $request->file('imagen')->store('disfraces', 'public');
            $data['imagen'] = $path;
        }

        $disfraz->update($data);

        return redirect()->back()->with('success', 'Disfraz actualizado correctamente');
    }

    // 🗑️ Eliminar disfraz
    public function destroy($id)
    {
        $disfraz = Disfraz::findOrFail($id);

        // 🧹 Eliminar imagen asociada
        if ($disfraz->imagen && Storage::disk('public')->exists($disfraz->imagen)) {
            Storage::disk('public')->delete($disfraz->imagen);
        }

        $disfraz->delete();

        return redirect()->back()->with('success', 'Disfraz eliminado');
    }
}
