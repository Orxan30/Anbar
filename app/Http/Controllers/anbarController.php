<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash; //--Sifreleme kitabxanasi
use Illuminate\Support\Facades\Auth; //--emailin ve sifrelenmis parolu dogruluqunu yoxluyur


use App\Exports\ExportClient;

use App\Exports\ExportStaff;
use App\Exports\ExportSened;

use Maatwebsite\Excel\Facades\Excel;

use App\Models\clients;

use App\Models\staff;
use App\Models\profil;
use App\Models\User;
use App\Models\login;
use App\Models\contact;
use App\Models\pul;
use App\Models\sened;
use App\Models\valyutalar;
use App\Models\ayarlar;




class anbarController extends Controller
{ 
//========================MANAGE START====================================================      
    public function umanage(Request $p){
        if(Auth::user()->super_admin==1){

            $u = User::find($p->user_id);
            $users = User::orderBy('ad','desc')
            ->get();
            return view('manage',[
                'users'=>$users,
                'u'=>$u
            ]);
        }
        return redirect()->back();
    }


    public function pmanage(Request $p){
        if(Auth::user()->super_admin==1){

            $secimler = serialize($p->secim);

            $con = User::find($p->user_id);
            $con->menyu = $secimler;
            $con->save();

            return redirect()->route('manage');
        }
        return redirect()->back();
    }

    public function manage(){
        if(Auth::user()->super_admin==1){
            $users = User::where('super_admin','=',0)
            ->orderBy('ad','desc')->get();
            return view('manage',[
                'users'=>$users
            ]);
        }
        return redirect()->back();
    }
//========================MANAGE END====================================================    
//================EXPORT START==========================================================

    public function Cexport(){
       
        return Excel::download(new ExportClient,'clients.xlsx');
    
    }

    public function staffexport(){
       
        return Excel::download(new ExportStaff,'staff.xlsx');
    
    }
    public function senedexport(){
       
        return Excel::download(new ExportSened,'sened.xlsx');
    
    }

//========================EXPORT END====================================================
//==========CONTACT START==============================================================
    public function COindex(){

        $contact = contact::orderBy('id','desc')->get();
       
        return view('mesajlar',[
            'data'=>$contact
        ]);
    
    }

    public function msil($x){

        $sil = contact::find($x);
        $contact = contact::orderBy('id','desc')->get();

    
                return view('mesajlar',[
                'sil_id'=>$sil->id,
                'mesaj'=>$sil->ad,
                'data'=>$contact    
                 ]);
        return redirect()->route('mesajlar')->with('mesaj2','Mesaj silinmedi!');
    }
    
    public function myes($x){
        
        $sil = contact::find($x);
        $sil->delete();
        return redirect()->route('mesajlar')->with('mesaj','Mesaj ugurla silindi');
    }

    public function COok(Request $post){
        
          $con = new contact();

           $con->ad = $post->ad;
           $con->telefon = $post->telefon;
           $con->movzu = $post->movzu;
           $con->metn = $post->metn;
           $con->email = $post->email;
           
           $con-> save(); 
            
            return redirect()->route('login')->with('mesaj', __('messages.melumatugur'));
        
      }

      public function Eok(Request $post){
        
        $con = new contact();

         $con->ad = $post->ad;
         $con->telefon = $post->telefon;
         $con->movzu = $post->movzu;
         $con->metn = $post->metn;
         $con->email = $post->email;
         
         $con-> save(); 
          
          return redirect()->route('elaqe')->with('mesaj', __('messages.melumatugur'));
      
    }
//========================CONTACT END==================================================  
//===========LOGIN START===============================================================
    public function login(Request $post){
      
        $this->validate($post,['email'=>'required|email','password'=>'required']);

        $yoxla = user::where('email','=',$post->email)
        ->where('admin_block','=',0)->count();

        $yoxla2 = user::where('email','=',$post->email)->count();
        
        if($yoxla2 > 0){
            
            if($yoxla == 1){

                if(!Auth::attempt(['email'=>$post->email,'password'=>$post->password])){

                return redirect()->back()->with('mesaj2', __('messages.loginparolyanlis'));
                }
                setcookie('fm', time(), time() + (86400 * 30), "/");
                return redirect()->route('profil');
            }
            return redirect()->route('login')->with('mesaj2', __('messages.hesabaktivdeyil'));

        } return redirect()->back()->with('mesaj2', __('messages.loginparolyanlis'));

    }

