@extends('layouts.app')


@section('content')

  
<section class="is-hero-bar">
  <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0">
    <h1 class="title">
   
    {{ __('messages.ayarlar') }} <span class="icon"><i class="mdi mdi-cogs"></i></span>
    </h1>
  </div>
</section>

<section class="section main-section"> 
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 mb-6">
        <div class="card">
            <header class="card-header">
                <p class="card-header-title">
                {{ __('messages.logo') }}
                <span class="icon"><i class="mdi mdi-cogs"></i></span>
                </p>
            </header>
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

            <form method="post" action="{{route('LGupdate')}}" enctype="multipart/form-data">
                @csrf               
                        @php 
                            $logo = 'null';

                            $ayarlar = App\Models\ayarlar::get();

                            if(isset($ayarlar[0])){
                            $logo = $ayarlar[0]->Logo;
                            }
                        @endphp
                <!--File upload START-->
                <div class="field">
                <label class="label">{{ __('messages.foto') }}:</label>      
                    <div class="image w-48 h-48 mx-auto">
                        <img src="{{$logo}}">
                    </div>
                </div>
                <!--File upload END-->
                <div class="field file">
                    <label class="upload control">
                    <a class="button blue">
                    {{ __('messages.fotoyeni') }}
                    </a>
                    <input type="file" name="Logo">
                </div>  
                @php 
                    $sirket = 'null';

                    $ayarlar = App\Models\ayarlar::get();

                    if(isset($ayarlar[0])){
                    $sirket = $ayarlar[0]->sirket;
                    }
                @endphp
                <div class="field">
                    <label class="label">{{ __('messages.sirket') }}:</label>
                    <div class="control">
                    <input type="text"  name="sirket" value="{{$sirket}}" class="input" required="">
                    </div>
                </div>

                <div class="field grouped">
                    <div class="control">
                        <button type="submit" class="button green">
                        {{ __('messages.yenile') }}
                        </button>
                    </div>
                </div>       
            </form> 
        </div> 


     
        <div class="card">
            <header class="card-header">
            <p class="card-header-title">
            {{ __('messages.bizimleelaqe') }}
            <span class="icon"><i class="mdi mdi-cogs"></i></span>
            </p>
            </header>
            @if(session('mesaj2'))
            <div class="notification blue">
            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
                <div>
                <span class="icon"><i class="mdi mdi-message-reply-text"></i></span>
                <b>{{session('mesaj2')}}</b>
                </div>
                <button type="button" class="button small textual --jb-notification-dismiss">{{ __('messages.bagla') }}</button>
            </div>
            </div>
            @endif
            <form method="post"  action="{{route('EMupdate')}}">
                @csrf
                        @php 
                            $email = 'null';
                            $telefon = 'null';
                            $unvan = 'null';

                            $ayarlar = App\Models\ayarlar::get();

                            if(isset($ayarlar[0])){
                            $email = $ayarlar[0]->mail;
                            $telefon = $ayarlar[0]->tel;
                            $unvan = $ayarlar[0]->unvan;
                            }
                        @endphp
                <div class="field">
                    <label class="label">{{ __('messages.email') }}:</label>
                    <div class="control">
                    <input type="text"  name="mail" value="{{$email}}" class="input" required="">
                    </div>
                </div>

                <div class="field">
                    <label class="label">{{ __('messages.tel') }}:</label>
                    <div class="control">
                    <input type="text"  name="tel" value="{{$telefon}}" class="input" required="">
                    </div>
                </div>

                <div class="field">
                    <label class="label">{{ __('messages.unvan') }}:</label>
                    <div class="control">
                    <input type="text"  name="unvan" value="{{$unvan}}" class="input" required="">
                    </div>
                </div>

                <div class="field grouped">
                    <div class="control">
                        <button type="submit" class="button green">
                        {{ __('messages.yenile') }}
                        </button>
                        <a href="{{route('ayarlar')}}"><button type="button" class="button red">
                            {{ __('messages.legvet') }}
                            </button></a>
                    </div>
                </div>   
            </form>
        </div>
    </div>
</section>

<section class="section main-section">
    @if(session('mesaj4'))
    <div class="notification blue">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
        <div>
        <span class="icon"><i class="mdi mdi-message-reply-text"></i></span>
        <b>{{session('mesaj4')}}</b>
        </div>
        <button type="button" class="button small textual --jb-notification-dismiss">{{ __('messages.bagla') }}</button>
    </div>
    </div>
    @endif

    <div class="card">
        <header class="card-header">
        <p class="card-header-title">
        {{ __('messages.footer') }}
        <span class="icon"><i class="mdi mdi-cogs"></i></span>
        </p>
        </header>
        <form method="post" action="{{route('FTRupdate')}}">
            @csrf
                    @php 
                        $footer = 'null';

                        $ayarlar = App\Models\ayarlar::get();

                        if(isset($ayarlar[0])){
                        $footer = $ayarlar[0]->footer;
                        }
                    @endphp  
            <div class="field">
                <label class="label">{{ __('messages.editfooter') }}:</label>
                <div class="control">
                <input type="text"  name="footer" value="{{$footer}}" class="input" required="">
                </div>
            </div>

            <div class="field grouped">
                <div class="control">
                    <button type="submit" class="button green">
                    {{ __('messages.yenile') }}
                    </button>
                    <a href="{{route('ayarlar')}}"><button type="button" class="button red">
                        {{ __('messages.legvet') }}
                        </button></a>
                </div>
            </div>   
        </form>
    </div>
</section>

@endsection
