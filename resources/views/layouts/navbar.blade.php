<nav class="navbar navbar-expand-lg navbar-dark bg-dark-blue fixed-top overflor-hidden">
                
    <div class="container px-5">
        <a class="navbar-brand" href="{{route('web')}}">
            <div class="brand d-flex flex-row align-items-center">
                <img width="45px" height="45px" src="{{asset('assets/brand.png')}}" alt="">
                <div class="mx-2">
                    <span class="block">Tele</span>
                    <span class="text-green">Reparos</span>
                </div>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="mx-1 nav-item"><a class="nav-link {{Route::is('web') ? 'active' : ''}}" href="{{ route('web') }}"><i class="fas fa-home"></i> Home</a></li>
                <li class="mx-1 nav-item"><a class="nav-link {{Route::is('about') ? 'active' : ''}}" href="{{ route('about') }}"><i class="fas fa-users"></i> Sobre nós</a></li>
                <li class="mx-1 nav-item"><a class="nav-link {{Route::is('plans') ? 'active' : ''}}" href="{{ route('plans') }}"><i class="fas fa-wrench"></i> Planos</a></li>
                <li class="mx-1 nav-item"><a class="nav-link {{Route::is('contact') ? 'active' : ''}}" href="{{ route('contact') }}"><i class="fas fa-phone-alt"></i> Contato</a></li>
                <li class="mx-1 nav-item"><a class="nav-link {{Route::is('faq') ? 'active' : ''}}" href="{{ route('faq') }}"><i class="fas fa-question-circle"></i> FAQ</a></li>
                <li class="nav-item mx-2"><a class="btn text-light btn-primary nav-link" href="">Trabalhe Conosco</a></li>
                
            </ul>
        </div>
    </div>
</nav>