<?php

namespace App\Http\Controllers\Items;


use App\Models\StockCount;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\FullStockCountExport;
use App\Exports\PartialStockCountExport;
use Maatwebsite\Excel\Facades\Excel;

class StockCountController extends Controller
{

    public function index()
    {
        $stockcounts = StockCount::with('warehouse')->orderBy('id', 'DESC')->paginate(10);;
        return view('items.stock-count',compact('stockcounts'));
    }
    public function InitialFile(Request $request)
    {
        $request->validate([
            'warehouse' => 'required',
            'type'      => 'required',
            'category'  => 'nullable'
        ]);
        $filename = date('Ymd').'-WH'.$request->warehouse.'-'.uniqid('SC').'.xlsx';
        if($request->type == 1)
        {
            Excel::store(new FullStockCountExport($request->warehouse), $filename, 'real_public');
        }elseif($request->type == 2)
        {
            Excel::store(new PartialStockCountExport($request->warehouse , $request->category), $filename, 'real_public');
        }
        $stock = StockCount::insertOrIgnore([
            'date'  =>  date('Y-m-d'),
            'initial_file'  =>  $filename,
            'type'  =>  $request->type,
            'warehouse_id'  =>  $request->warehouse,
        ]);
        return redirect()->back();
    }
    public function UploadFinalFile(Request $request,$StockCountId)
    {
        $file = $request->file('final_file');
        $NameWithoutExt = preg_replace('/\.\w+$/', '', $file->getClientOriginalName());
        $filename = $NameWithoutExt.'-final.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('files/excel/');
        $file->move($destinationPath,$filename);
        $stockcount = StockCount::find($StockCountId);
        $stockcount->final_file = $filename;
        $stockcount->save();
        return redirect()->back();
    }

    public function DownloadFile($filename)
{
    $file= public_path('files/excel/').$filename;
    return response()->download($file, $filename);
}
}
