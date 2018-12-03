@extends('templates.main')
@section('header')
               
        <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Crear Bolsillo</h5>
                      	
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  
                    <form method="POST" action={{  action('PocketController@create')}}>
                      {{ csrf_field() }}
                      
                      <div class="col-lg-12">
                      <div class="form-group">
                        
                        <input type="text" id="input-name" name="name" class="form-control form-control-alternative" placeholder="Nombre bolsillo" required>
                      </div>
                    </div>
                      <button name="submit" type="submit"  value="Recargar" class="btn btn-sm btn-outline-primary float-right">Crear</button>
                    
                      
                    </form>
                    
                </div>
              </div>
            </div>
            @endsection
            @section('content')

<div class="row mt-5">
        <div class="col-xl-9 mb-6 mb-xl-6">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Bolsillos disponibles</h3>
                </div>
               
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Acciones</th>
                    
                  </tr>
                </thead>
                            <tbody>
                      @foreach($pockets as $pocket)
                      <tr >
                      
                      <td>{{ '$'.$pocket->name }}</td>
                      <td>{{ '$'.$pocket->available_money}}</td>
                        <td> <form method="POST" action={{  action('PocketController@pocketTransaction')}}>
                        {{ csrf_field() }}
                        <button name="delete" type="submit"  value={{ $pocket->id  }} class="btn btn-sm btn-danger float-left"><i class="far fa-trash-alt"></i>Eliminar</button>
                        <button name="add" type="submit"  value={{ $pocket->id  }} class="btn btn-sm btn-danger float-left">Agregar</button>
                        <button name="remove" type="submit"  value={{ $pocket->id  }} class="btn btn-sm btn-danger float-left">Retirar</button>
                        <button name="send" type="submit"  value={{ $pocket->id  }} class="btn btn-sm btn-danger float-left">Enviar</button>
                        </form>

                      </td>
                      
                      

                    </tr>
                  @endforeach
            
                </tbody>
              </table>
              {!! $pockets->render() !!}
            </div>
          </div>
        </div>
    
      </div>
  

@endsection

