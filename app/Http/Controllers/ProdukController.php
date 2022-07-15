<?php

namespace App\Http\Controllers;
use App\Models\Produk; 
use Illuminate\Http\Request;
use DB;

class ProdukController extends Controller
{
    public function sort(){
        $produks = Produk ::orderBy('created_at','desc')->get();
    }

    public function data() {
        return Produk::all();
    }

    public function index(){
    $produks = Produk::orderBy('harga','asc')
        ->orderBy('rating','asc')
        ->orderBy('likes','asc')
        ->get();
    return view('index', compact('produks'));
    }

    public function create()
    {
        return view('produks.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:155',
            'harga' => 'required',
            'rating' => 'required',
            'likes' => 'required'
        ]);

        $produks = Produk::create([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'rating' => $request->rating,
            'likes' => $request->likes,
        ]);

        if ($produks) {
            return redirect()
                ->route('produk.index')
                ->with([
                    'success' => 'New post has been created successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem occurred, please try again'
                ]);
        }
    }

    public function edit($id)
    {
        $produks = Produk::findOrFail($id);
        return view('produks.edit', compact('produks'));
    }

    public function detail($id)
    {
        $produks = Produk::findOrFail($id);
        return view('produks.detail', compact('produks'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required|string|max:155',
            'harga' => 'required',
            'rating' => 'required',
            'likes' => 'required'
        ]);

        $produks = Produk::findOrFail($id);

        $produks->update([
            'nama' => $request->nama,
            'harga' => $request->harga,
            'rating' => $request->rating,
            'likes' => $request->likes,
        ]);

        if ($produks) {
            return redirect()
                ->route('produk.index')
                ->with([
                    'success' => 'Post has been updated successfully'
                ]);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->with([
                    'error' => 'Some problem has occured, please try again'
                ]);
        }
    }

    public function destroy($id)
    {
        $produks = Produk::findOrFail($id);
        $produks->delete();

        if ($produks) {
            return redirect()
                ->route('produk.index')
                ->with([
                    'success' => 'Produk has been deleted successfully'
                ]);
        } else {
            return redirect()
                ->route('produk.index')
                ->with([
                    'error' => 'Some problem has occurred, please try again'
                ]);
        }
    }

}