    public function logout(Request $post){
      
            setcookie('fm', time(), time() - (86400 * 30), "/");
            auth()->logout();
    
            return redirect()->route('login');
  
    }
//========================LOGIN END====================================================
//=========AYARLAR START===============================================================
public function LGupdate(Request $post){
  

    $con = ayarlar::find(1);
    
    if($post->file('Logo'))
    {
         $post->validate([
             'Logo'=>'image|mimes:jpg,png,gif,svg,jpeg,webp|max:20480'
         ]);

         $file = time().'.'.$post->Logo->extension();
         $post->Logo->storeAs('public/uploads/users',$file);
         $con->Logo = 'storage/uploads/users/'.$file;

    }
    $con->sirket = $post->sirket;
    $con->save();

    return redirect()->route('ayarlar')->with('mesaj', __('messages.melumatyenilendi'));

}

public function EMupdate(Request $post){
  

    $con = ayarlar::find(1);
    
    $con->mail = $post->mail;
    $con->tel = $post->tel;
    $con->unvan = $post->unvan;

    $con->save();

    return redirect()->route('ayarlar')->with('mesaj2', __('messages.melumatyenilendi'));

}

public function FTRupdate(Request $post){
  

    $con = ayarlar::find(1);
    
    $con->footer = $post->footer;

    $con->save();

    return redirect()->route('ayarlar')->with('mesaj4', __('messages.melumatyenilendi'));

}

    //=====================VALYUTA AYARLARI START================================
    public function Vindex(){
        if(Auth::user()->super_admin==1){

            $valyutalar = valyutalar::orderBy('id','desc')
            ->get();
        
            return view('valyutalar',[
                'data'=>$valyutalar
            ]);
        }
        return redirect()->back();

    }

    public function Vok(Request $post){
        if(Auth::user()->super_admin==1){
            
            $con = new valyutalar();
            
            $yoxla = valyutalar::where('ad','=',$post->ad)
            ->count();

            if($yoxla==0)
            {     
                if(!empty($post->ad)){
                    $con->user_id = Auth::id();
                    $con->ad = $post->ad;
                    $con-> save();
                    
                    return redirect()->route('valyutalar')->with('mesaj', __('messages.melumatugur'));
                }
            
                return redirect()->route('valyutalar')->with('mesaj2', __('messages.melumattamdaxilet'));
            }
            return redirect()->route('valyutalar')->with('mesaj2', __('messages.melumatmovcuddur'));
        }
        return redirect()->back();
    }

    public function Vedit($x){
        if(Auth::user()->super_admin==1){
        
            $edit = valyutalar::find($x);
            $valyutalar = valyutalar::orderBy('id','desc')->get();

            return view('valyutalar',[
                'edit'=>$edit,
                'data'=>$valyutalar
            ]);
        }
        return redirect()->back();
    }

    public function Vupdate(Request $post,$x){
        if(Auth::user()->super_admin==1){
        
            $con = valyutalar::find($x);
            $yoxla = valyutalar::where('ad','=',$post->ad)
            ->where('id','!=',$x)
            ->count();
            if($yoxla==0)
            {
            $con->ad = $post->ad;

            $con->save();

            return redirect()->route('valyutalar')->with('mesaj', __('messages.pulyenilendi'));
            }
            return redirect()->route('valyutalar')->with('mesaj2',__('messages.pulmovcuddur'));
        }
        return redirect()->back();
    }

    public function Vsil($x){
        if(Auth::user()->super_admin==1){

            $sil = valyutalar::find($x);
            $valyutalar = valyutalar::orderBy('id','desc')
            ->get();

            $yoxla = valyutalar::join('puls','puls.valyuta_id','=','valyutalars.id')
            ->count();

            if($yoxla==0){
                    return view('valyutalar',[
                    'sil_id'=>$sil->id,
                    'valyuta'=>$sil->ad,
                    'data'=>$valyutalar
                    ]);
            }
            return redirect()->route('valyutalar')->with('mesaj2', __('messages.spulsilinmir'));
        }
        return redirect()->back();
    }

    public function Vyes($x){
        
        $sil = valyutalar::find($x);
        $sil->delete();
        return redirect()->route('valyutalar')->with('mesaj', __('messages.psilindi'));
    }

