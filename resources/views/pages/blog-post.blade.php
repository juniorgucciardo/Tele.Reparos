@extends('layouts.master')

@section('main')
    @include('layouts.navbar')
    <main class="flex-shrink-0">
        
        <!-- Page Content-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5">
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center mt-lg-5 mb-4">
                            <img class="prof_pic rounded-circle" style="object-fit: cover;" width="70" height="70"   src="/storage/usr_img/{{$post->user->user_img}}" alt="..." />
                            <div class="ms-3">
                                <div class="fw-bold">{{$post->user->name}}</div>
                                <div class="text-muted">{{$post->category}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <!-- Post content-->
                        <article>
                            <!-- Post header-->
                            <header class="mb-4" style="background: none;">
                                <!-- Post title-->
                                <h1 class="fw-bolder mb-1">{{$post->title}}</h1>
                                <!-- Post meta content-->
                                <div class="text-muted fst-italic mb-2">Publicado dia {{ date('d/m', strtotime(explode(' ', $post->created_at)[0])) }} às - {{ date('H:i A', strtotime(explode(' ', $post->created_at)[1])) }}</div>
                                <!-- Post categories-->
                                <a class="badge text-light bg-dark-blue text-decoration-none link-light" href="#!">{{$post->category}}</a>
                               
                            </header>
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded" src="/storage/blog/{{$post->img_post}}" alt="..." /></figure>
                            <!-- Post content-->
                            <section class="mb-5">
                                <p class="fs-5 mb-4">{{!! $post->content !!}}</p>
                            </section>
                        </article>
                        <!-- Comments section-->
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('layouts.footer')
@endsection