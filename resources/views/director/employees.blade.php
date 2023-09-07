@extends('layouts.director')

@section('content')
    <div class="title">
        {{-- <i class="uil uil-clock-three"></i> --}}
        <span class="text">Daftar Karyawan</span>
    </div>
    <a class="btn btn-primary mb-3" href="{{ route('employee.create') }}" role="button">Add Employee</a>
    <div class="activity-data text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card" style="max-width: 400px; width: 100%;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">NIP</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = 1;
                            @endphp
                            @forelse ($employees as $employee)
                                <tr>
                                    <td scope="row">{{ $num++ }}</td>
                                    <td>{{ $employee->nip }}</td>
                                    <td>{{ $employee->nama }}</td>
                                    <td>{{ $employee->jabatan }}</td>
                                    <td>
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('employee.destroy', $employee->nip) }}" method="POST">
                                            <a class="btn btn-sm btn-secondary" scope="col"
                                                href="{{ route('employee.edit', $employee->nip) }}">EDIT</a>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data belum Tersedia.
                                </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