    //===========================VALYUTA AYARLARI END=============================
    //====DIL ayaralri========PUL AYARLARI START ==============================================
    public function indexApul(){
        if(Auth::user()->super_admin==1){

            $pul = pul::join('valyutalars','valyutalars.id','=','puls.valyuta_id')
            ->select('*','puls.id',)
            ->orderBy('puls.id','desc')
            ->get();

            $valyutalar = valyutalar::orderBy('ad','asc')
            ->get();
        
            return view('ayarlar',[
                'data'=>$pul,
                'valyutalar'=>$valyutalar,
            ]);
        }
        return redirect()->back();

    }

    //============================PUL AYARLARI END================================

//=====================AYARLAR END=============================================================
//=========SUPER admin START====================================================================
public function sadmin(){

    $admin = user::orderBy('id','desc')
    ->where('super_admin','=',0)
    ->get();
   
    return view('sadmin',[
        'data'=>$admin
    ]);

}

public function sAdminok(Request $post){
        
    $con = new user();

     if($post->password==$post->tparol){

        if($post->file('Ufoto'))
        {
             $post->validate([
                 'Ufoto'=>'image|mimes:jpg,png,gif,svg,jpeg,webp|max:20480'
             ]);

             $file = time().'.'.$post->Ufoto->extension();
             $post->Ufoto->storeAs('public/uploads/users',$file);
             $con->Ufoto = 'storage/uploads/users/'.$file;

        }
        
       $con->ad = $post->ad;
       $con->soyad = $post->soyad;
       $con->telefon = $post->telefon;
       $con->email = $post->email;
       
       $con->password = Hash::make($post->password);
        $con-> save(); 
        
        return redirect()->route('sadmin')->with('mesaj', __('messages.adminugur'));
    }
    return redirect()->route('sadmin')->with('mesaj2',__('messages.tparolyanlisdir'));

}


public function sAUsil($x){

    $sil = user::find($x);
    $users = user::orderBy('id','desc')
    ->where('super_admin','=',0)
    ->get();

            return view('sadmin',[
            'sil_id'=>$sil->id,
            'user'=>$sil->ad,
            'data'=>$users
             ]);
    return redirect()->route('sadmin')->with('mesaj2', __('messages.adminsilinmedi'));
}

public function sAUyes($x){
    
        $sil = user::where('id','=',$x)->first();
    $sil2 = unlink($sil->Ufoto);    
    $sil->delete();
    return redirect()->route('sadmin')->with('mesaj', __('messages.adminsilindi'));
}

public function sAUblock($x){
        
    $con = user::find($x);

        
        $con->admin_block = 1;       
        $con-> save(); 
         
         return redirect()->route('sadmin')->with('mesaj2', __('messages.block'));

}

public function sAUopen($x){
        
    $con = user::find($x);

        
        $con->admin_block = 0;       
        $con-> save(); 
         
         return redirect()->route('sadmin')->with('mesaj', __('messages.unblock'));

}

public function AUadmin($x){
        
    $con = user::find($x);

        
        $con->user_admin = 1;       
        $con-> save(); 
         
         return redirect()->route('sadmin')->with('mesaj3', __('messages.adminedildi'));

}

public function AUuser($x){
        
    $con = user::find($x);

        
        $con->user_admin = 0;       
        $con-> save(); 
         
         return redirect()->route('sadmin')->with('mesaj2', __('messages.adminlegv'));

}
//=============Super ADMIN end====================================

public function admin(){

    $admin = user::orderBy('id','desc')
    ->where('super_admin','=',0)
    ->where('user_admin','=',0)
    ->get();
   
    return view('admin',[
        'data'=>$admin
    ]);

}

public function Adminok(Request $post){
        
    $con = new user();

     if($post->password==$post->tparol){
        
        if($post->file('Ufoto'))
        {
             $post->validate([
                 'Ufoto'=>'image|mimes:jpg,png,gif,svg,jpeg,webp|max:20480'
             ]);

             $file = time().'.'.$post->Ufoto->extension();
             $post->Ufoto->storeAs('public/uploads/users',$file);
             $con->Ufoto = 'storage/uploads/users/'.$file;

        }
    
       $con->ad = $post->ad;
       $con->soyad = $post->soyad;
       $con->telefon = $post->telefon;
       $con->email = $post->email;
       
       $con->password = Hash::make($post->password);
        $con-> save(); 
        
        return redirect()->route('admin')->with('mesaj','User qeydiyat edildi');
    }
    return redirect()->route('admin')->with('mesaj2',__('messages.tparolyanlisdir'));

}

public function sAUedit($x){
    if(Auth::user()->super_admin==1){
    
        $edit = user::find($x);
        
        $user = user::orderBy('id','desc')
        ->where('super_admin','=',0)
        ->where('user_admin','=',0)
        ->get();

        return view('sadmin',[
            'edit'=>$edit,
            'data'=>$user
        ]);
    }
    return redirect()->back();
}

public function sAUupdate(Request $post,$x){
        
    $con = user::find($x);

        if($post->file('Ufoto'))
        {
             $post->validate([
                 'Ufoto'=>'image|mimes:jpg,png,gif,svg,jpeg,webp|max:20480'
             ]);

             $file = time().'.'.$post->Ufoto->extension();
             $post->Ufoto->storeAs('public/uploads/users',$file);
             $con->Ufoto = 'storage/uploads/users/'.$file;

        }

        
        $con->ad = $post->ad;
        $con->soyad = $post->soyad;
        $con->telefon = $post->telefon;
        $con->email = $post->email;
        $con->password = Hash::make($post->password);
        
        $con-> save(); 
         
         return redirect()->route('sadmin')->with('mesaj', __('messages.melumatyenilendi'));

}


public function AUsil($x){

    $sil = user::find($x);
    $users = user::orderBy('id','desc')
    ->where('super_admin','=',0)
    ->where('user_admin','=',0)
    ->get();

            return view('admin',[
            'sil_id'=>$sil->id,
            'user'=>$sil->ad,
            'data'=>$users
             ]);
    return redirect()->route('admin')->with('mesaj2','User silinmedi!');
}

public function AUyes($x){
    
    $sil = user::where('id','=',$x)->first();
    $sil2 = unlink($sil->Ufoto);    
    $sil->delete();

    return redirect()->route('admin')->with('mesaj','User silindi');
}

public function AUblock($x){
        
    $con = user::find($x);

        
        $con->admin_block = 1;       
        $con-> save(); 
         
         return redirect()->route('admin')->with('mesaj','User blocklandi');

}

public function AUopen($x){
        
    $con = user::find($x);

        
        $con->admin_block = 0;       
        $con-> save(); 
         
         return redirect()->route('admin')->with('mesaj3','User blockdan acildi');

}
//===============ADMIN END============================================  
//========================USERS START=================================================    
    public function Proindex(){

        $users = user::orderBy('id','desc');
       
        return view('profil',[
            'data'=>$users
        ]);
    
    }

