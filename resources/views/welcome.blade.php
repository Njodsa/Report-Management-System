<!doctype html>
<html dir="{{(app()->getLocale() == 'ar' ? 'rtl' : 'ltr')}}">
  <head>
    <meta charset="utf-8">
    <title>{{ __('main.app_name') }} </title>
      <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link href="{{asset('css/style.css?v=79' )}}" rel="stylesheet" type="text/css" >
    <link href="{{asset('css/ltr.css' )}}" rel="stylesheet" type="text/css" >
  </head>
  <body >
    <div>
      <div class="bg-hehader">
        <div>
          <h3>{{ __('main.app_name') }} </h3>
        </div>
      </div>
    </div>
     <div class='bg-welcome'>

       @guest
          <div class="background-form">
            <div class="mt-4">
              <a href="{{ url('lang/en') }}" >{{ __('main.en')}}</a>
              &nbsp | &nbsp
              <a href="{{ url('lang/ar') }}" >{{ __('main.ar')}} </a>
            </div>

             <div class="form">
               <h3>{{ __('main.title_login') }} </h3>
                <form method="POST" action="{{ route('login') }}">
                      @csrf
                      <div class="form-group row">
                          <label for="email" class="col-md-12 col-form-label text-md-right">{{ __('main.email') }}</label>
                          <div class="col-md-12">
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                              @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('email') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group row">
                          <label for="password" class="col-md-12 col-form-label text-md-right">{{ __('main.pass') }} </label>
                          <div class="col-md-12">
                              <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                              @if ($errors->has('password'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('password') }}</strong>
                                  </span>
                              @endif
                          </div>
                      </div>
                      <div class="form-group row">
                      @if (Route::has('password.request'))
                          <a class=" col-md-12 col-form-label text-md-right " style="color:#368ACC"
                          href="{{ route('password.request') }}">
                             {{ __('main.forget_pass') }}
                          </a>
                      @endif
                    </div>
                      <div class="form-group row ">
                          <div class="col-md-12 ">
                              <button type="submit" class="btn btn-block color-368ACC" style="margin-top:7%">
                                 {{ __('main.login') }}
                              </button>
                          </div>
                      </div>
                  </form>
             </div>
          </div>
       @endguest
       <div>
        <ul class="ul-welcome">
          <li>{{ __('main.list_1') }}</li>
          <li>{{ __('main.list_2') }}</li>
          <li>{{ __('main.list_3') }}</li>
        </ul>
       </div>

    </div>
    <footer class="footer" style="background-color:#f8f9fa;padding: 1% ;  text-align: center; overflow: hidden">
        {{ __('main.app_name') }} ©
      </footer>
  </body>
</html>
