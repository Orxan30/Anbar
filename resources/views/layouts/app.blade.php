<!---ICONLARI XODLAYAN JQUERY-->
<!---yeni -datatable-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script  src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<!---yeni -datatable end-->

  <!--SEYFELEME BOOTSRAPI-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>


<!DOCTYPE html>
<html lang="en" class="">
<head>

<!---SCROLL kodlari START------------>
  <style>
    .scrol::-webkit-scrollbar{
      widht: 0px;
      background:transparent;
    }

    .scrol::->webkit-scrollbar-thump{
      background:transparent;
    }
    .scrol{
    overflow-y: scroll; height: 650px;
    }
  </style>
  <!---SCROLL kodlari END-------->
  @php 

  $sirket = 'null';
  $logo = 'null';

  $ayarlar = App\Models\ayarlar::get();

  if(isset($ayarlar[0])){
  $logo = $ayarlar[0]->Logo;
  $sirket = $ayarlar[0]->sirket;
  }

  @endphp
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$sirket}}</title>
  

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="{{url('css/main.css?v=1628755089081')}}">

  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>

  <meta name="description" content="Admin One - free Tailwind dashboard">

  <meta property="og:url" content="https://justboil.github.io/admin-one-tailwind/">
  <meta property="og:site_name" content="JustBoil.me">
  <meta property="og:title" content="Admin One HTML">
  <meta property="og:description" content="Admin One - free Tailwind dashboard">
  <meta property="og:image" content="https://justboil.me/images/one-tailwind/repository-preview-hi-res.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1920">
  <meta property="og:image:height" content="960">

  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:title" content="Admin One HTML">
  <meta property="twitter:description" content="Admin One - free Tailwind dashboard">
  <meta property="twitter:image:src" content="https://justboil.me/images/one-tailwind/repository-preview-hi-res.png">
  <meta property="twitter:image:width" content="1920">
  <meta property="twitter:image:height" content="960">

  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-130795909-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-130795909-1');
  </script>

</head>
<body>

