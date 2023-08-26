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
   @empty($edit)
         <div class="card mb-6">
            <header class="card-header">
               <p class="card-header-title">
                  <span class="icon"><i class="mdi mdi-cash"></i></span>
                  Valyutalar
               </p>
            </header>
            <div class="card-content">
               <form method="post" action="{{route('Vgonder')}}" enctype="multipart/form-data">
                  @csrf
                  <div class="field">
                     
                     <label class="label">{{ __('messages.ad') }}:</label>
                     <div class="field-body">
                        <div class="field">
                           <div class="control icons-left">
                              <input class="input" type="text" placeholder="valyuta yazin" name="ad">
                              <span class="icon left"><i class="mdi mdi-cash"></i></span>   
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
      @endempty
      
    
   @isset($sil_id)
   <div id="sample-modal" class="modal active">
   <div class="modal-background --jb-modal-close"></div>
   <div class="modal-card">
      <header class="modal-card-head">
         <p class="modal-card-title"><b>{{ __('messages.silmesaji') }}</b></p>
      </header>
      <section class="modal-card-body">
         <p>{{ __('messages.PULsiz') }} <b>{{$valyuta}}</b>  {{ __('messages.PULsil?') }}</p>
         
      </section>
      <footer class="modal-card-foot">
         <a href="{{route('valyutalar')}}" button class="button --jb-modal-close">{{ __('messages.yox') }}</button></a>
         <a href="{{route('Vyes',$sil_id)}}"button class="button red --jb-modal-close">{{ __('messages.he') }}</button></a>
      </footer>
   </div>
   </div>
   @endisset


   @isset($edit)
   <div class="card mb-6">
               <header class="card-header">
                  <p class="card-header-title">
                     <span class="icon"><i class="mdi mdi-cash"></i></span>
                     Valyutalar
                  </p>
               </header>
               <div class="card-content">
                  <form method="post" action="{{route('Vupdate',$edit->id)}}" enctype="multipart/form-data">
                     @csrf
                     <div class="field">
                        <label class="label">{{ __('messages.ad') }}:</label>
                        <div class="field-body">
                           <div class="field">
                              <div class="control icons-left">
                                 <input class="input" type="text" value="{{$edit->ad}}" name="ad" required="">
                                 <span class="icon left"><i class="mdi mdi-cash"></i></span>
                              </div>
                           </div>
                           <hr>
                        </div>
                     </div>

                     <div class="field grouped">
                        <div class="control">
                           <button type="submit" class="button green">
                           {{ __('messages.yenile') }}
                           </button>
                           <a href="{{route('valyutalar')}}"><button type="button" class="button red">
                              {{ __('messages.legvet') }}
                              </button></a>
                        </div>
                     </div>       
                  </form> 
               </div>
            </div>
   @endisset
   

   <hr>
  
   <!--CEDVEL START-->
   <div class="card has-table">
         <header class="card-header">
         <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-cash"></i></span>
           Valyutalar
         </p>
         <a href="#" class="card-header-icon">
            <span class="icon"><i class="mdi mdi-reload"></i></span>
         </a>
         </header>
         <div class="card-content">
         <table>
            <thead>
            <tr>
               <th>#</th>
               <th>{{ __('messages.ad') }}</th>
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
                  <td>{{$info->ad}}</td>
                  <td>{{$info->created_at}}</td>
                  <td class="actions-cell">
                   
                  <div class="buttons right nowrap">
                     <a href="{{route('Vedit',$info->id)}}"><button class="button small green --jb-modal"  type="button">
                        <span class="icon"><i class="mdi mdi-eye"></i></span>
                        </button></a>
                     <a href="{{route('Vsil',$info->id)}}"><button class="button small red --jb-modal"  type="button">
                        <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                        </button></a>
                  </div>
                  </td>
               </tr>
            @endforeach
            </tbody>
         </table>
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