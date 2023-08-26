<!DOCTYPE html>
<html lang="en" class="form-screen">
<head>
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
  <title>{{$sirket}} - {{ __('messages.qeydiyat') }}</title>

  <!-- Tailwind is included -->
  <link rel="stylesheet" href="css/main.css?v=1628755089081">

  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png"/>
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png"/>
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png"/>
  <link rel="mask-icon" href="safari-pinned-tab.svg" color="#00b4b6"/>

  <meta name="description" content="Anbar">

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
<style> 
body{
    /* The image used */
    background-image: url("stock.jpg");

    /* Full height */
    height: 100%;

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
</style>
  <section class="section main-section">  
        <div class="card">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-lock"></i></span>
              {{ __('messages.qeydiyat') }}
            </p>
                <!---------------DİLLƏR START----------------------------------------------------->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
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
          </header>
          <div class="card-content">
            <style>
              .field.spaced:not(:last-child){margin-bottom: 1px;}
              </style>
            <form method="post" action="{{route('Ugonder')}}">
    
            @csrf
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
              <div class="field spaced">
                <label class="label">{{ __('messages.ad') }}:</label>
                <div class="control icons-left">
                  <input class="input" type="text" name="ad" placeholder="{{ __('messages.adyaz') }}..." required="">
                  <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                </div>
              </div>
    
              <div class="field spaced">
                <label class="label">{{ __('messages.soyad') }}:</label>
                <div class="control icons-left">
                  <input class="input" type="text" name="soyad" placeholder="{{ __('messages.soyadyaz') }}..." required="">
                  <span class="icon is-small left"><i class="mdi mdi-account"></i></span>
                </div>
              </div>

              <label class="label">{{ __('messages.tel') }}:</label>
            <div class="field spaced">
                <div class="field addons">
                  <div class="control">
                    <input class="input" value="+1" size="3" readonly="">
                  </div>
                  <div class="control expanded">
                    <input class="input" type="tel" placeholder="{{ __('messages.telyaz') }}" name="telefon" required="">
                  </div>
                </div>
              </div>

              <div class="field spaced">
                <label class="label">{{ __('messages.email') }}:</label>
                <div class="control icons-left">
                  <input class="input" type="text" name="email" placeholder="user@example.com" required="">
                  <span class="icon is-small left"><i class="mdi mdi-mail-ru"></i></span>
                </div>
              </div>
    
              <div class="field spaced">
                <label class="label">{{ __('messages.parol') }}:</label>
                <p class="control icons-left">
                  <input class="input" type="password" name="password" placeholder="{{ __('messages.pyaz') }}..." required="">
                  <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                </p>
              </div>
 
              <div class="field spaced">
                <label class="label">{{ __('messages.tparol') }}:</label>
                <p class="control icons-left">
                  <input class="input" type="password" name="tparol" placeholder="{{ __('messages.tpyaz') }}..." required="">
                  <span class="icon is-small left"><i class="mdi mdi-asterisk"></i></span>
                </p>
                <p class="help">
                  {{ __('messages.peyp') }} <br>
                  {{ __('messages.logkec') }} 
                </p>
              </div>
              
              <br>

              <div class="field grouped">
                <div class="control">
                  <button type="submit" class="button green">
                  {{ __('messages.qeydiyatk') }} 
                  </button>
                  <a href="{{route('login')}}" button type="button" class="button blue">
                  {{ __('messages.hdaxilol') }} 
                  </button>
                  </a>
                </div>
              </div>
    
            </form>
          </div>
        </div>
    
      </section>

</div>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js?v=1628755089081"></script>


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
