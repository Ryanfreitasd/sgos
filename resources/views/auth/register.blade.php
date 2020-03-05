@extends('layout.app2')

@section('content')
<body class="bg-light">

        <div class="container">
          <div class="card card-register mx-auto mt-5">
                <div class="card text-white bg-dark">
            <div class="card-header">Registrar conta</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-12">
                      <div class="form-label-group">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Nome">
        
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <label for="name">Nome</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-label-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
        
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label for="email">Email</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-row">
                    <div class="col-md-6">
                      <div class="form-label-group">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Senha">
        
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <label for="password">Senha</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-label-group">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmar senha">
                        <label for="password-confirm">Confirma senha</label>
                      </div>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">{{ __('Registrar') }}</button>
              </form>
              <div class="d-flex justify-content-center">
                    <a class="d-block text-white medium mt-3" href="{{ route('password.request') }}">Esqueci a senha?</a>
            </div>
            </div>
          </div>
        </div>
      </body>
      
@endsection
