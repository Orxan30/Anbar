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
         <button type="button" class="button small textual --jb-notification-dismiss"> {{ __('messages.bagla') }}</button>
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
         <button type="button" class="button small textual --jb-notification-dismiss"> {{ __('messages.bagla') }}</button>
         </div>
      </div>
   @endif

   @isset($sil_id)
   <div id="sample-modal" class="modal active">
      <div class="modal-background --jb-modal-close"></div>
      <div class="modal-card">
         <header class="modal-card-head is-danger">
            <p class="modal-card-title"> <b>{{ __('messages.silmesaji') }}</b></p>
         </header>
         <section class="modal-card-body">
         <p>{{ __('messages.Sfsiz') }} <b>{{$mesaj}}</b> {{ __('messages.Sfsil?') }}</p>
            
         </section>
         <footer class="modal-card-foot">
            <a href="{{route('mesajlar')}}" button class="button --jb-modal-close">{{ __('messages.yox') }}</button></a>
            <a href="{{route('myes',$sil_id)}}"button class="button red --jb-modal-close">{{ __('messages.he') }}</button></a>
         </footer>
      </div>
   </div>
   @endisset

   <!--CEDVEL START-->
   <div class="card has-table">
         <header class="card-header">
         <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-email-receive"></i></span>
            {{ __('messages.mesajlar') }}
         </p>
         <a href="{{route('mesajlar')}}" class="card-header-icon">
            <span class="icon"><i class="mdi mdi-reload"></i></span>
         </a>
         </header>
         <div class="card-content">
            <div class="table-responsive"> 
               <table id="cedvel">
                  <thead>
                     <th><a href="#"><span class="icon">#</span></a></th>
                     <th>{{ __('messages.ad') }}</th>
                     <th>{{ __('messages.email') }}</th>
                     <th>{{ __('messages.tel') }}</th>
                     <th>{{ __('messages.title') }}</th>
                     <th>{{ __('messages.mesajhakkinda') }}</th>
                     <th>{{ __('messages.tarix') }}</th>
                     <th></th>
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
                        <td>{{$info->email}}</td>
                        <td>{{$info->telefon}}</td>
                        <td>{{$info->movzu}}</td>
                        <td>{{$info->metn}}</td>
                        <td>{{$info->created_at}}</td>
                        <td class="actions-cell">
                        <div class="buttons right nowrap">
                           <a href="{{route('msil',$info->id)}}"><button class="button small red --jb-modal" type="button">
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