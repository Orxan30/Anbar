@extends('layouts.app')


@section('content')

  
<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
      {{ __('messages.profil') }}
    </h1>
  </div>
</section>

  <section class="section main-section">
  @if(session('mesaj'))
  <div class="notification blue">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div>
        <span class="icon"><i class="mdi mdi-message-reply-text"></i></span>
        <b>{{session('mesaj')}}</b>
      </div>
      <button type="button" class="button small textual --jb-notification-dismiss">{{ __('messages.bagla') }}</button>
    </div>
  </div>
  @endif
  @if(session('mesaj2'))
  <div class="notification red">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div>
        <span class="icon"><i class="mdi mdi-message-reply-text"></i></span>
        <b>{{session('mesaj2')}}</b>
      </div>
      <button type="button" class="button small textual --jb-notification-dismiss">{{ __('messages.bagla') }}</button>
    </div>
  </div>
  @endif
  <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-6">
    <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account"></i></span>
            {{ __('messages.profil') }}
          </p>
        </header>
        <div class="card-content">
          <div class="image w-48 h-48 mx-auto">
            <img src="{{Auth::user()->Ufoto}}" class="rounded-full">
          </div>
          <hr>
          <div class="field">
            <label class="label">{{ __('messages.ad') }}:</label>
            <div class="control">
              <input type="text" readonly=""  value="{{Auth::user()->ad}}" class="input is-static">
            </div>
          </div>
          <hr>
          <div class="field">
            <label class="label">{{ __('messages.soyad') }}:</label>
            <div class="control">
              <input type="text" readonly="" value="{{Auth::user()->soyad}}" class="input is-static">
            </div>
          </div>
          <hr>
          <div class="field">
            <label class="label">{{ __('messages.tel') }}:</label>
            <div class="control">
              <input type="text" readonly="" value="{{Auth::user()->telefon}}" class="input is-static">
            </div>
          </div>
          <hr>
          <div class="field">
            <label class="label">{{ __('messages.email') }}:</label>
            <div class="control">
              <input type="text" readonly="" value="{{Auth::user()->email}}" class="input is-static">
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-circle"></i></span>
            {{ __('messages.Pedit') }}
          </p>
        </header>
        <div class="card-content">
        <form method="post" action="{{route('Prupdate')}}" enctype="multipart/form-data">
              @csrf
              <div class="image w-48 h-48 mx-auto">
            <img src="{{Auth::user()->Ufoto}}" class="rounded-full">
          </div>
            <!--File upload START-->
            <div class="field">
            <label class="label">{{ __('messages.foto') }}:</label>
               <div class="field-body">
                  <div class="field file">
                     <label class="upload control">
                        <a class="button blue">
                        {{ __('messages.fotoyeni') }}
                        </a>
                        <input type="file" name="Ufoto" required="">
                     </label>
                  </div>
               </div>
            </div>
               <hr>
            <!--File upload END-->
            <div class="field">
              <label class="label">{{ __('messages.yad') }}:</label>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="text" autocomplete="on" name="ad" value="{{Auth::user()->ad}}" class="input" required="">
                  </div>
                  <p class="help">{{ __('messages.yadyaz') }}</p>
                </div>
              </div>
            </div>
            <div class="field">
              <label class="label">{{ __('messages.ysoyad') }}:</label>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="text" autocomplete="on" name="soyad"  value="{{Auth::user()->soyad}}" class="input" required="">
                  </div>
                  <p class="help">{{ __('messages.ysadyaz') }}</p>
                </div>
              </div>
            </div>
            <div class="field">
              <label class="label">{{ __('messages.ytel') }}:</label>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="text" autocomplete="on" name="telefon" value="{{Auth::user()->telefon}}" class="input" required="">
                  </div>
                  <p class="help">{{ __('messages.ytelyaz') }} </p>
                </div>
              </div>
            </div>
            <div class="field">
              <label class="label">{{ __('messages.yemail') }}:</label>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="email" autocomplete="on" name="email"  value="{{Auth::user()->email}}" class="input" required="">
                  </div>
                  <p class="help">{{ __('messages.yemailyaz') }}</p>
                </div>
              </div>
            </div>
          
            <div class="field spaced">
                <label class="label">Password</label>
                <p class="control icons-left">
                    <input class="input" type="password" name="password" placeholder="Parol">
                    <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                </p>
            </div>
            <!--
            <div class="field spaced">
                <label class="label">Təkrar Password</label>
                <p class="control icons-left">
                    <input class="input" type="password" name="tparol" placeholder="Təkrar parol" >
                    <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                </p>
            </div>
            <hr>
             -->
            <div class="field">
              <div class="control">
                <button type="submit" class="button green">
                {{ __('messages.yenile') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div> 

    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-lock"></i></span>
          {{ __('messages.pdeyis') }}
        </p>
      </header>
      <div class="card-content">
        <form method="post" action="{{route('Parolupdate')}}">
        @csrf
          <div class="field">
            <label class="label">{{ __('messages.cparol') }}:</label>
            <div class="control">
            <input  type="password" name="password" placeholder="**********" class="input" required="">
            </div>
            <p class="help">{{ __('messages.cparolyaz') }}</p>
          </div>
          <hr>
          <div class="field">
            <label class="label">{{ __('messages.yparol') }}:</label>
            <div class="control">
              <input type="password"  name="newpassword" placeholder="**********" class="input" required="">
            </div>
            <p class="help">{{ __('messages.yparolyaz') }}</p>
          </div>
          <div class="field">
            <label class="label">{{ __('messages.tparol') }}:</label>
            <div class="control">
              <input type="password"  name="Tnewpassword" placeholder="**********" class="input" required="">
            </div>
            <p class="help">{{ __('messages.typarol') }}</p>
          </div>
          <hr>
          <div class="field">
            <div class="control">
              <button type="submit" class="button green">
              {{ __('messages.yenile') }}
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>



@endsection
