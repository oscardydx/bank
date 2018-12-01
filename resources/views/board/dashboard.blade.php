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

@section('content')

<div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Historial de transacciones</h3>
                </div>
               
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Nota</th>
                  </tr>
                </thead>
                            <tbody>
                      @foreach($transactions as $transaction)
                      <tr >
                      
                      <td>{{ $transaction->created_at }}</td>
                      <td>{{ $transaction->type}}</td>
                      <td>{{ $transaction->value }}</td>
                      <td></td>
                      

                    </tr>
                  @endforeach
            
                </tbody>
              </table>
              {!! $transactions->render() !!}
            </div>
          </div>
        </div>
    
      </div>
  

@endsection