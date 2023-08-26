@extends('layouts.app')

@section('axtar')
/products
@endsection

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


      <header class="card-header">
         <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-monitor-dashboard"></i></span>
            {{ __('messages.manage') }}
         </p>
      </header>
      <div class="card-content">


            
      @isset($u)
      
            @php

            $secim = array();
            $secim = unserialize($u->menyu);
            if(empty($secim)){$secim = [];}

            @endphp
      @endisset
         <form method="post" action="{{route('umanage')}}">
            @csrf
            <select name="user_id" class="form-control" onchange="this.form.submit()">
            <option value="">{{ __('messages.isdifadecisec') }}</option>
            @foreach($users as $user)
                @isset($u)
                    @if($u->id == $user->id)
                    <option selected value="{{$user->id}}">{{$user->ad}} {{$user->soyad}}</option>
                    @else
                    <option value="{{$user->id}}">{{$user->ad}} {{$user->soyad}}</option>
                    @endif
                @endisset

                @empty($u)
                <option value="{{$user->id}}">{{$user->ad}} {{$user->soyad}}</option>
                @endempty
            @endforeach
            </select>
            <br>
</form>

@isset($u)

            <form method="post" action="{{route('pmanage')}}" enctype="multipart/form-data">

            @csrf
            <input type="hidden" name="user_id" value="{{$u->id}}">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>{{ __('messages.menyu') }}</th>
                    <th>{{ __('messages.cedvel') }}</th>
                    <th>{{ __('messages.bazayainsert') }}</th>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>{{ __('messages.brendler') }}</td>
                        <td><input @if (in_array('1-1',$secim)) checked @endif type="checkbox" name="secim[]" value="1-1">
                        <td><input @if (in_array('1-2',$secim)) checked @endif type="checkbox" name="secim[]" value="1-2">
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>{{ __('messages.mehsullar') }}</td>
                        <td><input @if (in_array('2-1',$secim)) checked @endif type="checkbox" name="secim[]" value="2-1">
                        <td><input @if (in_array('2-2',$secim)) checked @endif type="checkbox" name="secim[]" value="2-2">
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>{{ __('messages.sifarisler') }}</td>
                        <td><input @if (in_array('3-1',$secim)) checked @endif type="checkbox" name="secim[]" value="3-1">
                        <td><input @if (in_array('3-2',$secim)) checked @endif type="checkbox" name="secim[]" value="3-2">
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>{{ __('messages.xercler') }}</td>
                        <td><input @if (in_array('4-1',$secim)) checked @endif type="checkbox" name="secim[]" value="4-1">
                        <td><input @if (in_array('4-2',$secim)) checked @endif type="checkbox" name="secim[]" value="4-2">
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>{{ __('messages.musteriler') }}</td>
                        <td><input @if (in_array('5-1',$secim)) checked @endif type="checkbox" name="secim[]" value="5-1">
                        <td><input @if (in_array('5-2',$secim)) checked @endif type="checkbox" name="secim[]" value="5-2">
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>{{ __('messages.tehcizatcilar') }}</td>
                        <td><input @if (in_array('6-1',$secim)) checked @endif type="checkbox" name="secim[]" value="6-1">
                        <td><input @if (in_array('6-2',$secim)) checked @endif type="checkbox" name="secim[]" value="6-2">
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>{{ __('messages.isciler') }}</td>
                        <td><input @if (in_array('7-1',$secim)) checked @endif type="checkbox" name="secim[]" value="7-1">
                        <td><input @if (in_array('7-2',$secim)) checked @endif type="checkbox" name="secim[]" value="7-2">
                    </tr>
                    <tr>
                        <td>8</td>
                        <td>{{ __('messages.tapsiriqlar') }}</td>
                        <td><input @if (in_array('8-1',$secim)) checked @endif type="checkbox" name="secim[]" value="8-1">
                        <td><input @if (in_array('8-2',$secim)) checked @endif type="checkbox" name="secim[]" value="8-2">
                    </tr>
                    <tr>
                        <td>9</td>
                        <td>{{ __('messages.sobeler') }}</td>
                        <td><input @if (in_array('9-1',$secim)) checked @endif type="checkbox" name="secim[]" value="9-1">
                        <td><input @if (in_array('9-2',$secim)) checked @endif type="checkbox" name="secim[]" value="9-2">
                    </tr>
                    <tr>
                        <td>10</td>
                        <td>{{ __('messages.vezifeler') }}</td>
                        <td><input @if (in_array('10-1',$secim)) checked @endif type="checkbox" name="secim[]" value="10-1">
                        <td><input @if (in_array('10-2',$secim)) checked @endif type="checkbox" name="secim[]" value="10-2">
                    </tr>
                    <tr>
                        <td>11</td>
                        <td>DOCS</td>
                        <td><input @if (in_array('11-1',$secim)) checked @endif type="checkbox" name="secim[]" value="11-1">
                        <td><input @if (in_array('11-2',$secim)) checked @endif type="checkbox" name="secim[]" value="11-2">
                    </tr>

                </tbody>
            </table>
            <button class="btn btn-primary">{{ __('messages.daxilet') }}</button>
         </form> 

         @endisset
      </div>
   </div>
   
      </div>
   </div>
</section>



@endsection