<div id="app">

  <nav id="navbar-main" class="navbar is-fixed-top">
    <div class="navbar-brand">
      <a class="navbar-item mobile-aside-button">
        <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
      </a>
      <div class="navbar-item">
        <div class="control">
          <form method="get" action="@yield('axtar')#cedvel">
            <input placeholder="{{ __('messages.axtar') }}..." name="sorgu" class="input">
          </form>
        </div>
      </div>
    </div>
  
    
    <!---------------DİLLƏR START----------------------------------------------------->
    
    <select class="changeLang">
      <option value="en" {{session()->get('locale')=='en' ? 'selected' : ''}}>EN</option>
      <option value="az" {{session()->get('locale')=='az' ? 'selected' : ''}}>AZ</option>
      <option value="ru" {{session()->get('locale')=='ru' ? 'selected' : ''}}>RU</option>
    </select>

    <script>
      let url = "{{route('changeLang')}}"
      $('.changeLang').change(function(){
        window.location.href = url + "?lang=" + $(this).val()
      })
    </script>
    <!----------------DİLLƏR END----------------------------------------------------->
    
  </nav>


  <!--------MENU START------->
  
  <aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
      <div>
      <img src="{{url($logo)}}" class="rounded-full" height="50" width="50">
    
       <b class="font-black">{{$sirket}}fffffff</b>
      </div>
    </div>
    <!---SCROLL kodu------------>
    <div class="scrol">
      <div class="menu is-menu-main">
        <ul class="menu-list">

  @if(Auth::user()->user_admin==1)
    <li class="--set-active-tables-html">
      <a href="{{route('admin')}}">
          <span class="icon"><i class="mdi mdi mdi-desktop-classic"></i></span>
          <span class="menu-item-label">{{ __('messages.admin') }}</span>
        </a>
      </li> 
      
      <li class="--set-active-forms-html">
      <a href="{{route('mesajlar')}}">
          <span class="icon"><i class="mdi mdi-email-receive"></i></span>
          <span class="menu-item-label">{{ __('messages.mesajlar') }}</span>
        </a>
      </li>

      <li class="--set-active-profile-html">
      <a href="{{route('ayarlar')}}">
      <span class="icon"><i class="mdi mdi-cogs"></i></span>
          <span class="menu-item-label">{{ __('messages.ayarlar') }}</span>
        </a>
      </li>
  @endif

  @if(Auth::user()->super_admin==1)


    <li class="--set-active-tables-html">
    <a href="{{route('sadmin')}}">
        <span class="icon"><i class="mdi mdi-seal"></i></span>
        <span class="menu-item-label">{{ __('messages.sadmin') }}</span>
      </a>
    </li> 
    
    <li class="--set-active-tables-html">
    <a href="{{route('manage')}}">
        <span class="icon"><i class="mdi mdi-monitor-dashboard"></i></span>
        <span class="menu-item-label">{{ __('messages.manage') }}</span>
      </a>
    </li> 

    <li class="--set-active-forms-html">
    <a href="{{route('mesajlar')}}">
        <span class="icon"><i class="mdi mdi-email-receive"></i></span>
        <span class="menu-item-label">{{ __('messages.mesajlar') }}</span>
      </a>
    </li>

    <li class="--set-active-profile-html">
      <a href="{{route('ayarlar')}}">
      <span class="icon"><i class="mdi mdi-cogs"></i></span>
          <span class="menu-item-label">{{ __('messages.ayarlar') }}</span>
        </a>
      </li>
  @endif
             
          <p class="menu-label">{{ __('messages.cedveller') }}</p>
          @php

          $secim = array();
          $secim = unserialize(Auth::user()->menyu);
          if(empty($secim))
           {$secim = [];}

          @endphp
          
        

          @if (in_array('5-1',$secim) or in_array('5-2',$secim))
          <li class="--set-active-tables-html">
          <a href="{{route('clients')}}">
              <span class="icon"><i class="mdi mdi-account-group"></i></span>
              <span class="menu-item-label">Nomands(Turistler)</span>
            </a>
          </li>
          @endif

          @if (in_array('7-1',$secim) or in_array('7-2',$secim))
          <li class="--set-active-tables-html">
            <a href="{{route('staff')}}">
              <span class="icon"><i class="mdi mdi-account-tie"></i></span>
              <span class="menu-item-label">Guides(Beledciler)</span>
            </a>
          </li>
          @endif

          @if(Auth::user()->super_admin==0 && Auth::user()->user_admin==0)
          <li class="--set-a(ctive-tables-html">
            <a href="{{route('elaqe')}}">
              <span class="icon"><i class="mdi mdi-email-send"></i></span>
              <span class="menu-item-label">Elaqe</span>
            </a>
          </li>
          @endif

          <p class="menu-label">{{ __('messages.digerler') }}</p>
          
          <li class="--set-active-profile-html">
          <a href="{{route('profil')}}">
              <span class="icon"><i class="mdi mdi-account-circle"></i></span>
              <span class="menu-item-label">{{ __('messages.profil') }}</span>
            </a>
          </li>
          
          <li class="--set-active-profile-html">
          <a href="{{route('logout')}}">
          <span class="icon"><i class="mdi mdi-logout"></i></span>
              <span class="menu-item-label">{{ __('messages.cixis') }}</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </aside>
 
  <!--
  <a href="{{route('brands')}}">brands</a><br>
  <a href="{{route('clients')}}">clients</a><br>
  <a href="{{route('orders')}}">orders</a><br>
  <a href="{{route('xerc')}}">xerc</a><br>
  <a href="{{route('products')}}">products</a><br>
  <a href="{{route('staff')}}">isciler</a><br>
  -->

    @yield('content')



  <!---------------Footer------------>
  <br>
  <footer class="footer">
    <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0">
      <div class="flex items-center justify-start space-x-3">
        <div> 
                                                                                          @php 
                                                                                              $footer = 'null';

                                                                                              $ayarlar = App\Models\ayarlar::get();

                                                                                              if(isset($ayarlar[0])){
                                                                                              $footer = $ayarlar[0]->footer;
                                                                                              }
                                                                                          @endphp
          <p><a href="https://www.dreamtube.pw/about.php" target="_blank"><i class="bi bi-link"><b>{{$footer}}</b></i></a></p>
        </div>
        <a href="https://github.com/justboil/admin-one-tailwind" style="height: 20px">
          <img src="">
        </a>
      </div>
    </div>
  </footer>

<script>
$(document).ready(function () {
$('#cedvel').DataTable();
});
</script>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script type="text/javascript" src="js/chart.sample.min.js"></script>


<script>
  !function(f,b,e,v,n,t,s)
  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
  fbq('init', '658339141622648');
  fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=658339141622648&ev=PageView&noscript=1"/></noscript>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>
</html>

