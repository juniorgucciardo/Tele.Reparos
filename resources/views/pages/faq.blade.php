@extends('layouts.master')

@section('main')
    @include('layouts.navbar')
    <main class="flex-shrink-0">
        <!-- Page Content-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">Respostas e perguntas frequentes</h1>
                    <p class="lead fw-normal text-muted mb-0">Como nós podemos te ajudar?</p>
                </div>
                <div class="row gx-5">
                    <div class="col-xl-8">
                        <!-- FAQ Accordion 1-->
                        <h2 class="fw-bolder mb-3">Planos e Serviços</h2>
                        <div class="accordion mb-5" id="accordionExample">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Como contratar os serviços da empresa?</button></h3>
                                <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Para contratar os nossos serviços, você pode entrar em contato com a empresa. <br>

                                        Assim que Estivermos com as suas informações agendaremos uma visita técnica para avaliar as características da sua demanda e planejar o seu atendimento, <br>
                                        
                                        logo em seguida, você será incluso na agenda dos nossos colaboradores.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Como agendar uma avaliação técnica</button></h3>
                                <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Basicamente vamos precisar do seu nome, endereço e alguma informação de contato. <br>
                                        Além disso uma breve descrição do serviço a ser realizado juntamente com uma imagem. <br>
                                        Nem sempre essa avaliação precisará ser presencial, por isso quanto mais informações a cerca da sua demanda, mais rapido conseguiremos lhe atender <br>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Como funcionam os planos de serviços?</button></h3>
                                <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        durante a visita técnica, você poderá definir quais os principais pontos a serem observados durante a execução dos atendimentos do contrato.
                                        Estes pontos terão atenção especial dos nossos prestadores durante os atendimentos
                                        os prestadores não realizarão serviços adicionais sem que haja consentimento da empresa e do cliente
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapseThree">Qual a altura máxima de vidros e janelas?</button></h3>
                                <div class="accordion-collapse collapse" id="collapse10" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Nossos colaboradores não realizam a limpeza acima de 2,5 metros de altura. Por questões de segurança e organização de EPI's.
                                        Esse tipo de serviço é oferecido pela Tele Reparos e pode ser contratado de forma avulsa.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapseThree">Produtos e Equipamentos inclusos?</button></h3>
                                <div class="accordion-collapse collapse" id="collapse11" aria-labelledby="heading11" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        A empresa dispõem de varios equipamentos e produtos para lhe atender <br>
                                        Porem, você pode optar ou não por utilizar os produtos da Tele, ficando livre para utilizar os produtos de sua preferencia <br>
                                        Lembrando que, caso opte por fornecer os produtos, você precisa oferecer todas as condições necessárias para o bom andamento das atividades solicitadas. <br>
                                        Você pode a qualquer momento solicitar os produtos em seu plano, porém, isso acarretará em custos adicionais.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- FAQ Accordion 2-->
                        <h2 class="fw-bolder mb-3">Soluções em terceirização</h2>
                        <div class="accordion mb-5 mb-xl-0" id="accordionExample2">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne">Soluções para minha empresa</button></h3>
                                <div class="accordion-collapse collapse" id="collapseFour" aria-labelledby="headingOne" data-bs-parent="#accordionExample2">
                                    <div class="accordion-body">
                                        Se você necessida de mão de obra especializada para a sua empresa a Tele Reparos possui soluções para você!
                                        Possuimos mão de obra especializada em varios seguimentos, limpeza e conservação, limpeza de fachadas, vidros, calçadas, jardinagem, manutenção hidraulica/Eletrica, dedetização, construção civil etc...
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseTwo">Soluções para condomínios </button></h3>
                                <div class="accordion-collapse collapse" id="collapseFive" aria-labelledby="headingTwo" data-bs-parent="#accordionExample2">
                                    <div class="accordion-body">
                                        Dispomos de profissionais em diversos segmentos aptos para atuar em locais com grande circulação de pessoas como condominios e predios. <br>
                                        incluindo serviços de zeladoria, jardinagem, limpeza e conservação e limpeza de areas publicas.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="heading20"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse20" aria-expanded="false" aria-controls="collapseSix">Orçamentos e custos</button></h3>
                                <div class="accordion-collapse collapse" id="collapse20" aria-labelledby="headingSix" data-bs-parent="#accordionExample2">
                                    <div class="accordion-body">
                                        Nossos serviços são orçados segundo as suas especificações, atividades necessárias para a sua realização
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card border-0 mt-xl-5 text-light shadow-sm" style="background-color:#0a223e;">
                            <div class="card-body p-4 py-lg-5">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="text-center card-darker">
                                        <div class="h6 fw-bolder">Você tem mais perguntas?</div>
                                        <p class="text-muted mb-4">
                                            Converse conosco
                                            <br />
                                            <a href="#!">atendimento@telereparos.com.br</a>                                            </p>
                                        <div class="h6 fw-bolder">Siga nas redes sociais:</div>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-twitter"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-facebook"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-linkedin"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('layouts.footer')
@endsection