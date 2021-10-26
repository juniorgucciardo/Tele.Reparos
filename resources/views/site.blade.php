@extends('layouts.master')

@section('main')
    @include('layouts.navbar')
    <main class="flex-shrink-0">
    <header class="bg-dark-blue py-5 relative block">
        <div id="particles-js"></div>
        <div class="overlay absolute"></div>
        <div class="container px-5">
            <div class="row gx-5 align-items-left justify-content-left">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 mr-auto text-xl-start header-content">
                        <h1 class="display-4 text-light mb-2 header-text">COMO PODEMOS FACILITAR O SEU DIA?</h1>
                        <p class="lead fw-normal text-light mb-4 sub-text">A Tele Reparos executa os mais variados serviços, em Santo Ângelo e região, para facilitar a sua vida!</p>
                        <p class="lead fw-normal text-light mb-4 sub-text">Agende a sua visita tecnica e receba nosso orçamento!</p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features">Saiba mais</a>
                            <a href="#" class="BlueGlow-btn text-center">Solicite um orçamento</a>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </header>


    <!-- Features section-->
    <section class="py-3" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-4 mb-5 mb-lg-0"><h2 class="fw-bolder mb-0">Solução completa para você</h2></div>
                <div class="col-lg-8">
                    <div class="row gx-5 row-cols-1 row-cols-md-2">
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="fas fa-house-user"></i></div>
                            <h2 class="h5">Serviços Residenciais</h2>
                            <p class="mb-0">Serviços de limpeza, jardinagem, limpeza de piscinas, reparos elétricos e hidraulicos, temos todos os serviços para sua residencia</p>
                        </div>
                        <div class="col mb-5 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                            <h2 class="h5">Condomínios</h2>
                            <p class="mb-0">Serviço de zeladoria, jardinagem, limpeza e conservação. Profissionais uniformizados e preparados para executar os serviços necessários</p>
                        </div>
                        <div class="col mb-5 mb-md-0 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="fas fa-shield-alt"></i></div>
                            <h2 class="h5">Seguradoras</h2>
                            <p class="mb-0">Prestamos serviço as principais seguradoras, solicite atendimento e a nossa equipe sera encaminhada para lhe atender</p>
                        </div>
                        <div class="col h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                            <h2 class="h5">Empresas</h2>
                            <p class="mb-0">Temos a solução ideal para você que precisa de prestação de serviços e mão de obra especializada em diversas áreas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-light" id="scroll-target">
        <div class="container px-5 my-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="assets/images/pos-obra.png" alt="..." /></div>
                <div class="col-lg-6">
                    <h2 class="fw-bolder">Qualidade em primeiro lugar</h2>
                    <p class="lead fw-normal text-muted mb-0">A Tele Reparos executa um criterioso processo de supervisão e treinamento dos nossos colaboradores, garantindo a você maior tranquilidade ao contratar os nossos serviços</p>
                </div>
            </div>
        </div>
    </section>
    <!-- About section two-->
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5 align-items-center">
                <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="assets/images/man-cutting-grass-with-lawn-mover-back-yard.jpg" alt="..." /></div>
                <div class="col-lg-6">
                    <h2 class="fw-bolder">Para facilitar a sua vida</h2>
                    <p class="lead fw-normal text-muted mb-0">É muito fácil contratar os serviços da Tele Reparos, aqui você encontra o profissional certo para o reparo ou manutenção que você precisa. Contamos com maquinário próprio e mão de obra especializada para os mais variados tipos de serviço</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Opiniao dos clientes -->

    <section class="py-5 bg-dark-blue relative">
        <div id="particles-js-bubble"></div>
        <div class="container px-5 my-5">
            <div class="row gx-5 align-items-center">
                <div class="text-center">
                    <h2 class="fw-bolder text-light">Nossos clientes</h2>
                    <p class="lead fw-normal text-muted mb-5 text-light">Veja o que os nossos clientes falam sobre os nossos serviços</p>
                </div>
                        <div class="col-md-4">
                            <div class="card shadow"> <i class="fa fa-quote-left u-color"></i>
                                <p>Gostaria de deixar registrado a minha satisfação com a prestação de serviço de vocês.<br> A equipe de vocês foi acionada ontem e bem cedo resolveram o problema!</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user-about"> <span class="font-weight-bold d-block">Rochele M.</span> <span class="u-color">Cliente</span>
                                        <div class="d-flex flex-row mt-1"> <i class="fa fa-star u-color"></i> <i class="fa fa-star u-color"></i> <i class="fa fa-star u-color"></i> <i class="fa fa-star u-color"></i> <i class="fa fa-star u-color"></i> <i class="fa fa-star-o u-color"></i> <i class="fa fa-star-o u-color"></i> <i class="fa fa-star-o u-color"></i> </div>
                                    </div>
                                    <div class="user-image"> <img src="http://lorempixel.com/20/20/people/" class="rounded-circle" width="50"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card"> <i class="fa fa-quote-left u-color"></i>
                                <p>Ficou ótimo mesmo, e muito grata por agilizarem a troca, realmente é um diferencial <br> parabéns pelo excelente serviço prestado</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user-about"> <span class="font-weight-bold d-block">Vanessa D.</span> <span class="u-color">Cliente</span>
                                        <div class="d-flex flex-row mt-1"> <i class="fa fa-star u-color"></i> <i class="fa fa-star u-color"></i> <i class="fa fa-star u-color"></i> <i class="fa fa-star-o u-color"></i> <i class="fa fa-star-o u-color"></i> </div>
                                    </div>
                                    <div class="user-image"> <img src="http://lorempixel.com/20/20/people/" class="rounded-circle" width="50"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card"> <i class="fa fa-quote-left u-color"></i>
                                <p>...Quero dar os parabéns a equipe, principalmente ao supervisor. o pessoal não foi embora enquanto não deu fim as folhas e as gramas. trabalho de excelência</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="user-about"> <span class="font-weight-bold d-block">Rodrigo dos S.</span> <span class="u-color">Cliente</span>
                                        <div class="d-flex flex-row mt-1"> <i class="fa fa-star u-color"></i> <i class="fa fa-star u-color"></i> <i class="fa fa-star u-color"></i> <i class="fa fa-star u-color"></i> <i class="fa fa-star-o u-color"></i> </div>
                                    </div>
                                    <div class="user-image"> <img src="http://lorempixel.com/20/20/people/" class="rounded-circle" width="50"> </div>
                                </div>
                            </div>
                        </div>
            </div>
        </div>
    </section>











    <!-- frase famosa section-->
    <!-- <div class="py-5 bg-light">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-10 col-xl-7">
                    <div class="text-center">
                        <div class="fs-4 mb-4 fst-italic">"Working with Start Bootstrap templates has saved me tons of development time when building new projects! Starting with a Bootstrap template just makes things easier!"</div>
                        <div class="d-flex align-items-center justify-content-center">
                            <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                            <div class="fw-bold">
                                Tom Ato
                                <span class="fw-bold text-primary mx-1">/</span>
                                CEO, Pomodoro
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Blog preview section-->
    <section class="py-5">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <div class="text-center">
                        <h2 class="fw-bolder">Nosso blog</h2>
                        <p class="lead fw-normal text-muted mb-5">Algumas postagens sobre os nossos serviços diretamente do nosso blog</p>
                    </div>
                </div>
            </div>
            <div class="row gx-5">
                @foreach ($posts as $post)
                <div class="col-lg-4 mb-5">
                    <div class="card h-100 shadow border-0">
                        <img class="card-img-top" style="object-fit: cover;" width="600" height="150" src="/storage/blog/{{$post->img_post}}" alt="..." />
                        <div class="card-body p-4">
                            <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{$post->category}}</div>
                            <a class="text-decoration-none link-dark stretched-link" href="{{route('post.show', $post->slug)}}"><h5 class="card-title mb-3">Dicas de jardinagem</h5></a>
                            <p class="card-text mb-0">{{ mb_strimwidth($post->content, 0, 145, "...") }}</p>
                        </div>
                        <div class="card-footer px-2 py-4 pt-0 bg-transparent border-top-0">
                            <div class="d-flex align-items-end justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle mx-2 prof_pic" width="40" height="40"  src="/storage/usr_img/{{$post->user->user_img}}" alt="..." />
                                    <div class="small">
                                        <div class="fw-bold">{{$post->user->name}}</div>
                                        <div class="text-muted">Publicado dia {{ date('d/m', strtotime(explode(' ', $post->created_at)[0])) }} às - {{ date('H:i A', strtotime(explode(' ', $post->created_at)[1])) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            <!-- Call to action-->
            <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
                <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                    <div class="mb-4 mb-xl-0">
                        <div class="fs-3 fw-bold text-white">Entre em contato conosco e solicite um orçamento!</div>
                        <div class="text-white-50">Apenas uma mensagem e você encontrará o profissional correto para o que você precisa!</div>
                    </div>
                    <div class="ms-xl-4">
                        <div class="input-group mb-2">
                            <input class="form-control" type="text" placeholder="Seu WhatsApp..." aria-label="Email address..." aria-describedby="button-newsletter" />
                            <button class="btn btn-outline-light" id="button-newsletter" type="button">Enviar</button>
                        </div>
                        <div class="small text-white-50">Fique tranquilo, seu whatsapp esta seguro conosco, não vamos enviar span ou enviar seu numero para terceiros</div>
                    </div>
                </div>
            </aside>
        </div>
    </section>
</main>
    @include('layouts.footer')
@endsection