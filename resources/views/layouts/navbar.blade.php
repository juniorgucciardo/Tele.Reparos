<nav class="navbar navbar-expand-lg navbar-dark bg-dark-blue fixed-top overflor-hidden">
                
    <div class="container px-5">
        <a class="navbar-brand" href="index.html">
            <div class="brand d-flex flex-row align-items-center">
                <img width="45px" height="45px" src="assets/brand.png" alt="">
                <div class="mx-2">
                    <span class="block">Tele</span>
                    <span class="text-green">Reparos</span>
                </div>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('web') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">Sobre nós</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('plans') }}">Planos</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contato</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('faq') }}">FAQ</a></li>
                <li class="nav-item mx-2"><a class="btn text-light btn-gradient-primary nav-link" href="">Trabalhe Conosco</a></li>
                
            </ul>
        </div>
    </div>
</nav>