<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Project;
class ProjectController extends Controller
{
    public function showProject($id){
        Validator::make(['id'=>$id],[
            'id' => 'exists:projects,id',
            
        ])->validate();
        
        $project=Project::find($id);
      
        return view('project',compact([
            'project',
        ]));
    }
}
