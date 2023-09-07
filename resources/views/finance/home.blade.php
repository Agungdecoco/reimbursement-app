@extends('layouts.finance')

@section('content')
    <div class="title">
        {{-- <i class="uil uil-clock-three"></i> --}}
        <span class="text">Daftar Reimbursement</span>
    </div>
    <div class="activity-data text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tanggal</th>
                                <th scope="col">Nama Reimbursement</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Dokumen</th>
                                <th scope="col">Nama Staff</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $num = 1;
                            @endphp
                            @forelse ($submissions as $submission)
                                <tr>
                                    <td scope="row">{{ $num++ }}</td>
                                    <td>{{ $submission->tanggal }}</td>
                                    <td>{{ $submission->nama_reimbursement }}</td>
                                    <td>{{ $submission->deskripsi }}</td>
                                    <td>{{ $submission->dokumen }}</td>
                                    <td>{{ $submission->staff_nip }}</td>
                                    @if ($submission->status == 0)
                                        @php
                                            $status = 'DITOLAK';
                                        @endphp
                                    @elseif ($submission->status == 1)
                                        @php
                                            $status = 'DIAJUKAN';
                                        @endphp
                                    @elseif ($submission->status == 2)
                                        @php
                                            $status = 'DILANJUTKAN';
                                        @endphp
                                    @elseif ($submission->status == 3)
                                        @php
                                            $status = 'DITERIMA';
                                        @endphp
                                    @endif
                                    <td>{{ $status }}</td>
                                    <td>
                                        @if ($submission->status == 2)
                                            <!-- Assuming 1 means 'DIAJUKAN' -->
                                            <form action="{{ route('submission.update', $submission->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="3">
                                                <!-- 2 means 'DILANJUTKAN' -->
                                                <button type="submit" class="btn btn-success btn-sm">TERIMA</button>
                                            </form>
                                            <form action="{{ route('submission.update', $submission->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="status" value="0">
                                                <!-- 0 means 'DITOLAK' -->
                                                <button type="submit" class="btn btn-danger btn-sm">TOLAK</button>
                                            </form>
                                        @else
                                            <button class="btn btn-success btn-sm" disabled>DITERIMA</button>
                                            <button class="btn btn-danger btn-sm" disabled>DITOLAK</button>
                                        @endif
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
