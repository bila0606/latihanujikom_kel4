<?php

namespace App\Http\Controllers;

//LOAD MODEL
use App\Models\buku;
use App\Models\User;
//PACKAGE BAWAAN
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use Validator;
//LOAD PACKAGE EXCEL
use App\Imports\ImportDataBukuClass;
use App\Exports\DataBukuExportView;
use Excel;
//LOAD PACKAGE PDF
use PDF;

//LOAD HELPER
use Tanggal;
use Konversi;

class DataBukuController extends Controller
{
    public function __construct(){
        $this->Tanggal = new Tanggal();
        $this->Konversi = new Konversi();
    }
    public function index(Request $request)
    {
        $f1=$request->input('f1');
        $data = buku::select('*');
        if($f1){
            $data->where('kategori_id','=',''.$f1.'')->get();
        }
        $data = $data->get();
        return view('data_buku.index',['data'=>$data]);
    }


    public function input(Request $request)
    {
        return view('data_buku.formInput');
    }

    public function create(Request $request)
    {
        $isrole=auth()->user()->isrole;
        //DECLARE REQUEST
        $judul = $request->input('judul');
        $penulis = $request->input('penulis');
        $penerbit = $request->input('penerbit');
        $tahun_terbit = $request->input('tahun_terbit');

        //COSTUM REQUEST
        if($tahun_terbit){
            $tahun_terbit=$this->Tanggal->tanggalDatabase($tahun_terbit);
        }else{
            $tahun_terbit=null;
        }
    

        //VALIDATION FORM
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:15|unique:buku,judul',
            'penulis' => 'nullable|max:255',
            'penerbit' => 'nullable|max:5|numeric',
            'tahun_terbit' => 'date_format:d/m/Y',
        ]);
        if ($validator->fails()) {
            $errormessage='';
            foreach ($validator->errors()->all() as $message) {
                $errormessage.='<li>'.$message.'</li>';
            }
            //NOT VALID
            return back()
            ->with('failed','Harap periksa kembali!. <ul>'.$errormessage.'</ul>')->withInput();
        }

        
        try {
            $data =  new DtBarang();
            $data->created_us   = auth()->user()->id;
            $data->updated_us   = auth()->user()->id;
            $data->judul         = $judul;
            $data->penulis       = $penulis;
            $data->penerbit  = $penerbit;
            $data->tahun_terbit = $tahun_terbit;
            $data->deskripsi    = $deskripsi;
            $data->status       = $status;
            // SAVE THE DATA
            if ($data->save()) {
                // SUCCESS
                return redirect()
                ->route('data_buku.edit',['id' => $data->id])
                ->with('success', 'Data berhasil disimpan');
            }
		}
		catch(Exception $e){
            //ERROR
			return back()
            ->withInput()
            ->with('error','Gagal memproses!');
		}
    }
    
    public function edit($id)
    {
        // GET THE DATA BASED ON ID
        $data = buku::find($id);
        // CHECK IS DATA FOUND
        if (!$data) {
            // DATA NOT FOUND
            return back()
                ->withInput()
                ->with('error', 'item not found!');
        }
        return view('data_buku.formEdit', compact('data','id'));
    }


    public function update($id, Request $request)
    {
        // CHECK OBJECT ID
        if ((int) $id < 1) {
            // INVALID OBJECT ID
            return redirect()
                ->route('data_buku')
                ->with('error', 'item not found!');
        }
        $isrole=auth()->user()->isrole;
        
        //DECLARE REQUEST
        $judul = $request->input('judul');
        $penulis = $request->input('penulis');
        $penerbit = $request->input('penerbit');
        $tahun_terbit = $request->input('tahun_terbit');
        $deskripsi = $request->input('deskripsi');
        $status = $request->input('status');
      

        //COSTUM REQUEST
        if($tahun_terbit){
            $tahun_terbit=$this->Tanggal->tanggalDatabase($tahun_terbit);
        }else{
            $tahun_terbit=null;
        }
        
   
        // GET THE DATA BASED ON ID
        $data = buku::find($id);
        // CHECK IS DATA FOUND
        if (!$data) {
            // DATA NOT FOUND
            return back()
                ->withInput()
                ->with('error', 'item not found!');
        }
        
        $id_b=$data->id??'';

        //VALIDATION FORM
        $validator = Validator::make($request->all(), [
            'judul' => 'required|max:15|unique:buku,judul,'.$id_b,
            'penulis' => 'nullable|max:255',
            'penerbit' => 'nullable|max:5|numeric',
            'tahun_terbit' => 'date_format:d/m/Y',
            
        ]);
        if ($validator->fails()) {
            $errormessage='';
            foreach ($validator->errors()->all() as $message) {
                $errormessage.='<li>'.$message.'</li>';
            }
            //NOT VALID
            return back()
            ->withInput()
            ->with('failed','Harap periksa kembali!. <ul>'.$errormessage.'</ul>');
        }

        

        try {
            $data->updated_us   = auth()->user()->id;
            $data->judul         = $judul;
            $data->penulis         = $penulis;
            $data->penerbit  = $penerbit;
            $data->tahun_terbit = $tahun_terbit;
            $data->deskripsi    = $deskripsi;
            $data->status       = $status;
            // SAVE THE DATA
            if ($data->save()) {
                // SUCCESS
                return redirect()
                ->route('data_buku.edit',['id' => $data->id])
                ->with('success', 'Data berhasil disimpan');
            }
		}
		catch(Exception $e){
            // ERROR
			return back()
            ->withInput()
            ->with('error','Gagal memproses!');
		}
    }


    public function destroy($id)
    {
        // CHECK OBJECT ID
        if ((int) $id < 1) {
            // INVALID OBJECT ID
            return redirect()
                ->route('data_buku')
                ->with('error', 'item not found!');
        }

        $db = buku::where('id', $id);
        $cek = $db->count();
        $data = $db->first();
        $file_b = $data->img??'';
        
            // SUCCESS
            return redirect()
            ->route('data_buku')
            ->with('success', 'Data berhasil dihapus');
        }
        catch(Exception $e){
            // ERROR
			return back()
            ->withInput()
            ->with('error','Gagal memproses!');
		}
    }


    public function import_excel(Request $request)
    {
        //DECLARE REQUEST
        $file = $request->file('file');

        //VALIDATION FORM
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        try {
            if($file){
                // IMPORT DATA
                $import = new ImportDataBarangClass;
                Excel::import($import, $file);
                
                // SUCCESS
                $notimportlist="";
                if ($import->listgagal) {
                    $notimportlist.="<hr> Not Register : <br> {$import->listgagal}";
                }
                return redirect()
                ->route('data_barang')
                ->with('success', 'Import Data berhasil,<br>
                Size '.$file->getSize().', File extention '.$file->extension().',
                Insert '.$import->insert.' data, Update '.$import->edit.' data,
                Failed '.$import->gagal.' data, <br> '.$notimportlist.'');

            } else {
                // ERROR
                return back()
                ->withInput()
                ->with('error','Gagal memproses!');
            }
            
		}
		catch(Exception $e){
			// ERROR
			return back()
            ->withInput()
            ->with('error','Gagal memproses!');
		}

    }

    public function export_excel(Request $request)
    {
        //DECLARE REQUEST
        $f1=$request->input('f1');
        //QUERY
        $data = DtBarang::select('*');
        if($f1){
            $data->where('kategori_id','=',''.$f1.'')->get();
        }
        $data = $data->get();

        // Pass parameters to the export class
        $export = new DataBarangExportView($data);
        
        // SET FILE NAME
        $filename = date('YmdHis') . '_data_barang';
        
        // Download the Excel file
        return Excel::download($export, $filename . '.xlsx');
    }

     public function export_pdf(Request $request)
    {
        //DECLARE REQUEST
        $f1=$request->input('f1');
        //QUERY
        $data = DtBarang::select('*');
        if($f1){
            $data->where('kategori_id','=',''.$f1.'')->get();
        }
        $data = $data->get();

        // Pass parameters to the export view
        $pdf = PDF::loadview('data_barang.exportPdf', ['data'=>$data]);
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // SET FILE NAME
        $filename = date('YmdHis') . '_data_barang';
        // Download the Pdf file
        return $pdf->download($filename.'.pdf');
    }

    
