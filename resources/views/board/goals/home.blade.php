@extends('templates.main')
@section('header')
               
        <div class="col-xl-6 col-lg-9">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Crear Meta</h5>
                      	
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  
                    <form method="POST" action={{  action('GoalController@create')}}>
                      {{ csrf_field() }}
                      <div class="row">
                      <div class="col-lg-6">
                      <div class="form-group">
                        
                        <input type="text" id="input-name" name="name" class="form-control form-control-alternative" placeholder="Nombre bolsillo" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        
                        <input type="number" id="input-name" name="money_goal" class="form-control form-control-alternative" placeholder="Valor a ahorrar" required>
                      </div>
                    </div></div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        
                        Fecha limite:<input type="date" id="input-name" name="date" class="form-control form-control-alternative"  required>
                      </div>
                    </div>

                      <button name="submit" type="submit"  value="Recargar" class="btn btn-sm btn-outline-primary float-right" >Crear</button>
                    
                      
                    </form>
                    
                </div>
              </div>
            </div>
            @endsection
            

 @section('content')

<div class="row mt-5">
        <div class="col-xl-12 mb-12 mb-xl-12">
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Metas disponibles</h3>
                </div>
               
              </div>
            </div>
            <div class="table-responsive">
              <!-- Projects table -->
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Valor Ahorrado</th>
                    <th scope="col">Fecha Final</th>
                    <th scope="col">Valor Meta</th>
                    <th scope="col">Acciones</th>
                    
                  </tr>
                </thead>
                            <tbody>
                      @foreach($goals as $goal)
                      <tr >
                      
                      <td>{{ '$'.$goal->name }}</td>
                      <td>{{ '$'.$goal->available_money}}</td>
                      <td>{{ $goal->final_date}}</td>
                      <td>{{ '$'.$goal->money_goal}}</td>
                        <td> <form method="POST" action={{  action('GoalController@goalTransaction')}}>
                        {{ csrf_field() }}
                        <button name="delete" type="submit"  value={{ $goal->id  }} class="btn btn-sm btn-danger float-left"><i class="far fa-trash-alt"></i>Eliminar</button>
                        <button name="add" type="submit"  value={{ $goal->id  }} class="btn btn-sm btn-danger float-left">Agregar</button>
                        <button name="remove" type="submit"  value={{ $goal->id  }} class="btn btn-sm btn-danger float-left">Retirar</button>
                        <button name="send" type="submit"  value={{ $goal->id  }} class="btn btn-sm btn-danger float-left">Enviar</button>
                        </form>

                      </td>
                      
                      

                    </tr>
                  @endforeach
            
                </tbody>
              </table>
              {!! $goals->render() !!}
            </div>
          </div>
        </div>
    
      </div>
  

@endsection