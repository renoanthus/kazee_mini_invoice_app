<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Product;
use PDF;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

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
        $data['hari_ini'] = Carbon::now()->format('d/m/Y');
        $data['produk'] = Product::orderBy('nama_produk','asc')->get();
        $data['produk_invoice'] = null;
        return view('admin.invoice.create',$data);
    }

    public function data(Request $request)
    {
        $data = Invoice::with('products')->withCount('products')->latest('created_at');
        if ($request->kode_filter != null || $request->kode_filter != '') {
            $data = $data->where('id_invoice','like','%'.$request->kode_filter.'%');
        }
        if ($request->tanggal_filter != null || $request->tanggal_filter != '') {
            $tanggal = explode(' - ',$request->tanggal_filter);
            $tgl_start = Carbon::parse($tanggal[0])->startOfDay()->format('Y-m-d H:s');
            $tgl_end = Carbon::parse($tanggal[1])->endOfDay()->format('Y-m-d H:s');
            $data = $data->whereBetween('tanggal_invoice', [$tgl_start,$tgl_end]);
        }
        return datatables()::of($data)
            ->addColumn('aksi', function ($d) {
                $aksi = '';
                $aksi .= '
                    <a href="'.route('admin.invoice.show',$d->id_invoice).'" class="btn btn-xs waves-effect waves-light btn-info" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> 
                    <a href="'.route('admin.invoice.export',$d->id_invoice).'" class="btn btn-xs waves-effect waves-light btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-file-pdf"></i></a> 
                    <button type="button" class="btn btn-xs waves-effect waves-light btn-danger btn-hapus" data-id="' . $d->id_invoice . '" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></button>
                    ';
                return $aksi;
            })
            ->editColumn('tanggal_invoice', function ($d) {
                return Carbon::parse($d->tanggal_invoice)->format('d/m/Y');
            })
            ->editColumn('total_harga', function ($d) {
                $total = 0;
                foreach ($d->products as $key => $value) {
                    $total += $value->pivot->jumlah * $value->pivot->harga;
                }
                return 'Rp '.number_format($total,0,',','.');
            })
            ->addIndexColumn()
            ->rawColumns(['aksi','total_harga'])
            ->make(true);
    }

    public function export($id)
    {
        $data = Invoice::with('products')->find($id);
        
        $pdf = PDF::loadView('admin.invoice.export', compact('data'))->setPaper('a4', 'landscape');
        // return $pdf->stream(date('d-m-Y').'-laporan.pdf');
        return $pdf->download(date('d-m-Y h:i').'-laporan.pdf');
    }

    public function show($id)
    {
        $data['produk'] = Product::orderBy('nama_produk','asc')->get();
        $data['invoice'] = Invoice::with('products')->find($id);
        $data['produk_invoice'] = $data['invoice']->products;
        $data['hari_ini'] = Carbon::parse($data['invoice']->tanggal_invoice)->format('d/m/Y');
        return view('admin.invoice.create',$data);
    }

    public function store(Request $request)
    {
        try {
            $invoice = Invoice::updateOrCreate(
                [
                    'id_invoice'=> $request->id_invoice ?? 'iv'.Str::random(6),
                ],[
                    'tanggal_invoice'=> Carbon::createFromFormat('d/m/Y',$request->tanggal)->format('Y-m-d'),
                ]
            );
            $invoice->products()->detach();
            foreach ($request->produk_id as $key => $value) {
                $produk = Product::find($value);
                $invoice->products()->attach($value,[
                    'jumlah' => $request->jumlah_produk[$key],
                    'harga' => $produk->harga_produk,
                    'total_harga' => $request->jumlah_produk[$key]*$produk->harga_produk,
                ]);
            }
            Alert::success('Data berhasil disimpan');
            return redirect()->route('admin.invoice.index');
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return redirect()->back();
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
