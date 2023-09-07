@extends('layouts.staff')

@section('content')
    <div class="title">
        {{-- <i class="uil uil-clock-three"></i> --}}
        <span class="text">Tambah Reimbursement</span>
    </div>
    <div class="row justify-content-start">
        <div class="col-4">

            <form action="{{ route('staff.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="date" class="form-label">Tanggal</label>
                    <input type="date" class="form-control" id="date" name="date">
                </div>
                <div class="mb-3">
                    <label for="reimbursement" class="form-label">Nama Reimbursement</label>
                    <input type="text" class="form-control" id="reimbursement" name="reimbursement">
                </div>
                <div class="mb-3">
                    <label for="desc" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="desc" name="desc">
                </div>
                <div class="mb-3">
                    <label for="doc" class="form-label">Dokumen</label>
                    <input type="file" class="form-control" id="doc" name="doc">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    </div>
@endsection
