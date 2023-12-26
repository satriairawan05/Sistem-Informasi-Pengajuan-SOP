@extends('admin.layout.app')

@section('app')
    <section class="section">
        <div class="section-header">
            <h1>Name</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('account.index') }}">{{ $name }}</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('account.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="name">Name <span class="text-danger">*</span> </label>
                                    <input type="text"
                                        class="form-control form-control-sm @error('name')
                                    is-invalid
                                @enderror"
                                        id="name" placeholder="Masukan Nama" value="{{ old('name') }}" name="name"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="email">Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email"
                                        class="form-control form-control-sm @error('email')
                                    is-invalid
                                @enderror"
                                        id="email" placeholder="Masukan Email" value="{{ old('email') }}"
                                        name="email" required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <div id="showHidePassword">
                                        <input type="password"
                                            class="form-control form-control-sm @error('password')
                                    is-invalid
                                @enderror"
                                            id="password" placeholder="Masukan Password" value="{{ old('password') }}"
                                            name="password" required autocomplete="new-password">
                                        <a href="javascript:;" id="togglePassword" class="bg-transparent"><i
                                                class="ti ti-lock"></i></a>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <label for="password-confirm">Confirm Password <span
                                            class="text-danger">*</span></label>
                                    <div id="showHidePassword">
                                        <input type="password"
                                            class="form-control form-control-sm @error('password')
                                    is-invalid
                                @enderror"
                                            id="password-confirm" placeholder="Masukan Password"
                                            value="{{ old('password') }}" name="password_confirmation" required
                                            autocomplete="new-password">
                                        <a href="javascript:;" id="togglePasswordConfirm" class="bg-transparent"><i
                                                class="ti ti-lock"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12">
                                    <label for="nik">NIK <span class="text-danger">*</span></label>
                                    <input type="text"
                                        class="form-control form-control-sm @error('nik')
                                    is-invalid
                                @enderror"
                                        id="nik" placeholder="Masukan NIK" value="{{ old('nik') }}" name="nik"
                                        required>
                                    @error('nik')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="departemen_id">Departemen <span class="text-danger">*</span></label>
                                    <select class="select2 form-control form-control-sm" name="departemen_id">
                                        @foreach ($departemen as $d)
                                            @if (old('departemen_id') == $d->departemen_id)
                                                <option value="{{ $d->departemen_id }}" selected>
                                                    {{ $d->departemen_name }}
                                                </option>
                                            @else
                                                <option value="{{ $d->departemen_id }}">{{ $d->departemen_name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label for="group_id">Role <span class="text-danger">*</span></label>
                                    <select class="select2 form-control form-control-sm" name="group_id">
                                        @foreach ($group as $d)
                                            @if (old('group_id') == $d->group_id)
                                                <option value="{{ $d->group_id }}" selected>{{ $d->group_name }}
                                                </option>
                                            @else
                                                <option value="{{ $d->group_id }}">{{ $d->group_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="{{ route('user.index') }}" class="btn btn-sm btn-info mx-2"><i
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

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">
    <style type="text/css">
        #showHidePassword {
            position: relative;
        }

        #togglePassword,
        #togglePasswordConfirm {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();

            $('#togglePassword i').click(function(event) {
                event.preventDefault();
                const passwordInput = $('#password');
                const togglePassword = $('#togglePassword i');

                if (passwordInput.attr('type') === 'text') {
                    passwordInput.attr('type', 'password');
                    togglePassword.removeClass('ti-unlock').addClass('ti-lock');
                } else if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    togglePassword.removeClass('ti-lock').addClass('ti-unlock');
                }
            });

            $('#togglePasswordConfirm i').click(function(event) {
                event.preventDefault();
                const passwordConfirmInput = $('#password-confirm');
                const toggleConfirmPassword = $('#togglePasswordConfirm i');

                if (passwordConfirmInput.attr('type') === 'text') {
                    passwordConfirmInput.attr('type', 'password');
                    toggleConfirmPassword.removeClass('ti-unlock').addClass('ti-lock');
                } else if (passwordConfirmInput.attr('type') === 'password') {
                    passwordConfirmInput.attr('type', 'text');
                    toggleConfirmPassword.removeClass('ti-lock').addClass('ti-unlock');
                }
            });
        });
    </script>
@endpush
