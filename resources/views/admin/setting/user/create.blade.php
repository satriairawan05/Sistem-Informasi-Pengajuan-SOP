@extends('admin.layout.app')

@section('app')
    <section class="section">
        <div class="section-header">
            <h1>Name</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Name</div>
            </div>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <p class="text-justify">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laboriosam adipisci
                        doloribus perferendis ipsam accusamus inventore tenetur quo tempora magni aut.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
