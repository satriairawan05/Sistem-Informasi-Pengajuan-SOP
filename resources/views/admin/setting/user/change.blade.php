@extends('admin.layout.app')

@section('app')
    <section class="section">
        <div class="section-header">
            <h1>Name</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('account.index') }}">{{ $name }}</a></div>
                <div class="breadcrumb-item">Change Password</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('account.change_password',$user->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="form-group">
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
                            <div class="row">
                                <div class="col-12 d-flex justify-content-center">
                                    <a href="{{ route('account.index') }}" class="btn btn-sm btn-info mx-2"><i
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
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2();

            $('#togglePassword i').click(function(event) {
                event.preventDefault();
                const passwordInput = $('#password');
                const togglePassword = $('#togglePassword i');

                if (passwordInput.attr('type') === 'text') {
                    passwordInput.attr('type', 'password');
                    togglePassword.removeClass('fa-unlock').addClass('fa-lock');
                } else if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    togglePassword.removeClass('fa-lock').addClass('fa-unlock');
                }
            });

            $('#togglePasswordConfirm i').click(function(event) {
                event.preventDefault();
                const passwordConfirmInput = $('#password-confirm');
                const toggleConfirmPassword = $('#togglePasswordConfirm i');

                if (passwordConfirmInput.attr('type') === 'text') {
                    passwordConfirmInput.attr('type', 'password');
                    toggleConfirmPassword.removeClass('fa-unlock').addClass('fa-lock');
                } else if (passwordConfirmInput.attr('type') === 'password') {
                    passwordConfirmInput.attr('type', 'text');
                    toggleConfirmPassword.removeClass('fa-lock').addClass('fa-unlock');
                }
            });
        });
    </script>
@endpush
