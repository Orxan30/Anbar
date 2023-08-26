@extends('layouts.app')



@section('content')
 
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
            <span class="icon"><i class="mdi mdi-folder-account"></i></span>
            {{__('messages.senedc')}}
         </p>
      </header>
      <div class="card-content">
         <form method="post" action="{{route('Sndgonder2')}}" enctype="multipart/form-data">
            @csrf
               <!--File upload START-->
            <div class="field">
            <label class="label">{{ __('messages.foto') }}:</label>
               <div class="field-body">
                  <div class="field file">
                     <label class="upload control">
                        <a class="button blue">
                        {{ __('messages.sndfoto') }}
                        </a>
                        <input type="file" name="Sndfoto" required="">
                     </label>
                  </div>
               </div>
            </div>
            <hr>
            <!--File upload END-->
            
            <input type="hidden" name="staff_id" value="{{$x}}">
            <div class="field">
               <label class="label">{{ __('messages.cod') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" placeholder="xxxxxxxxxx" name="cod" required="">
                        <span class="icon left"><i class="mdi mdi-numeric"></i></span>
                     </div>
                  </div>
                  <hr>
               </div>
            </div>

            <div class="field">
               <label class="label">{{ __('messages.ad') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" placeholder="{{ __('messages.sndad') }}..." name="ad" required="">
                        <span class="icon left"><i class="mdi mdi-folder-account"></i></span>
                     </div>
                  </div>
                  <hr>
               </div>
            </div>
            
            <div class="field">
               <label class="label">{{ __('messages.hakkinda') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <textarea class="textarea" placeholder="{{ __('messages.metn') }}..." name="metn" required=""></textarea>      
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
            <p>{{ __('messages.sndsiz') }} <b>{{$sened}}</b>  {{ __('messages.Sndsil?') }}</p>
            
         </section>
         <footer class="modal-card-foot">
            <a href="{{route('senedlerim',$x)}}" button class="button --jb-modal-close">{{ __('messages.yox') }}</button></a>
            <a href="{{route('Sndyes',$sil_id)}}"button class="button red --jb-modal-close">{{ __('messages.he') }}</button></a>
         </footer>
      </div>
   </div>
   @endisset


   @isset($edit)
   <div class="card mb-6" id="f3">
      <header class="card-header">
         <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-ballot"></i></span>
            {{ __('messages.senedc') }}
         </p>
      </header>
      <div class="card-content">
         <form method="post" action="{{route('Sndupdate',$edit->id)}}" enctype="multipart/form-data">
            @csrf
               <!--File upload START-->
            <div class="field">
            <label class="label">{{ __('messages.foto') }}:</label>
                  <div class="image w-48 h-48 mx-auto">
                     <img src="{{url($edit->Sndfoto)}}" class="rounded-full">
                  </div>
               <div class="field-body">
                  <div class="field file">
                     <label class="upload control">
                        <a class="button blue">
                        {{ __('messages.sndfoto') }}
                        </a>
                        <input type="file" name="Sndfoto">
                     </label>
                  </div>
               </div>
            </div>
            <hr>
               <!--File upload END-->
               
            <input type="hidden" name="id" value="{{$edit->id}}">
            <div class="field">
               <label class="label">{{ __('messages.cod') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" value="{{$edit->cod}}" name="cod" required="">
                        <span class="icon left"><i class="mdi mdi-numerick"></i></span>
                     </div>
                  </div>
                  <hr>
               </div>
            </div>

            <div class="field">
               <label class="label">{{ __('messages.ad') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <div class="control icons-left">
                        <input class="input" type="text" value="{{$edit->ad}}" name="ad" required="">
                        <span class="icon left"><i class="mdi mdi-folder-account"></i></span>
                     </div>
                  </div>
                  <hr>
               </div>
            </div>

            <div class="field">
               <label class="label">{{ __('messages.hakkinda') }}:</label>
               <div class="field-body">
                  <div class="field">
                     <textarea class="textarea" name="metn" required="">{{$edit->metn}}</textarea>      
                  </div>
                  <hr>
               </div>
            </div>

            <div class="field grouped">
               <div class="control">
                  <button type="submit" class="button green">
                  {{ __('messages.yenile') }}
                  </button>
                  <a href="{{route('senedlerim',$x)}}"><button type="button" class="button red">
                     {{ __('messages.legvet') }}
                     </button></a>
               </div>
            </div>       
         </form> 
      </div>
   </div>
   @endisset
   
   <div class="field grouped" id="f1">
      <div class="control">
         <a href="#" button onclick="daxilet()" class="button green">
          {{ __('messages.yenisinielave') }}
            </button>
         </a>
      </div>
   </div>
   
   <section class="section main-section" >
      <div class="grid gap-6 grid-cols-1 md:grid-cols-3 mb-6">
         <div class="card" style="height: 120px; width: 120%;">
            <div class="card-content">
               <div class="flex items-center justify-between">
                  <div class="widget-label">
                     <h3>
                     {{ __('messages.bazada') }}
                     </h3>
                     <h1>
                     {{$sened2->count()}} 
                     </h1>
                  </div>
                  <span class="icon widget-icon text-green-500"><i class="mdi mdi-folder-account mdi-48px"></i></span>
               </div>
            </div>
         </div>
      </div>
   </section>
  
   <!--CEDVEL START-->
   <div class="card has-table">
         <header class="card-header">
         <p class="card-header-title">
         <span class="icon"><i class="mdi mdi-folder-account"></i></span>{{ __('messages.senedleri') }}
         @php
        $isci = App\Models\sened::join('staff','staff.id','=','seneds.staff_id')
         ->where('staff.id','=',$x)
         ->select('staff.ad','staff.soyad')
         ->where('seneds.user_id','=',Auth::id())
         ->get();
         @endphp 

         @php



              if(isset($isci[0]->ad)){
               {echo $isci[0]->ad.' '.$isci[0]->soyad;}
      {echo __('messages.senedleri2') ;}
   }   

   else  
   {echo __('messages.senedyoxdur');}
              
         @endphp
         </p>
         <a href="{{route('senedlerim',$x)}}" class="card-header-icon">
            <span class="icon"><i class="mdi mdi-reload"></i></span>
         </a>
         </header>
         <div class="card-content">
            <div class="table-responsive"> 
               <table>
                  <thead>
                  <tr>
                  <th><a href="{{route('senedexport')}}"><span class="icon"><i class="mdi mdi-file-excel"></i></span></a></th>
                     <th>{{ __('messages.foto') }}</th>
                     <th>{{ __('messages.cod') }}</th>
                     <th>{{ __('messages.sened') }}</th>
                     <th>{{ __('messages.hakkinda') }}</th>
                     <th>{{ __('messages.tarix') }}</th>
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
                        <td><img src="{{url($info->Sndfoto)}}" width="100" height="50"></td>
                        <td>{{$info->cod}}</td>
                        <td>{{$info->add}}</td>
                        <td>{{$info->metn}}</td>
                        <td>{{$info->created_at}}</td>
                        <td class="actions-cell">
                        <div class="buttons right nowrap">
                           <a href="{{route('Sndedit',[$info->id,$info->staff_id])}}"><button onclick="edit()" class="button small green --jb-modal"  type="button">
                              <span class="icon"><i class="mdi mdi-eye"></i></span>
                              </button></a>
                           <a href="{{route('Sndsil',[$info->id,$info->staff_id])}}"><button class="button small red --jb-modal"  type="button">
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
      </div>
</section>
 

@endsection