    public function Prupdate(Request $post){
        
        $con = user::find(Auth::id());

        if(Hash::check($post->password,$con->password))
        {
            if($post->file('Ufoto'))
            {
                 $post->validate([
                     'Ufoto'=>'image|mimes:jpg,png,gif,svg,jpeg,webp|max:20480'
                 ]);
 
                 $file = time().'.'.$post->Ufoto->extension();
                 $post->Ufoto->storeAs('public/uploads/users',$file);
                 $con->Ufoto = 'storage/uploads/users/'.$file;
 
            }
 
            
            $con->ad = $post->ad;
            $con->soyad = $post->soyad;
            $con->telefon = $post->telefon;
            $con->email = $post->email;
            
            $con-> save(); 
             
             return redirect()->route('profil')->with('mesaj', __('messages.melumatyenilendi'));
        }
        else 
        {return redirect()->route('profil')->with('mesaj2', __('messages.parolyanlis'));}

    
    }

    public function Parolupdate(Request $post){
        
        $con = user::find(Auth::id());
        
        if(Hash::check($post->password,$con->password))
        {
            if($post->newpassword==$post->Tnewpassword)
            {
                $con->password = Hash::make($post->newpassword);  
                $con-> save(); 
            
            return redirect()->route('profil')->with('mesaj', __('messages.parolyenilendi'));  
            }
            return redirect()->route('profil')->with('mesaj2', __('messages.tparolyanlisdir'));
        }
        else 
        {return redirect()->route('profil')->with('mesaj2',__('messages.cparolyanlisdir'));}   
    }

    
    public function index7(){

        $users = user::orderBy('id','desc')->get();
       
        return view('users',[
            'data'=>$users
        ]);

    }

