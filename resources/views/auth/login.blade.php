@extends('layout.app2')

@section('content')
<body class="bg-light">

        <div class="container">

          <div class="card card-login mx-auto mt-5">
            <div class="card text-white bg-dark">
            <div class="card-header">Login</div>
            <div class="card-body">
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <div class="form-label-group">
                    <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" name="email" 
                        placeholder="Endereço de email" required="required" autofocus="autofocus" value="{{ old('email') }}">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label for="email">Email</label>
                  </div>
                </div>

                <div class="form-group">
                  <div class="form-label-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" 
                            required autocomplete="current-password" placeholder="Senha">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <label for="password">Senha</label>
                  </div>
                </div>

                <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Lembrar senha') }}
                            </label>
                        </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                        {{ __('Acessar') }}
                </button>

                
              </form>
              <div class="text-center">
                 @if (Route::has('password.request'))
                    <a class="d-block text-white small mt-3" href="{{ route('password.request') }}">
                        {{ __('Esqueci minha senha?') }}
                    </a>
                @endif
              </div>
            </div>
            </div>
          </div>
        </div>
      </body>
@endsection