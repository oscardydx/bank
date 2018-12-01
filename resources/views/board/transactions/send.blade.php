@extends('templates.main')

@section('header')
<div class="col-xl-8 order-xl-1 ">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Envia a otro usuario Nequi</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
              <form method="POST" action={{  action('AccountController@transactionRequest')}}>
                      {{ csrf_field() }}
                <h6 class="heading-small text-muted mb-4">Información del usuario</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Valor de envio</label>
                        <input type="number" id="input-value" name="value" class="form-control form-control-alternative" placeholder="Ingresa el valor en pesos" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Correo electronico</label>
                        <input type="email" id="input-email" name="email" class="form-control form-control-alternative" placeholder="Ingresa email" required>
                      </div>
                    </div>
                  </div>
                  
                </div>
                <hr class="my-4" />
                 <button name="submit" type="submit" value="Enviar" class="btn btn-default float-right ">Enviar</button>
              </form>
            </div>
          </div>
        </div>
@endsection