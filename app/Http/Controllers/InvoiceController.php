<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.invoice.index');
    }

    public function create()
    {
        $data['hari_ini'] = Carbon::now()->format('Y-m-d');
        $data['produk'] = Product::orderBy('nama_produk','asc')->get();
        return view('admin.invoice.create',$data);
    }

    public function data(Request $request)
    {
        $data = Invoice::latest('created_at');
        // dd( $request->kode_filter);
        if ($request->nama_filter != null || $request->nama_filter != '') {
            $data = $data->where('nama_produk','like','%'.$request->nama_filter.'%');
        }
        if ($request->kode_filter != null || $request->kode_filter != '') {
            $data = $data->where('kode_produk', 'like','%'.$request->kode_filter.'%');
        }
        return datatables()::of($data)
            ->addColumn('aksi', function ($d) {
                $aksi = '';
                $aksi .= '
                    <button type="button" class="btn btn-xs waves-effect waves-light btn-info btn-ubah" data-id="' . $d->id . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button> 
                    ';
                if ($d->invoice_count > 1) {
                    $aksi .= '
                        <button type="button" class="btn btn-xs waves-effect waves-light btn-danger" disabled data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>';
                } else {
                    $aksi .= '
                    <button type="button" class="btn btn-xs waves-effect waves-light btn-danger btn-hapus" data-id="' . $d->id . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                    ';
                }
                return $aksi;
            })
            ->addIndexColumn()
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show($id)
    {
        return Invoice::find($id);
    }

    public function store(Request $request)
    {
        $data = $request->except('foto_produk');
        $data = array_map('strip_tags', $data);
        DB::beginTransaction();
        try {
            $validated = $request->validate([
                'nama_produk'       => 'required',
                'kode_produk'       => 'required',
                'harga_produk'      => 'required',
                'sisa_stok'         => 'required',
                'keterangan_produk' => 'required',
            ], [
                'nama_produk.required'          => 'Nama produk harus diisi',
                'kode_produk.required'          => 'Kode produk harus diisi',
                'harga_produk.required'         => 'Harga produk harus diisi',
                'sisa_stok.required'            => 'Sisa stok harus diisi',
                'keterangan_produk.required'    => 'Keterangan produk harus diisi',
            ]);
            if ($validated) {

                Invoice::updateOrCreate([
                    'id' => $data['id'],
                ],$data);
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'Berhasil Disimpan',
            ], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 200);
        }
    }

    public function delete(Request $request)
    {
        $data = Invoice::find($request->id);
        if ($data) {
            $file_path = public_path() . '/' . $data->foto_produk;
            if (File::exists($file_path)) {
                File::delete($file_path);
            }
            $data->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data Berhasil Dihapus',
            ], 200);
        }
        return response()->json([
            'status' => false,
            'message' => 'Data tidak ditemukan',
        ], 200);
    }
}