    public function ok7(Request $post){
        
        $con = new user();

         if($post->password==$post->tparol){
            
           
        
           $con->ad = $post->ad;
           $con->soyad = $post->soyad;
           $con->telefon = $post->telefon;
           $con->email = $post->email;
           
           $con->password = Hash::make($post->password);
            $con-> save(); 
            
            return redirect()->route('login')->with('mesaj', __('messages.registerok'));
        }
        return redirect()->route('users')->with('mesaj2',__('messages.tparolyanlisdir'));

      }

//========================USERS END=========================================================

//=============CLIENTS START======================================================================
    public function index2(Request $post){
        $secim = array();
        $secim = unserialize(Auth::user()->menyu);
        if(empty($secim)){$secim = [];}

        if(in_array('5-1',$secim) or in_array('5-2',$secim)){

            $clients = clients::orderBy('id','desc')
         
            ->where(function($query) use ($post){
                $query->where('ad','LIKE','%'.$post->sorgu.'%')
                    ->orwhere('soyad','LIKE','%'.$post->sorgu.'%')
                    ->orwhere('telefon','LIKE','%'.$post->sorgu.'%')
                    ->orwhere('email','LIKE','%'.$post->sorgu.'%')
                    ->orwhere('created_at','LIKE','%'.$post->sorgu.'%')
            ;})
            ->get();

            $clients2 = clients::orderBy('id','desc')
            ->get();

            return view('clients',[
                'data'=>$clients,
                'clients2'=>$clients2
            ]);
        }
        return redirect()->back();

    }

    public function ok2(Request $post){
        $secim = array();
        $secim = unserialize(Auth::user()->menyu);
        if(empty($secim)){$secim = [];}

        if(in_array('5-2',$secim)){

            $con = new clients();
            $yoxla = clients::where('telefon','=',$post->telefon)
         
            ->count();

            if($yoxla==0){

                if(!empty($post->ad) && !empty($post->soyad) && !empty($post->telefon) && !empty($post->email) && !empty($post->Cfoto)){
                    if($post->file('Cfoto'))
                    {
                        $post->validate([
                            'Cfoto'=>'image|mimes:jpg,png,gif,svg,jpeg,webp|max:20480'
                        ]);
        
                        $file = time().'.'.$post->Cfoto->extension();
                        $post->Cfoto->storeAs('public/uploads/clients',$file);
                        $con->Cfoto = 'storage/uploads/clients/'.$file;
        
                    }
            
                $con->user_id = Auth::id();
                $con->ad = $post->ad;
                $con->soyad = $post->soyad;
                $con->telefon = $post->telefon;
                $con->email = $post->email;
                $con-> save();
        
                return redirect()->route('clients')->with('mesaj', __('messages.melumatugur'));

                }
                return redirect()->route('clients')->with('mesaj2', __('messages.melumattamdaxilet'));           

            }
            return redirect()->route('clients')->with('mesaj2', __('messages.melumatmovcuddur'));
        }
        return redirect()->back();
    }

    public function Csil($x){
        $secim = array();
        $secim = unserialize(Auth::user()->menyu);
        if(empty($secim)){$secim = [];}

        if(in_array('5-2',$secim)){

            $sil = clients::find($x);
            $yoxla = orders::where('musteri_id','=',$x)
            ->count();
            
            if($yoxla == 0){ 
                $clients = clients::orderBy('id','desc')
                ->get();
        
                $clients2 = clients::orderBy('id','desc')
                ->get();


                return view('clients',[
                    'sil_id'=>$sil->id,
                    'ad'=>$sil->ad,
                    'soyad'=>$sil->soyad,
                    'data'=>$clients,
                    'clients2'=>$clients2
                ]);
            }
            return redirect()->route('clients')->with('mesaj2',__('messages.maktivsifaris'));
        }
        return redirect()->back();
    }

    public function Cyes($x){
        
        $sil = clients::find($x);
        $sil->delete();
        return redirect()->route('clients')->with('mesaj',__('messages.msilindi'));
    }
    
    public function Cedit($x){
        $secim = array();
        $secim = unserialize(Auth::user()->menyu);
        if(empty($secim)){$secim = [];}

        if(in_array('5-2',$secim)){
            $edit = clients::find($x);
            $clients = clients::orderBy('id','desc')
            ->get();

            $clients2 = clients::orderBy('id','desc')
            ->get();


            return view('clients',[
                'edit'=>$edit,
                'data'=>$clients,
                'clients2'=>$clients2
            ]);
        }
        return redirect()->back();
    
    }

