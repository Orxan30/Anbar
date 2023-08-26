@extends('layouts.app')

@section('axtar')
/clients
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
      <div class="field grouped" >
         <div class="control">
            <a href="#" button onclick="geri()" class="button red">
             {{ __('messages.geridon') }}
               </button>
            </a>
         </div>
      </div> 
      <header class="card-header">
         <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
            {{ __('messages.muscedvel') }}
         </p>
      </header>
      <div class="card-content">
         <form method="post" action="{{route('Cgonder')}}" enctype="multipart/form-data">
            @csrf
            <!--File upload START-->
            <div class="field">
            <label class="label">{{ __('messages.foto') }}:</label>
               <div class="field-body">
                  <div class="field file">
                     <label class="upload control">
                        <a class="button blue">
                        {{ __('messages.Cfotoyuk') }}
                        </a>
                        <input type="file" name="Cfoto" required="">
                     </label>
                  </div>
               </div>
            </div>
            <!--File upload END-->

            <div class="field">
               <label class="label">{{ __('messages.ad') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" placeholder="{{ __('messages.adyaz') }}..." name="ad" required="">
                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                     </div>
                  </div>
               </div>
            </div>
 
            <div class="field">
               <label class="label">{{ __('messages.soyad') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" placeholder="{{ __('messages.soyadyaz') }}..." name="soyad" required="">
                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                     </div>
                  </div>
               </div>
            </div>

            
            <div class="field">
               <label class="label">{{ __('messages.tel') }}:</label>
                <div class="field addons">
                  <div class="control">
                    <input class="input" value="+1" size="3" readonly="">
                  </div>
                  <div class="control expanded">
                    <input class="input" type="tel" placeholder="{{ __('messages.telyaz') }}" name="telefon" required="">
                  </div>
                </div>
              </div>

            <div class="field">
               <label class="label">{{ __('messages.email') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" placeholder="...@gmail.com /...@mail.ru" name="email" required="">
                        <span class="icon left"><i class="mdi mdi-email"></i></span>
                     </div>
                  </div>
               </div>
            </div>

            <div class="field grouped">
               <div class="control">
                  <button type="submit" class="button green">
                  {{ __('messages.daxilet') }}
                  </button>
               </div>
            </div>       
         </form> 
      </div>
   </div>
   
   <script>
      document.getElementById('f2').style.display = 'none'
      function daxilet(){
         document.getElementById('f1').style.display = 'none'
         document.getElementById('f2').style.display = 'block'
         document.getElementById('f3').style.display = 'none'
      }

      function geri(){
         document.getElementById('f1').style.display = 'block'
         document.getElementById('f2').style.display = 'none'
         document.getElementById('f3').style.display = 'none'
      }

      function edit(){
         document.getElementById('f1').style.display = 'nome'
         document.getElementById('f2').style.display = 'none'
         document.getElementById('f3').style.display = 'block'
      }
   </script>  
   
   @isset($sil_id)
   <div id="sample-modal" class="modal active">
   <div class="modal-background --jb-modal-close"></div>
   <div class="modal-card">
      <header class="modal-card-head is-danger">
         <p class="modal-card-title"><b>{{ __('messages.silmesaji') }}</b></p>
      </header>
      <section class="modal-card-body">
         <p>{{ __('messages.Csiz') }} <b>{{$ad}} {{$soyad}}</b> {{ __('messages.Csil?') }}</p>
         
      </section>
      <footer class="modal-card-foot">
         <a href="{{route('clients')}}" button class="button --jb-modal-close">{{ __('messages.yox') }}</button></a>
         <a href="{{route('Cyes',$sil_id)}}"button class="button red --jb-modal-close">{{ __('messages.he') }}</button></a>
      </footer>
   </div>
   </div>
   @endisset
  

   @isset($edit)
   <div class="card mb-6" id="f3">
      <header class="card-header">
         <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
            {{ __('messages.muscedvel') }}
         </p>
      </header>
      <div class="card-content">
         <form method="post" action="{{route('Cupdate',$edit->id)}}" enctype="multipart/form-data">
            @csrf
            <!--File upload START-->
            <div class="field">
            <label class="label">{{ __('messages.foto') }}:</label>
                  <div class="image w-48 h-48 mx-auto">
                     <img src="{{url($edit->Cfoto)}}" class="rounded-full">
                  </div>
               <div class="field-body">
                  <div class="field file">
                     <label class="upload control">
                        <a class="button blue">
                        {{ __('messages.fotoyeni') }}
                        </a>
                        <input type="file" name="Cfoto">
                     </label>
                  </div>
               </div>
            </div>
            <!--File upload END-->

            <div class="field">
               <label class="label">{{ __('messages.ad') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" value="{{$edit->ad}}" name="ad" required="">
                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                     </div>
                  </div>
               </div>
            </div>

            <div class="field">
               <label class="label">{{ __('messages.soyad') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" value="{{$edit->soyad}}" name="soyad" required="">
                        <span class="icon left"><i class="mdi mdi-account"></i></span>
                     </div>
                  </div>
               </div>
            </div>

            <div class="field">
               <label class="label">{{ __('messages.tel') }}:</label>
                <div class="field addons">
                  <div class="control">
                    <input class="input" value="+1" size="3" readonly="">
                  </div>
                  <div class="control expanded">
                  <input class="input" type="text" value="{{$edit->telefon}}" name="telefon" required="">
                  </div>
                </div>
              </div>

            <div class="field">
               <label class="label">{{ __('messages.email') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" value="{{$edit->email}}" name="email" required="">
                        <span class="icon left"><i class="mdi mdi-email"></i></span>
                     </div>
                  </div>
               </div>
            </div>

            <div class="field grouped">
               <div class="control">
                  <button type="submit" class="button green">
                  {{ __('messages.yenile') }}
                  </button>
                  <a href="{{route('clients')}}"><button type="button" class="button red">
                     {{ __('messages.legvet') }}
                     </button></a>
               </div>
            </div>       
         </form> 
      </div>
   </div>
   @endisset
 
    
   <section class="section main-section">
      <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
         <div class="card">
         <div class="card-content">
            <div class="flex items-center justify-between">
               <div class="widget-label">
               <h3>
               Nomands
               </h3>
               <h1>
               {{$clients2->count()}}
               </h1>
               </div>
               <span class="icon widget-icon text-green-500"><i class="mdi mdi-account-multiple mdi-48px"></i></span>
            </div>
         </div>
         </div>
         
         <a href="{{route('staff')}}#cedvel">
            <div class="card">
               <div class="card-content">
                  <div class="flex items-center justify-between">
                     <div class="widget-label">
                        <h3>
                        Guides
                        </h3>
                        <h1>
                        1
                        </h1>
                     </div>
                     <span class="icon widget-icon text-blue-500"><i class="mdi mdi-cart-outline mdi-48px"></i></span>
                  </div>
               </div>
            </div>
         </a>
      </div>
   </section>

   @if (in_array('5-2',$secim))
   <div class="field grouped" id="f1">
      <div class="control">
         <a href="#" button onclick="daxilet()" class="button green">
         {{ __('messages.yenisinielave') }}
            </button>
         </a>
      </div>
   </div>
   @endif
  
   <!--CEDVEL START-->
   <div class="card has-table">
      <header class="card-header">
      <p class="card-header-title">
         <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
         {{ __('messages.musteriler') }}
      </p>
      <a href="{{route('clients')}}" class="card-header-icon">
         <span class="icon"><i class="mdi mdi-reload"></i></span>
      </a>
      </header>
      @if (in_array('5-1',$secim))
      <div class="card-content">
         <div class="table-responsive">
            <table id="cedvel">
               <thead>
               <tr>
               <th><a href="{{route('Cexport')}}"><span class="icon"><i class="mdi mdi-file-excel"></i></span></a></th>
                  <th> {{ __('messages.foto') }}</th>
                  <th> {{ __('messages.ad') }}</th>
                  <th> {{ __('messages.soyad') }}</th>
                  <th> {{ __('messages.tel') }}</th>
                  <th> {{ __('messages.email') }}</th>
                  <th> {{ __('messages.tarix') }}</th>
                  <th></th>
               </tr>
               </thead>
               <tbody>
                     {{--
                  @php
                  $i = ($data->currentpage() * 5) - 5
                  @endphp
                   --}}
                   
                   @php
                  $i = 0;
                  @endphp
                  
                  @foreach($data as $info)
                  <tr>
                     <td>{{$i+=1}}.</td>
                     <td><img src="{{url($info->Cfoto)}}" width="100" height="50"></td>
                     <td>{{$info->ad}}</td>
                     <td>{{$info->soyad}}</td>
                     <td>{{$info->telefon}}</td>
                     <td>{{$info->email}}</td>
                     <td>{{$info->created_at}}</td>
                     <td class="actions-cell">
                     <div class="buttons right nowrap">
                        <a href="{{route('Cedit',$info->id)}}"><button onclick="edit()" class="button small green --jb-modal"  type="button">
                           <span class="icon"><i class="mdi mdi-eye"></i></span>
                           </button></a>
                        <a href="{{route('Csil',$info->id)}}"><button class="button small red --jb-modal" type="button">
                           <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                           </button></a>
                     </div>
                     </td>
                  </tr>
                  @endforeach
               </tbody>
            </table> 
         </div>
            {{--
            <div class="table-pagination">
               <div class="flex items-center justify-between">
               {!! $data->links() !!}
               </div>
            </div>
            --}}
      </div>
      @endif
   </div>
</section>

@endsection