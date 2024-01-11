@extends('admin.layout.app')

@php
    $create = 0;
    $read = 0;
    $update = 0;
    $delete = 0;

    foreach ($pages as $r) {
        if ($r->page_name == $name) {
            if ($r->action == 'Create') {
                $create = $r->access;
            }

            if ($r->action == 'Read') {
                $read = $r->access;
            }

            if ($r->action == 'Update') {
                $update = $r->access;
            }

            if ($r->action == 'Delete') {
                $delete = $r->access;
            }
        }
    }
@endphp

@section('app')
    <section class="section">
        <div class="section-header">
            <h1>{{ $name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">{{ $name }}</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                @if ($create == 1)
                    <div class="d-flex justify-content-end mx-3 my-2">
                        <a href="{{ route('sop.create') }}" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
                    </div>
                @endif
                @if ($read == 1)
                    <div class="card-body">
                        <table class="table-bordered table" id="myTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Nomor</th>
                                    <th>Departemen</th>
                                    <th>Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sop as $s)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->sop_nama }}</td>
                                        <td>{{ $s->sop_nomor }}</td>
                                        <td>{{ $s->departemen_name }}</td>
                                        <td>
                                            <a href="{{ route('sop.show', $s->sop_id) }}" class="btn btn-sm btn-info"
                                                target="__blank"><i class="fa fa-file-pdf"></i></a>
                                            {{-- <a href="{{ route('sop.download', $s->sop_id) }}"
                                                class="btn btn-sm btn-secondary"><i class="fa fa-file-download"></i></a> --}}
                                            @if ($update == 1)
                                                <a href="{{ route('sop.edit', $s->sop_id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                                            @endif
                                            @if ($delete == 1)
                                                <form action="{{ route('sop.destroy', $s->sop_id) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                                            class="fa fa-trash"></i></button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#myTable").dataTable({
                "columnDefs": [{
                    "sortable": true
                }]
            });
        });
    </script>
@endpush