    public function Cupdate(Request $post,$x){
        $con = clients::find($x);
        $yoxla = clients::where('telefon','=',$post->telefon)
        ->where('id','!=',$x)
        ->count();
        if($yoxla==0){
            if($post->file('Cfoto'))
            {
                 $post->validate([
                     'Cfoto'=>'image|mimes:jpg,png,gif,svg,jpeg,webp|max:20480'
                 ]);
 
                 $file = time().'.'.$post->Cfoto->extension();
                 $post->Cfoto->storeAs('public/uploads/clients',$file);
                 $con->Cfoto = 'storage/uploads/clients/'.$file;
 
            }

        $con->ad = $post->ad;
        $con->soyad = $post->soyad;
        $con->telefon = $post->telefon;
        $con->email = $post->email;

        $con->save();

        return redirect()->route('clients')->with('mesaj', __('messages.musteriyenilendi'));
        }
        return redirect()->route('clients')->with('mesaj2', __('messages.telmovcuddur'));
    }
//==============CLIENTS END======================================================================

//=========================STAFF START===========================================================
    public function Supdate(Request $post,$x){

        $con = staff::find($x);
        $yoxla = staff::where('tel','=',$post->tel)
        ->where('id','!=',$x)
        ->count();
        if($yoxla==0){

            if($post->file('Sfoto'))
                {
                    $post->validate([
                        'Sfoto'=>'image|mimes:jpg,png,gif,svg,jpeg,webp|max:20480'
                    ]);
    
                    $file = time().'.'.$post->Sfoto->extension();
                    $post->Sfoto->storeAs('public/uploads/isciler',$file);
                    $con->Sfoto = 'storage/uploads/isciler/'.$file;
    
                }
            
        $con->ad = $post->ad;
        $con->soyad = $post->soyad;
        $con->tel= $post->tel;
        $con->email= $post->email;
        $con->dil_id = $post->dil_id;
        $con->save();

        return redirect()->route('staff')->with('mesaj',__('messages.isciyenilendi'));
        }
        return redirect()->route('staff')->with('mesaj',__('messages.telmovcuddur'));
    }
  
    public function Sedit($x){
        $secim = array();
        $secim = unserialize(Auth::user()->menyu);
        if(empty($secim)){$secim = [];}
    
        if(in_array('7-2',$secim)){
            $edit = staff::find($x);
            
            $staff = staff::orderBy('staff.id','desc')
            ->get();

            $staff2 = staff::orderBy('staff.id','desc')
            ->get();
            
            $sened = sened::join('staff','staff.id','=','seneds.staff_id')
            ->where('seneds.user_id','=',Auth::id())
            ->count();

            
            return view('staff',[
            'edit'=>$edit,
            'data'=>$staff,
            'staff2'=>$staff2,
            'sened'=>$sened

            ]);
        }
        return redirect()->back();
    }
  
    public function Ssil($x){
        $secim = array();
        $secim = unserialize(Auth::user()->menyu);
        if(empty($secim)){$secim = [];}
    
        if(in_array('7-2',$secim)){
            $sil = staff::find($x);

            $yoxla = planner::where('staff_id','=',$x)
            ->where('Ptesdiq','=',0)
            ->count();
            
            if($yoxla == 0){ 

                $staff = staff::orderBy('staff.id','desc')
                ->get();
        
                $staff2 = staff::orderBy('staff.id','desc')
                ->get();
                
                $sened = sened::join('staff','staff.id','=','seneds.staff_id')
                ->where('seneds.user_id','=',Auth::id())
                ->count();

                return view('staff',[
                'sil_id'=>$sil->id,
                'ad'=>$sil->ad,
                'soyad'=>$sil->soyad,
                'data'=>$staff,
                'staff2'=>$staff2,
                'sened'=>$sened
                ]);
            }
            return redirect()->route('staff')->with('mesaj2',__('messages.isciaktivtap'));
        }
        return redirect()->back();
    }
    
    public function Syes($x){
        $sil = staff::find($x);
        
        $sil2 = sened::where('staff_id','=',$x);
        $sil2->delete();
        
        $sil->delete();
        return redirect()->route('staff')->with('mesaj',__('messages.iscisilindi'));
    }
  
