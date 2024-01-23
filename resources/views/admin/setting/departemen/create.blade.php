@extends('admin.layout.app')

@section('app')
    <section class="section">
        <div class="section-header">
            <h1>{{ $name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('departemen.index') }}">{{ $name }}</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('departemen.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="departemen_name">Departemen Name <span class="text-danger">*</span> </label>
                                    <input type="text"
                                        class="form-control form-control-sm @error('departemen_nama')
                                    is-invalid
                                @enderror"
                                        id="departemen_nama" placeholder="Masukan Nama Departemen"
                                        value="{{ old('departemen_nama') }}" name="departemen_nama" required>
                                    @error('departemen_nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="{{ route('departemen.index') }}" class="btn btn-sm btn-info mx-2"><i
                                            class="fa fa-reply-all"></i></a>
                                    <button type="submit" class="btn btn-sm btn-success">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
