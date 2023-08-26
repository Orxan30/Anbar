@extends('layouts.app')

@section('axtar')
/brands
@endsection

@section('content')

@php
   $secim = array();
   $secim = unserialize(Auth::user()->menyu);
   if(empty($secim)){$secim = [];}
@endphp

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

   <div class="card mb-6" id="f2">
        <header class="card-header">
            <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-chess-queen"></i></span>
            {{ __('messages.brendc') }}
            </p>
        </header>
     
        <div class="card-content">
            <form method="post" action="{{route('Egonder')}}">
                @csrf
                <div class="field">
                    <label class="label">{{ __('messages.form') }}:</label>
                    <div class="field-body">
                    <div class="field">
                        <div class="control icons-left">
                        <input class="input" type="text" placeholder="{{ __('messages.ad') }}" name="ad" required="">
                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                        </div>
                    </div>
                    <div class="field">
                        <div class="control icons-left icons-right">
                        <input class="input" type="email" placeholder="{{ __('messages.email') }}" name="email" required="">
                        <span class="icon left"><i class="mdi mdi-mail"></i></span>
                        <span class="icon right"><i class="mdi mdi-check"></i></span>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="field">
                    <div class="field-body">
                    <div class="field">
                        <div class="field addons">
                        <div class="control">
                            <input class="input" placeholder="+1" size="3" readonly="">
                        </div>
                        <div class="control expanded">
                            <input class="input" type="tel" name="telefon" value="{{Auth::user()->telefon}}">
                        </div>
                        </div>
                        <p class="help">{{ __('messages.ilksifiriyazma') }}</p>
                    </div>
                    </div>
                </div>
                
                <hr>
                <div class="field">
                    <label class="label">{{ __('messages.title') }}:</label>
                    <div class="control">
                    <input class="input" type="text" placeholder="{{ __('messages.qisabasliqyaz') }}" name="movzu" required="">
                    </div>
                    <p class="help">
                    {{ __('messages.xananidoldur') }}
                    </p>
                </div>

                <div class="field">
                    <label class="label">{{ __('messages.sorgu') }}:</label>
                    <div class="control">
                    <textarea class="textarea" placeholder="{{ __('messages.sorguyaz') }}" name="metn" required=""></textarea>
                    </div>
                </div>
                <hr>

                <div class="field grouped">
                    <div class="control">
                        <button type="submit" class="button green">
                        {{ __('messages.daxilet') }}
                        </button>
                        <a href="{{route('elaqe')}}" button type="button" class="button red">
                        <span class="menu-item-label">{{ __('messages.geridon') }}</span>
                        </a>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
