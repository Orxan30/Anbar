@extends('layouts.app')

@section('axtar')
/staff
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
            <span class="icon"><i class="mdi mdi-account-tie"></i></span>
            {{ __('messages.iscic') }}
         </p>
      </header>
      <div class="card-content">
         <form method="post" action="{{route('Sgonder')}}" enctype="multipart/form-data">
            @csrf
            <!--File upload START-->
            <div class="field">
            <label class="label">{{ __('messages.foto') }}:</label>
               <div class="field-body">
                  <div class="field file">
                     <label class="upload control">
                        <a class="button blue">
                        {{ __('messages.İfotoyuk') }}
                        </a>
                        <input type="file" name="Sfoto">
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
                        <span class="icon left"><i class="mdi mdi-account-tie"></i></span>
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
                        <span class="icon left"><i class="mdi mdi-account-tie"></i></span>
                     </div>
                  </div>
               </div>
            </div>


            <label class="label">{{ __('messages.tel') }}:</label>
            <div class="field">
                <div class="field addons">
                  <div class="control">
                    <input class="input" value="+1" size="3" readonly="">
                  </div>
                  <div class="control expanded">
                    <input class="input" type="tel" placeholder="{{ __('messages.telyaz') }}" name="tel" required="">
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

            <div class="field">
            <label class="label">Dil:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons">
                        <span class="icon left"><i class="mdi mdi-cash"></i></span>
                        <select name="dil_id" required="">
                           <option value="">{{ __('messages.bsec') }}...</option>
                           @foreach($valyutalar as $v)
                              <option value="{{$v->id}}">{{$v->ad}}</option>
                           @endforeach 
                        </select>   
                     </div>
                     <p class="help"><b>*{{__('messages.melumat')}}</b></p>
                  </div>
                  <hr>
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
      <header class="modal-card-head">
         <p class="modal-card-title"><b>{{ __('messages.silmesaji') }}</b></p>
      </header>
      <section class="modal-card-body">
         <p>{{ __('messages.İsiz') }} <b>{{$ad}} {{$soyad}}</b> {{ __('messages.İsil?') }}</p>
         
      </section>
      <footer class="modal-card-foot">
         <a href="{{route('staff')}}" button class="button --jb-modal-close">{{ __('messages.yox') }}</button></a>
         <a href="{{route('Syes',$sil_id)}}"button class="button red --jb-modal-close">{{ __('messages.he') }}</button></a>
      </footer>
   </div>
   </div>
   @endisset

   @isset($edit)
   <div class="card mb-6" id="f3">
      <header class="card-header">
         <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-tie"></i></span>
            {{ __('messages.iscic') }}
         </p>
      </header>
      <div class="card-content">
         <form method="post" action="{{route('Supdate',$edit->id)}}" enctype="multipart/form-data">
            @csrf
            <!--File upload START-->
            <div class="field">
            <label class="label">{{ __('messages.foto') }}:</label>
            <img src="{{url($edit->Sfoto)}}" width="150" height="150"><br>
               <div class="field-body">
                  <div class="field file">
                     <label class="upload control">
                        <a class="button blue">
                        {{ __('messages.fotoyeni') }}
                        </a>
                        <input type="file" name="Sfoto">
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
                        <span class="icon left"><i class="mdi mdi-account-tie"></i></span>
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
                        <span class="icon left"><i class="mdi mdi-account-tie"></i></span>
                     </div>
                  </div>
               </div>
            </div>

            <label class="label">{{ __('messages.tel') }}:</label>
            <div class="field">
               <div class="field addons">
                  <div class="control">
                    <input class="input" value="+1" size="3" readonly="">
                  </div>
                  <div class="control expanded">
                    <input class="input" type="tel" value="{{$edit->tel}}" name="tel" required="">
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

            <label class="label">{{ __('messages.vezife') }}:
               <select name="vezife_id" required="">
                  <option value="">{{ __('messages.bsec') }}</option>
                  @foreach($vezife as $i=>$v)
                     @if($edit->vezife_id==$v->id)
                     <option selected value="{{$v->id}}">{{$i+=1}}. {{$v->ad}} - [{{$v->vezife}}]</option>
                     @else
                     <option value="{{$v->id}}">{{$i+=1}}. {{$v->ad}} - [{{$v->vezife}}]</option>
                     @endif
                  @endforeach
               </select>
            </label> 

            <div class="field">
               <label class="label">{{ __('messages.maash') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" value="{{$edit->maash}}" name="maash" required="">
                        <span class="icon left"><i class="mdi mdi-account-cash"></i></span>
                     </div>
                  </div>
               </div>
            </div>

            <div class="field">
               <label class="label">{{ __('messages.baslamat') }}:</label>
               <div  class="field-body">
                  <div class="field">
                     <input class="input" type="date" value="{{$edit->vaxt}}" name="vaxt" required="">
                  </div>
               </div>
            </div>

            <div class="field grouped">
               <div class="control">
                  <button type="submit" class="button green">
                  {{ __('messages.yenile') }}
                  </button>
                  <a href="{{route('staff')}}" button type="button" class="button red">
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
      
      <a href="{{route('staff')}}">
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
                  <span class="icon widget-icon text-green-500"><i class="mdi mdi-file-table-box-multiple mdi-48px"></i></span>
               </div>
            </div>
         </div>
      </a>

      <a href="{{route('clients')}}">
         <div class="card">
            <div class="card-content">
               <div class="flex items-center justify-between">
                  <div class="widget-label">
                  <h3>
                  Nomands
                  </h3>
                  <h1>
                  0
                  </h1>
                  </div>
                  <span class="icon widget-icon text-blue-500"><i class="mdi mdi-file-table-box-multiple mdi-48px"></i></span>
               </div>
            </div>
         </div>
      </a>
    </div>
  </section>

  @if (in_array('7-2',$secim))
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
         {{ __('messages.isciler') }}
      </p>
      <a href="{{route('staff')}}" class="card-header-icon">
         <span class="icon"><i class="mdi mdi-reload"></i></span>
      </a>
      </header>
      @if (in_array('7-1',$secim))
      <div class="card-content">
         <div class="table-responsive">
            <table id="cedvel">
               <thead>
                  <tr>
                     <th><a href="{{route('staffexport')}}"><span class="icon"><i class="mdi mdi-file-excel"></i></span></a></th>
                     <th data-orderable="false">{{ __('messages.foto') }}</th>
                     <th>{{ __('messages.ad') }}/{{ __('messages.soyad') }}</th>
                     <th>{{ __('messages.tel') }}</th>
                     <th>{{ __('messages.email') }}</th>
                     <th>Dil</th>
                     <th>{{ __('messages.sened') }}</th>
                     <th>{{ __('messages.tarix') }}</th>
                     <th data-orderable="false"></th>
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
                     <td><img src="{{$info->Sfoto}}" width="100" height="50"></td>
                     <td>{{$info->staf}} {{$info->soyad}}</td>
                     <td>{{$info->tel}}</td>
                     <td>{{$info->email}}</td>
                     <td>{{$info->add}}</td>
                  <td>{{App\Models\sened::where('staff_id','=',$info->id)->count()}}</td>
                     <td>{{$info->created_at}}</td>
                     <td class="actions-cell">
                     <div class="buttons right nowrap">
                        <a href="{{route('Sedit',$info->id)}}"><button onclick="edit()" class="button small green --jb-modal" type="button">
                           <span class="icon"><i class="mdi mdi-eye"></i></span>
                           </button></a>
                        <a href="{{route('Ssil',$info->id)}}"><button class="button small red --jb-modal" type="button">
                           <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                           </button></a>
                        <a href="{{route('senedlerim',$info->id)}}"><button class="button small blue --jb-modal" type="button">
                           <span class="icon"><i class="mdi mdi-folder-account"></i></span>
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