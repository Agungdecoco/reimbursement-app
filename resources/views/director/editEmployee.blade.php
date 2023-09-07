@extends('layouts.director')

@section('content')
    <div class="title">
        {{-- <i class="uil uil-clock-three"></i> --}}
        <span class="text">Edit Karyawan</span>
    </div>
    <div class="row justify-content-start">
        <div class="col-4">
            @foreach ($attributes as $attr)
                <form action="{{ route('employee.update', $attr->nip) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nip" class="form-label">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ $attr->nip }}"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label for="employee_name" class="form-label">Nama Karyawan</label>
                        <input type="text" class="form-control" id="employee_name" name="employee_name"
                            value="{{ $attr->nama }}">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Jabatan</label>
                        <select class="form-select" aria-label="jabatan" id="role" name="role">
                            <option selected value="{{ $attr->jabatan }}">{{ $attr->jabatan }}</option>
                            <option value="FINANCE">FINANCE</option>
                            <option value="STAFF">STAFF</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            @endforeach
        </div>
    </div>
@endsection
