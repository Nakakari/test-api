<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataMasterController extends Controller
{
    public function index()
    {
        return view('produk');
    }

    public function list()
    {
        $columns = [
            'id',
            'name',
            'price',
            'stock',
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = Product::select([
            '*'
        ])->orderBy('id', "asc")->first();

        $recordsFiltered = $data->get()->count();

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(products.name) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
            });
        }

        $data = $data
            ->skip(request()->input('start'))
            ->take(request()->input('length'))
            ->orderBy($orderBy, request()->input("order.0.dir"))
            ->get();
        $recordsTotal = $data->count();

        return response()->json([
            'draw' => request()->input('draw'),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data,
            'all_request' => request()->all()
        ]);
    }

    public function tambah(Request $request)
    {
        // dd(request()->all());
        $this->validate($request, [
            'name'  => ['required'],
            'price' => ['required', 'max:10'],
            'stock' => ['required', 'max:5']
        ]);
        $produk = [
            'name' => request()->get('name'),
            'price' => request()->get('price'),
            'stock' => request()->get('stock')
        ];
        DB::table('products')->insert($produk);
        return response()->json(true);
    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'name'  => ['required'],
            'price' => ['required', 'max:10'],
            'stock' => ['required', 'max:5']
        ]);
        $produk = [
            'name' => request()->get('name'),
            'price' => request()->get('price'),
            'stock' => request()->get('stock')
        ];
        DB::table('products')->where('id', request()->get('id'))
            ->update($produk);
        return response()->json(true);
    }

    public function hapus()
    {
        $item = Product::findOrFail(request()->input('id'));
        $item->delete();
        return response()->json(true);
    }
}