    public function ok6(Request $post){
        $secim = array();
        $secim = unserialize(Auth::user()->menyu);
        if(empty($secim)){$secim = [];}
    
        if(in_array('7-2',$secim)){
            $con = new staff();
            $yoxla = staff::where('tel','=',$post->tel)
            ->count();
            
            if($yoxla==0){

            $con->user_id = Auth::id();
            $con->ad = $post->ad;
            $con->soyad = $post->soyad;
            $con->tel = $post->tel;
            $con->email = $post->email;
            $con->dil_id = $post->dil_id;
            $con->save();

            return redirect()->route('staff')->with('mesaj', __('messages.melumatugur'));
            }
            return redirect()->route('staff')->with('mesaj2',__('messages.telmovcuddur'));
        }
        return redirect()->back();
    }
     
    public function index6(Request $post){
        $secim = array();
        $secim = unserialize(Auth::user()->menyu);
        if(empty($secim)){$secim = [];}
    
        if(in_array('7-1',$secim) or in_array('7-2',$secim)){

            $valyutalar = valyutalar::orderBy('id','desc')
            ->get();

            $staff = staff::join('valyutalars','valyutalars.id','=','staff.dil_id')
            ->select('*','valyutalars.id','valyutalars.ad as add')
            ->orderBy('staff.id','desc')
            ->where(function($query) use ($post){
                $query->where('staff.ad', 'LIKE', '%'.$post->sorgu.'%')
                    ->orWhere('soyad', 'LIKE', '%'.$post->sorgu.'%')
                    ->orWhere('tel', 'LIKE', '%'.$post->sorgu.'%')
                    ->orWhere('email', 'LIKE', '%'.$post->sorgu.'%')
            ;})
            ->get();

            $staff2 = staff::orderBy('staff.id','desc')
            ->get();

            $sened = sened::join('staff','staff.id','=','seneds.staff_id')
            ->where('seneds.user_id','=',Auth::id())
            ->count();

            return view('staff',[
            'data'=>$staff,
            'staff2'=>$staff2,
            'sened'=>$sened,
            'valyutalar'=>$valyutalar
            ]); 
        }
        return redirect()->back();   
    }
//=========================STAFF END===========================================================
//=====================SENED START==============================================================
public function senedlerim(Request $post,$x){
    $secim = array();
    $secim = unserialize(Auth::user()->menyu);
    if(empty($secim)){$secim = [];}

    if(in_array('7-1',$secim) or in_array('7-2',$secim)){
        $sened = sened::join('staff','staff.id','=','seneds.staff_id')
        ->where('staff.id','=',$x)
        ->select('*','seneds.id','seneds.ad as add')
        ->orderBy('seneds.id','desc')
        ->where('seneds.user_id','=',Auth::id())
        ->where(function($query) use ($post){
            $query->where('cod', 'LIKE', '%'.$post->sorgu.'%')
                ->orWhere('seneds.ad', 'LIKE', '%'.$post->sorgu.'%')
                ->orWhere('metn', 'LIKE', '%'.$post->sorgu.'%')
        ;})
        ->get();

        $sened2 = sened::join('staff','staff.id','=','seneds.staff_id')
        ->where('staff.id','=',$x)
        ->select('*','seneds.id','seneds.ad as add')
        ->orderBy('seneds.id','desc')
        ->where('seneds.user_id','=',Auth::id())
        ->get();

        $staff = staff::join('sobes','sobes.id','=','staff.vezife_id')
        ->join('vezives','vezives.id','=','staff.vezife_id')
        ->select('*','staff.id','staff.ad as add')
        ->orderBy('staff.id','desc')
        ->where('staff.user_id','=',Auth::id())
        ->get();

        return view('senedlerim',[
            'data'=>$sened,
            'sened2'=>$sened2,
            'staff'=>$staff,
            'x'=>$x
        ]);
    }
    return redirect()->back();
}

public function Sok(Request $post){

    $con = new sened();

    $yoxla = sened::where(function($query) use ($post){
        $query->where('cod','=',$post->cod)
    ;})
    ->count();

    if($yoxla==0)
    {     
        if(!empty($post->ad) && !empty($post->metn) && !empty($post->cod) && !empty($post->staff_id)){
            if($post->file('Sndfoto'))
                    {
                        $post->validate([
                            'Sndfoto'=>'image|mimes:jpg,png,gif,svg,jpeg,webp|max:20480'
                        ]);
        
                        $file = time().'.'.$post->Sndfoto->extension();
                        $post->Sndfoto->storeAs('public/uploads/senedler',$file);
                        $con->Sndfoto = 'storage/uploads/senedler/'.$file;
        
                    }

            $con->user_id = Auth::id();
            $con->staff_id = $post->staff_id;
            $con->cod = $post->cod;
            $con->ad = $post->ad;
            $con->metn = $post->metn;
            $con-> save();
            
            return redirect()->route('senedlerim',$post->staff_id)->with('mesaj', __('messages.melumatugur'));
        }    
        return redirect()->route('senedlerim',$post->staff_id)->with('mesaj2', __('messages.melumattamdaxilet'));
    }
    return redirect()->route('senedlerim',$post->staff_id)->with('mesaj2', __('messages.codmelumatmovcuddur'));
}


