@extends('layouts.master')

@section('main')
    @include('layouts.navbar')
    <main class="flex-shrink-0">


        <!-- Pricing section-->
        <section class="bg-light py-5">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">Monte o seu plano</h1>
                    <h2 class="fw-bolder">Conforme as suas necessidades</h2>
                    <div class="text-left">
                        <p class="lead fw-normal text-muted mb-0">Com a Tele Reparos, você pode contratar planos de prestação de serviço</p>
                        <p class="lead fw-normal text-muted mb-0">De acordo com a sua necessidade, nossos profossionais irão até você para lhe atender!</p>
                    </div>
                </div>
                <div class="text-center my-4 ">
                    <h4 class="fw-bolder">Planos de limpeza e concervação</h4>
                </div>
                <div class="row gx-5 d-flex flex-row justify-content-center align-items-center">
                    <!-- Pricing card free-->
                    <div class="col-lg-3 col-md-3 col-sm-10">
                        <div class="plan-card plan-one shadow">
                            <div class="pricing-header bg-primary p-2">
                                <h4 class="plan-title">Residencial Básica</h4>
                            </div>
                            <ul class="plan-features">
                                <li>✅ Atendimento quinzenal</li>
                                <li>✅ 4 horas de atendimento</li>
                                <li>✅ Equipamentos necessarios inclusos </li>
                                <li class="text-muted"><del>Limpeza de vidros altos</del></li>
                                <li class="text-muted"><del>Limpeza de calçadas</del></li>
                            </ul>
                            <div class="plan-footer">
                                <a href="#" class="btn btn-primary btn-lg btn-rounded">Saiba mais</a>
                            </div>
                        </div>
                    </div>
                    <!-- Pricing card free-->
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="plan-card plan-one shadow">
                            <div class="pricing-header bg-dark-blue p-3">
                                <h4 class="plan-title">Residencial Completa</h4>
                            </div>
                            <ul class="plan-features">
                                <li>✅ Atendimento semanal</li>
                                <li>✅ Produtos incluidos</li>
                                <li>✅ Equipamentos incluidos</li>
                                <li>✅ 4 horas</li>
                                <li class="text-muted"><del>Limpeza de vidros</del></li>
                                <li class="text-muted"><del>Limpeza de calçadas</del></li>
                            </ul>
                            <div class="plan-footer">
                                <a href="#" class="btn bg-dark-blue text-light btn-lg btn-rounded">Saiba mais</a>
                            </div>
                        </div>
                    </div>
                    <!-- Pricing card free-->
                    <div class="col-lg-3 col-md-3 col-sm-10">
                        <div class="plan-card plan-one shadow">
                            <div class="pricing-header bg-primary p-2">
                                <h4 class="plan-title">Empresarial</h4>
                            </div>
                            <ul class="plan-features">
                                <li>✅ Qauntos dias você preferir</li>
                                <li>✅ Materias inclusos</li>
                                <li>✅ Equipamentos inclusos</li>
                                <li>✅ Limpeza de fachada</li>
                                <li>✅ vidros e calçadas</li>
                            </ul>
                            <div class="plan-footer">
                                <a href="#" class="btn btn-primary btn-lg btn-rounded">Saiba mais</a>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
        <section class="bg-light py-1">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder">Escolha o que faz sentido para você</h1>
                    <p class="lead fw-normal text-muted mb-0">Com a Tele Reparos, você pode contratar planos de prestação de serviço</p>

                </div>
                <div class="container">
                    <div class="mt-5">
                          <div class="d-style btn btn-brc-tp border-2 bgc-white btn-outline-blue btn-h-outline-blue btn-a-outline-blue w-100 my-2 py-3 shadow-sm">
                            <!-- Basic Plan -->
                            <div class="row align-items-center">
                              <div class="col-12 col-md-4">
                                <h4 class="pt-3 text-170 text-600 text-primary-d1 letter-spacing">
                                  Jardinagem Residencial
                                </h4>
                    
                                <div class="text-secondary-d1 text-120">
                                  <span class="ml-n15 align-text-bottom">120</span><span class="text-180">$</span> / mês
                                </div>
                              </div>
                    
                              <ul class="list-unstyled mb-0 col-12 col-md-4 text-dark-l1 text-90 text-left my-4 my-md-0">
                                <li>
                                  <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                                  <span>
                                    <span class="text-110"> Descarte de resíduos</span>
                                  </span>
                                </li>
                    
                                <li class="mt-25">
                                  <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                                  <span class="text-110">
                                     Organização de jardins e canteiros
                                </span>
                                </li>
                    
                                <li class="mt-25">
                                  <i class="fa fa-times text-danger-m3 text-110 mr-25 mt-1"></i>
                                  <span class="text-110">
                                    Poda de arvores e coqueiros
                                </span>
                                </li>

                                <li class="mt-25">
                                    <i class="fa fa-times text-danger-m3 text-110 mr-25 mt-1"></i>
                                    <span class="text-110">
                                      Serviço quinzenal ou semanal
                                  </span>
                                  </li>
                              </ul>
                    
                              <div class="col-12 col-md-4 text-center">
                                <a href="#" class="bg-dark-blue text-light f-n-hover btn btn-raised px-4 py-25 w-75 text-600">Saiba mais</a>
                              </div>
                            </div>
                    
                          </div>
                    
                    
                    
                          <div class="d-style bgc-white btn btn-brc-tp btn-outline-green btn-h-outline-green btn-a-outline-green w-100 my-2 py-3 shadow-sm border-2">
                            <!-- Pro Plan -->
                            <div class="row align-items-center">
                              <div class="col-12 col-md-4">
                                <h4 class="pt-3 text-170 text-600 text-green-d1 letter-spacing">
                                  Limpeza de piscina
                                </h4>
                    
                                <div class="text-secondary-d2 text-120">
                                  <div class="text-danger-m3 text-90 mr-1 ml-n4 pos-rel d-inline-block">
                                    70<span class="text-150 deleted-text">$</span>
                                    <span>
                                        <span class="d-block rotate-45 position-l mt-n475 ml-35 fa-2x text-400 border-l-2 h-5 brc-dark-m1"></span>
                                    </span>
                                  </div>
                                  <span class="align-text-bottom">90</span><span class="text-180">$</span> / mês
                                </div>
                              </div>
                    
                              <ul class="list-unstyled mb-0 col-12 col-md-4 text-dark-l1 text-90 text-left my-4 my-md-0">
                                <li>
                                  <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                                  <span>
                                    <span class="text-110">Materiais inclusos</span>
                                  </span>
                                </li>
                    
                                <li class="mt-25">
                                  <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                                  <span class="text-110">
                                    Serviço semanal
                                </span>
                                </li>
                    
                                <li class="mt-25">
                                  <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                                  <span class="text-110">
                                    outra especificação...
                                </span>
                                </li>
                              </ul>
                    
                              <div class="col-12 col-md-4 text-center">
                                <a href="#" class="f-n-hover btn bg-dark-blue text-light btn-raised px-4 py-25 w-75 text-600">Saiba mais</a>
                              </div>
                            </div>
                    
                          </div>
                    
                    
                    
                          <div class="d-style btn btn-brc-tp border-2 bgc-white btn-outline-purple btn-h-outline-purple btn-a-outline-purple w-100 my-2 py-3 shadow-sm">
                            <!-- Premium Plan -->
                            <div class="row align-items-center">
                              <div class="col-12 col-md-4">
                                <h4 class="pt-3 text-170 text-600 text-purple-d1 letter-spacing">
                                  Premium Plan
                                </h4>
                    
                                <div class="text-secondary-d1 text-120">
                                  <span class="ml-n15 align-text-bottom">50</span><span class="text-180">$</span> / mês
                                </div>
                              </div>
                    
                              <ul class="list-unstyled mb-0 col-12 col-md-4 text-dark-l1 text-90 text-left my-4 my-md-0">
                                <li>
                                  <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                                  <span>
                                    <span class="text-110">Everything in Pro...</span>
                                  </span>
                                </li>
                    
                                <li class="mt-25">
                                  <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                                  <span class="text-110">
                                    Placerat duis
                                </span>
                                </li>
                    
                                <li class="mt-25">
                                  <i class="fa fa-check text-success-m2 text-110 mr-2 mt-1"></i>
                                  <span class="text-110">
                                    Molestie nunc non
                                </span>
                                </li>
                              </ul>
                    
                              <div class="col-12 col-md-4 text-center">
                                <a href="#" class="bg-dark-blue text-light  f-n-hover btn btn-raised px-4 py-25 w-75 text-600">Saiba mais</a>
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