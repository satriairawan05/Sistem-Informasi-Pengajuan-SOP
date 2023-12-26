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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
