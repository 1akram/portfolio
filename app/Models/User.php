<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Storage;
use App\Models\Skill;
use App\Models\SocialMedia;
class User extends Authenticatable
{
    protected $table='users';
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function age(){
       return(\Carbon\Carbon::parse($this->birthDay)->diff(\Carbon\Carbon::now())->y);
      
       
    }
    public function projects(){
        return $this->hasMany(Project::class);
    }
    public function services(){
        return $this->hasMany(Service::class);
    }
    public function skills(){
        return $this->hasMany(Skill::class);
    }
    public function uploadAvatar($avatar){
      
        Storage::disk('public')->delete($this->avatar);
        $this->avatar=null;
        if ($avatar->isValid()) {
            $this->avatar= $avatar->store('avatars', 'public' ) ;  
        }
        $this->save();
    }

    
    public function updateInfo($request){
        
        $this->name=$request['name'];
        $this->email=$request['email'];
        $this->birthDay=new Carbon($request['birthDay']);
        $this->phone=$request['phone'];
        $this->address=$request['address'];
        if(!isset($request['skillName'])||!isset($request['skillProgress'])){
            $request['skillName']=[];
            $request['skillProgress']=[]; 
        }
        $this->updateSkills($request['skillName'],$request['skillProgress']);
        if(!isset($request['networkIcon'])||!isset($request['networkUrl'])){
            $request['networkIcon']=[];
            $request['networkUrl']=[]; 
        }
        $this->updateSocialMedia($request['networkIcon'],$request['networkUrl']);
        $this->save();

    }

    private function updateSkills($names,$progress){
         
        $skills=$this->skills;
        foreach($skills as $skill){
            $skill->delete();
        }
        for($i=0;$i<count($names);$i++){
            $this->skills()->save(new Skill([
               'name'=>$names[$i],
               'progress'=>$progress[$i],
                ]));
        }
    }

    private function updateSocialMedia($icons,$urls){
         
        $socialMediaLinks=$this->socialMediaLinks;
        foreach($socialMediaLinks as $socialMediaLink){
            $socialMediaLink->delete();
        }
        for($i=0;$i<count($icons);$i++){
            $this->socialMediaLinks()->save(new SocialMedia([
               'icon'=>$icons[$i],
               'url'=>$urls[$i],
                ]));
        }
    }

    public function socialMediaLinks(){
        return $this->hasMany(SocialMedia::class);
    }
}
