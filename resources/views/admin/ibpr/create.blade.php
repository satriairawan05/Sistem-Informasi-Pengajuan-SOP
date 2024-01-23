@extends('admin.layout.app')

@section('app')
    <section class="section">
        <div class="section-header">
            <h1>{{ $name }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('ibpr.index') }}">{{ $name }}</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('ibpr.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="ibpr_nama">Name <span class="text-danger">*</span> </label>
                                    <input type="text"
                                        class="ibpr-control form-control-sm @error('form_nama')
                                    is-invalid
                                @enderror"
                                        id="ibpr_nama" placeholder="Masukan Nama" value="{{ old('ibpr_nama') }}"
                                        name="ibpr_nama" required>
                                    @error('ibpr_nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="ibpr_nomor">Nomor <span class="text-danger">*</span> </label>
                                    <input type="text"
                                        class="form-control form-control-sm @error('ibpr_nomor')
                                    is-invalidss
                                @enderror"
                                        id="ibpr_nomor" placeholder="Masukan Nomor" value="{{ old('ibpr_nomor') }}"
                                        name="ibpr_nomor" required>
                                    @error('ibpr_nomor')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="departemen_id">Departemen <span class="text-danger">*</span></label>
                                    <select class="form-control form-control-sm" name="departemen_id">
                                        @foreach ($departemen as $d)
                                            @if (old('departemen_id') == $d->departemen_id)
                                                <option value="{{ $d->departemen_id }}" selected>
                                                    {{ $d->departemen_name }}
                                                </option>
                                            @else
                                                <option value="{{ $d->departemen_id }}">{{ $d->departemen_nama }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="ibpr_file">File</label>
                                    <input type="file" name="ibpr_file" id="ibpr_file"
                                        class="form-control form-control-file">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="{{ route('ibpr.index') }}" class="btn btn-sm btn-info mx-2"><i
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

@push('js')
    <script src="{{ asset('assets/modules/dropzonejs/min/dropzone.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#departemen_id').select2();
        });
    </script>
@endpush
