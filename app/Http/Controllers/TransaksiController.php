<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    //
    public function index()
    {
        return view('transaksi');
    }

    public function list()
    {
        $columns = [
            'id',
            'status',
            'reference_number',
            'quantity',
            'price',
            'total_price',
            'user_id',
            'product_id',
        ];
        $orderBy = $columns[request()->input("order.0.column")];
        $data = Transaksi::select([
            '*'
        ])->orderBy('id', "asc")->first();

        $recordsFiltered = $data->get()->count();

        if (request()->input("search.value")) {
            $data = $data->where(function ($query) {
                $query->whereRaw('LOWER(transaksi.price) like ?', ['%' . strtolower(request()->input("search.value")) . '%']);
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
            'price' => 'required',
            'stock' => 'required'
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
            'price' => 'required',
            'stock' => 'required'
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