    public function Sndsil($x,$staff_id){
        $secim = array();
        $secim = unserialize(Auth::user()->menyu);
        if(empty($secim)){$secim = [];}
    
        if(in_array('7-2',$secim)){
            $sil = sened::find($x);

            $sened = sened::join('staff','staff.id','=','seneds.staff_id')
            ->where('staff.id','=',$staff_id)
            ->select('*','seneds.id','seneds.ad as add')
            ->orderBy('seneds.id','desc')
            ->where('seneds.user_id','=',Auth::id())
            ->get();
        
            $sened2 = sened::join('staff','staff.id','=','seneds.staff_id')
            ->where('staff.id','=',$staff_id)
            ->select('*','seneds.id','seneds.ad as add')
            ->orderBy('seneds.id','desc')
            ->where('seneds.user_id','=',Auth::id())
            ->get();
        
            $staff = staff::join('sobes','sobes.id','=','staff.vezife_id')
            ->join('vezives','vezives.id','=','staff.vezife_id')
            ->select('*','staff.id','staff.ad as add')
            ->orderBy('staff.id','desc')
 
            ->get();

            return view('senedlerim',[
                'sil_id'=>$sil->id,
                'data'=>$sened,
                'sened2'=>$sened2,
                'staff'=>$staff,
                'x'=>$sil->staff_id,
                'sened'=>$sil->ad

            ]);
        }
        return redirect()->back();
    }

    public function Sndyes($x){
        
        $sil = sened::find($x);
        $sil->delete();
        return redirect()->route('senedlerim',$sil->staff_id)->with('mesaj',__('messages.senedsilindi'));
    }

    public function Sndedit($x,$staff_id){
        $secim = array();
        $secim = unserialize(Auth::user()->menyu);
        if(empty($secim)){$secim = [];}
    
        if(in_array('7-2',$secim)){
            $edit = sened::find($x);
            $sened = sened::join('staff','staff.id','=','seneds.staff_id')
            ->where('staff.id','=',$staff_id)
            ->select('*','seneds.id','seneds.ad as add')
            ->orderBy('seneds.id','desc')
            ->where('seneds.user_id','=',Auth::id())
            ->get();
        
            $sened2 = sened::join('staff','staff.id','=','seneds.staff_id')
            ->where('staff.id','=',$staff_id)
            ->select('*','seneds.id','seneds.ad as add')
            ->orderBy('seneds.id','desc')
            ->where('seneds.user_id','=',Auth::id())
            ->get();
        
            $staff = staff::join('sobes','sobes.id','=','staff.vezife_id')
            ->join('vezives','vezives.id','=','staff.vezife_id')
            ->select('*','staff.id','staff.ad as add')
            ->orderBy('staff.id','desc')
 
            ->get();

            return view('senedlerim',[
                'edit'=>$edit,
                'data'=>$sened,
                'sened2'=>$sened2,
                'staff'=>$staff,
                'x'=>$edit->staff_id
            ]);
        }
        return redirect()->back();
    }

    public function Sndupdate(Request $post){
        $con = sened::find($post->id);
        $yoxla = sened::where(function($query) use ($post){
            $query->where('cod','=',$post->cod)
        ;})
        ->where('id','!=',$post->id)
        ->count();
        if($yoxla==0)
        {
        
        $con->cod = $post->cod;
        $con->ad = $post->ad;
        $con->metn = $post->metn;

        $con->save();

        return redirect()->route('senedlerim',$con->staff_id)->with('mesaj',__('messages.senedyenilendi'));
        }
        return redirect()->route('senedlerim',$con->staff_id)->with('mesaj',__('messages.codmelumatmovcuddur'));
    }
//===SENED  END==================================================================================

}


    






