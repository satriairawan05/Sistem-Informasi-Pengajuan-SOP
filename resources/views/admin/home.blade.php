@extends('admin.layout.app')


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
                <div class="card-body">
                    <p class="text-justify">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ullam officiis recusandae ipsam blanditiis natus cupiditate nisi velit voluptas expedita pariatur, doloremque dolor libero est fugit quos repellendus, temporibus possimus tenetur veniam. Recusandae quasi sed explicabo ad fuga soluta voluptatem aliquam porro culpa maxime cumque laborum, sapiente velit ex quia aperiam tempore ducimus reiciendis maiores. Eius praesentium dolores numquam rerum, magnam cupiditate architecto alias error officia aut ducimus, nulla omnis ratione. Natus veniam voluptates, nam necessitatibus sequi id excepturi, ipsum aliquam saepe recusandae labore quia repellendus, suscipit veritatis accusantium tenetur ullam rem incidunt iste! Nesciunt impedit dolore atque qui voluptatibus obcaecati, molestias animi necessitatibus itaque molestiae! Veritatis commodi rem deleniti saepe eum ipsum eaque ad voluptates tenetur voluptas deserunt ab unde placeat ut, aperiam inventore nesciunt. Nostrum dolor perspiciatis quia laudantium officiis, dolore quidem dolorem esse ipsa delectus at illum vero veniam, corrupti saepe necessitatibus, quisquam natus recusandae consectetur exercitationem magnam eligendi! Dolorem consectetur mollitia odio necessitatibus architecto accusantium error, itaque libero officia cum expedita omnis ducimus qui quos doloribus voluptates porro obcaecati, a esse aliquam aspernatur laudantium! Asperiores nesciunt quod quos? Sed, neque incidunt! Cumque, eaque amet animi officiis in rem molestiae quo, repellendus sed vel consequatur fugiat magni minus.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
