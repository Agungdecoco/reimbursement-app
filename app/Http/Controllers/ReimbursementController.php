<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Reimbursement;
use Illuminate\Support\Facades\Storage;

class ReimbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('staff.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required',
            'reimbursement' => 'required|string',
            'desc' => 'required|string',
            'doc' => 'required|file|mimes:pdf,docx,jpg,jpeg,png',
        ]);

        $docName = time().'.'.$request->doc->extension();  
       
        $docPath = $request->doc->storeAs('uploads', $docName);

        // $carbonDate = Carbon::createFromFormat('Y-m-d', $request->date);
        // $carbonDate->setLocale('en');
        // $date = $carbonDate->format('d-m-Y');
        $status = 1;
        Reimbursement::create([
            'tanggal' => $request->date,
            'nama_reimbursement' => $request->reimbursement,
            'deskripsi' => $request->desc,
            'dokumen' => $docPath,
            'staff_nip' => auth()->user()->nip,
            'status' => $status
        ]);

        return redirect()->route('staff.home')->with('success', 'Pengajuan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $submission = Reimbursement::find($id);
        // dd($submission->all());
        if (!$submission) {
            return back()->with('error', 'Submission not found.');
        }
    
        $status = $request->input('status');
    
        // Perform validation on $status if needed
    
        $submission->status = $status;
        $submission->save();
    
        return back()->with('success', 'Submission status updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function download($filename)
    {
        
        // Tentukan direktori penyimpanan dokumen
        $storagePath = storage_path('app/'.$filename);

        // Periksa apakah file dokumen ada
        if (!Storage::exists($storagePath)) {
            return abort(404);
        }

        // Ambil nama file asli untuk memberikan nama file saat diunduh
        $originalName = basename($storagePath);

        // Mengirimkan file ke pengguna
        return response()->download($storagePath, $originalName);
    }
}
