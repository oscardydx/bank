@extends('templates.main')

@section('header')
<div class="col-xl-8 order-xl-1 ">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Recarga desde tu Banco</h3>
                </div>
                
              </div>
            </div>
            <div class="card-body">
              <form method="POST" action={{  action('AccountController@transactionRequest')}}>
                      {{ csrf_field() }}
                <h6 class="heading-small text-muted mb-4">Información bancaria</h6>
                <div class="pl-lg-4">
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-username">Banco</label>
                        <input type="text" id="input-bank" class="form-control form-control-alternative" placeholder="Ingresa Banco" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-email">Usuario</label>
                        <input type="text" id="input-user" class="form-control form-control-alternative" placeholder="Ingresa tu usuario" required>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-first-name">Contraseña</label>
                        <input type="password" name="password" id="input-password" class="form-control form-control-alternative" placeholder="Ingresa tu contraseña" required>
                      </div>
                    </div>
                    <div class="col-lg-6">
                      <div class="form-group">
                        <label class="form-control-label" for="input-last-name">Valor a recargar</label>
                        <input type="number" name="value" id="input-value" class="form-control form-control-alternative" placeholder="Ingresa valor en pesos" required>
                      </div>
                    </div>
                  </div>
                </div>
                <hr class="my-4" />
                 <button name="submit" type="submit" value="Recargar" class="btn btn-default float-right ">Recargar</button>
              </form>
            </div>
          </div>
        </div>
@endsection