<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Technique;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;

class ProjectController extends Controller
{
    public function showProject($id){
        
      
         Validator::make(['id'=>$id],[
            'id' => 'exists:projects,id',
            
        ])->validate();
        
        $project=Project::find($id);
      
        return view('admin.projects.project',compact([
            'project',
        ]));
    }

    public function addProject(){
        $techniques=Technique::all();
        return view('admin.projects.addProject',compact([
            'techniques',
        ]));
    }
    public function saveProject(Request $request){
      
        Validator::make($request->all(),[
            'title'=> 'required|string|max:255',
            'description'=> 'nullable| string|max:255',
            'techniques'=> 'array|nullable   ',
            'techniques.*'=> 'exists:techniques,id',
            'download'=>'nullable|url',
            'demo'=>'nullable|url',
            'images'=>'required|array|min:1',
            'images.*'=>'mimes:jpeg,png,jpg|max:2050'
        ])->validate();
          
        $project=new Project();
        $project->title=$request->title;
        $project->description=$request->description;
        $project->demoLink=$request->demo;
        $project->downloadLink=$request->download;
        $project->user()->associate(Auth::user()->id);
        $project->save();
        foreach($request->file('images') as $image){
            if ($image->isValid()) {
             
                $project->images()->save(new Image([
                    'url'=>$image->store('images', 'public' ),
                ]));
            }   
        }
        
        $project->techniques()->sync($request->techniques);
        
        return redirect()->route('dashboard', ['#portfolio']) ;


    }
    public function editProject($id){
       
        Validator::make(['id'=>$id],[
            'id' => 'exists:projects,id',
        ])->validate();
        $project=Project::find($id);
        $techniques=Technique::all();
        return view('admin.projects.editProject',compact([
            'techniques',
            'project',
        ]));
        
    }
    public function updateProject(Request $request){
        Validator::make($request->all(),[
            'id' => 'exists:projects,id',
            'title'=> 'required|string|max:255',
            'description'=> 'nullable| string|max:255',
            'techniques'=> 'array|nullable   ',
            'techniques.*'=> 'exists:techniques,id',
            'download'=>'nullable|url',
            'demo'=>'nullable|url',
            'images'=>'nullable|array',
            'images.*'=>'mimes:jpeg,png,jpg|max:2050'
        ])->validate();
        $project=Project::find($request->id);
        $project->title=$request->title;
        $project->description=$request->description;
        $project->demoLink=$request->demo;
        $project->downloadLink=$request->download;
        if(!empty($request->images)){
            
            foreach($request->file('images') as $image){
                if ($image->isValid()) {
                 
                    $project->images()->save(new Image([
                        'url'=>$image->store('images', 'public' ),
                    ]));
                }   
            }
        }
        $project->save();
        $project->techniques()->sync($request->techniques);
        
        return redirect()->back() ;
    }

    public function deleteProjectImage(Request $request,$projectId){
        Validator::make($request->all(),[
            'id' => 'exists:images,id',
        ])->validate();
        $image=Image::find($request->id);
        if($image->project->id==$projectId){
            Storage::disk("public")->delete($image->url);  
            $image->delete();
        }
        return redirect()->back() ;
    }



    public function deleteProject(Request $request){
        Validator::make($request->all(),[
            'id' => 'exists:projects,id',
        ])->validate();
        // lazem tzid tchof idha hadh l user howa mol project hadhi --ki tkon bzaf l users  (project exist && project->belongeto(thisUser))
        $project=Project::find($request->id);
        foreach($project->images as $image){
            Storage::disk("public")->delete($image->url);  
            $image->delete();
        }
        $project->techniques()->sync([]);
        $project->delete();
        return redirect()->route('dashboard', ['#portfolio']);
    }
}

