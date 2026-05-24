<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan ini untuk hapus gambar lama nanti

class ProductController extends Controller
{
    public function index() : View
    {
        $products = Product::latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        return view('products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // 1. Validasi
        $request->validate([
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric'
        ]);

        // 2. Upload Image ke folder PUBLIC (agar tidak forbidden)
        $image = $request->file('image');
        // Tambahkan 'public' sebagai parameter kedua
        $image->storeAs('public/products', $image->hashName());

        // 3. Simpan ke Database
        Product::create([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);

        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show(string $id): View
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Method untuk menampilkan form edit
public function edit(string $id): View
{
    $product = Product::findOrFail($id);
    return view('products.edit', compact('product'));
}

// Method untuk memproses update data ke database
public function update(Request $request, $id): RedirectResponse
{
    // Validasi data
    $request->validate([
        'image'         => 'image|mimes:jpeg,jpg,png|max:2048',
        'title'         => 'required|min:5',
        'description'   => 'required|min:10',
        'price'         => 'required|numeric',
        'stock'         => 'required|numeric'
    ]);

    $product = Product::findOrFail($id);

    // Cek jika ada gambar baru yang diupload
    if ($request->hasFile('image')) {

        // Upload gambar baru
        $image = $request->file('image');
        $image->storeAs('public/products', $image->hashName());

        // Hapus gambar lama
        Storage::delete('public/products/'.$product->image);

        // Update data dengan gambar baru
        $product->update([
            'image'         => $image->hashName(),
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);

    } else {
        // Update data tanpa ganti gambar
        $product->update([
            'title'         => $request->title,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock
        ]);
    }

    return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
}

    public function landing()
    {
        $products = Product::latest()->get();
        return view('landing.index', compact('products'));
    }

public function destroy($id): RedirectResponse
{
    $product = Product::findOrFail($id);

    // Hapus file gambar dari storage
    Storage::delete('public/products/' . $product->image);

    // Hapus data dari database
    $product->delete();

    return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
}

    
}