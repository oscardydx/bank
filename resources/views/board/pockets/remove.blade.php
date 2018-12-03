@extends('templates.main')

@section('header')
<div class="col-xl-8 order-xl-1 ">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Transfiere dinero desde tu bolsillo a tu cuenta disponible</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
              <form method="POST" action={{  action('PocketController@pocketTransaction')}}>
                      {{ csrf_field() }}
                <h6 class="heading-small text-muted mb-4">Información de transacción</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Valor de transacción</label>
                        <input type="hidden" id="input-value" name="pocketId" class="form-control form-control-alternative" value={{ $id }} >
                        <input type="number" id="input-value" name="value" class="form-control form-control-alternative" placeholder="Ingresa el valor en pesos" required>
                      </div>
                    </div>
                    
                  </div>
                  
                </div>
                <hr class="my-4" />
                 <button name="removeRequest" type="submit" value="addRequest" class="btn btn-default float-right ">Agregar</button>
              </form>
            </div>
          </div>
        </div>
@endsection