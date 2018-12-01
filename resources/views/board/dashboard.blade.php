@extends('templates.main')

@section('header')
               
        <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Dinero Disponible</h5>
                      <span class="h2 font-weight-bold mb-0">${!!$user->available_money!!}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> Pesos Colombianos</span>
                    <span class="text-nowrap"></span>
                   
                    
                  </p>
                    <form method="POST" action={{  action('AccountController@startTransaction')}}>
                      {{ csrf_field() }}
                      <button name="submit" type="submit"  value="Recargar" class="btn btn-sm btn-outline-primary float-right">Recargar</button>
                    
                      <button name="submit" type="submit"  value="Enviar" class="btn btn-sm btn-outline-primary float-left">Enviar</button>
                    </form>
                    
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Dinero en Colchón</h5>
                      <span class="h2 font-weight-bold mb-0">${!!$user->mattress_money!!}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> Pesos Colombianos</span>
                    <span class="text-nowrap"></span>
                  </p>
                  <form method="POST" action={{  action('AccountController@startTransaction')}}>
                      {{ csrf_field() }}
                      <button name="submit" type="submit"  value="Agregar" class="btn btn-sm btn-outline-primary float-right">Agregar</button>
                    
                      <button name="submit" type="submit"  value="Retirar" class="btn btn-sm btn-outline-primary float-left">Retirar</button>
                    </form>
                  
                </div>
              </div>
            </div>

@endsection