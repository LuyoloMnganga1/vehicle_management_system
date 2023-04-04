<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Issue;
use App\Models\Vehicle;
use App\Models\User;
use DataTables;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class IssueController extends Controller
{
    public function Issue()
    {
        
        return view('issues');
    }
    public function getIssues(Request $request){
        if($request->ajax()){
            $data = Issue::orderBy('created_at', 'DESC')->get();
            return DataTables::of($data)
                //**********INDEX COLUMN ************/
                ->addIndexColumn()
                //**********END OF INDEX COLUMN ************/
                //**********PLATE COLUMN ************/
                ->addColumn('vehicle_plate', function($row){
                    $vehicle_plate = Vehicle::where('id', $row->vehicle_id)->value('Registration_no');
                    return $vehicle_plate;
                    })
                    //**********END OF PLATE COLUMN ************/
                    //**********ASSIGNEE COLUMN ************/
                ->addColumn('assignee', function($row){
                    $user = User::where('id',$row->assignee)->first();
                    $assignee = $user->name . " ". $user->surname;
                    return $assignee;
                    })
                    //**********END OF ASSIGNEE COLUMN ************/
                    //**********TITLE COLUMN ************/
                ->addColumn('title', function($row){
                    $title = $row->title;
                    return $title;
                    })
                    //**********END OF TITLE COLUMN ************/
                //**********IMAGE COLUMN ************/
                ->addColumn('issue_image', function($row){
                $issue_image = '<img src="'.$row->issue_image.'" alt="vehicle image" style="width: 70px;height: 70px;"/>';
                return $issue_image;
                })
                //**********END OF IMAGE COLUMN ************/
                //**********PRIORITY COLUMN ************/
                ->addColumn('priority', function($row){
                        $color ="";
                        if($row->priority == 'low'){
                            $color = 'success';
                        }
                        if($row->priority == 'medium'){
                            $color = 'warning';
                        }
                        if($row->priority == 'high'){
                            $color = 'danger';
                        }
                        
                        $priority = '<span class="text-'.$color.'"> '.ucfirst($row->priority).'</span>';
                    return $priority;
                })
                //**********END OF PRIORITY COLUMN ************/
                 //**********DATE COLUMN ************/
                 ->addColumn('due_date', function($row){
                    $color ="";
                    $date = Carbon::parse($row->due_date);
                    if($date->isPast()){
                        $color = 'danger';
                    }
                    if($date->isFuture()){
                        $color = 'success';
                    }
                    if($date->isToday()){
                        $color ='warning';
                    }
                    
                    $due_date = '<span class="text-'.$color.'"> '.Carbon::parse($row->due_date)->formatLocalized('%d, %B %Y').'</span>';
                    return $due_date;
                    })
                    //**********END OF DATE COLUMN ************/
                //**********ACTION COLUMN ************/
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="view btn btn-info btn-sm" data-id = "'.$row->id.'"><i class="fa fa-eye text-light"></i></a>';
                if(Auth::user()->id == $row->assignee){
                    $actionBtn = $actionBtn.' <a href="javascript:void(0)" class="edit btn btn-warning btn-sm" data-id="'.$row->id.'"><i class="fa fa-pencil text-light"></i></a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm" id="delete" data-id ="'.$row->id.'"><i class="fa fa-trash text-light"></i></a>';
                }
                return $actionBtn;
            })
                //**********END OF ACTION COLUMN ************/
            ->rawColumns(['vehicle_plate','assignee','issue_image','title','priority','due_date','action'])
            ->make(true);
        }
        return view('issues');
    }
    public function findissue($id){
        $issue = Issue::find($id);
        $vehicle_plate = Vehicle::where('id', $issue->vehicle_id)->value('Registration_no');
        $user = User::where('id', $issue->assignee)->first();

        $color ="";
        if($issue->priority == 'low'){
            $color = 'success';
        }
        if($issue->priority == 'medium'){
            $color = 'warning';
        }
        if($issue->priority == 'high'){
            $color = 'danger';
        }
        $priority = '<span class="text-'.$color.'"> '.ucfirst($issue->priority).'</span>';

        $color ="";
                    $date = Carbon::parse($issue->due_date);
                    if($date->isPast()){
                        $color = 'danger';
                    }
                    if($date->isFuture()){
                        $color = 'success';
                    }
                    if($date->isToday()){
                        $color ='warning';
                    }
                    
                    $due_date = '<span class="text-'.$color.'"> '.Carbon::parse($issue->due_date)->formatLocalized('%d, %B %Y').'</span>';

        $data = [
            'vehicle_id' => $issue->vehicle_id,
            'vehicle_plate' => $vehicle_plate,
            'assignee' => $user->name ." ". $user->surname,
            'title' => $issue->title,
            'description' => $issue->description,
            'issue_image' => $issue->issue_image,
            'priority' => $priority,
            'due_date' => $due_date,
            'issue_date_due' => $issue->due_date,
        ];
        return  response()->json($data);
    }
    public function addIssue(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id' => ['required', 'string' , 'max:100000'],
            'assignee' => ['required', 'string' , 'max:225'],
            'title' => ['required', 'string' , 'max:225'],
            'description' => ['required', 'string' , 'max:225'],
            'priority' => ['required', 'string' , 'max:225'],
            'due_date' => ['required', 'string' , 'max:100000'],

        ]);
        $img ='';
        if ($request->issue_image == null){
            return redirect()->back()
            ->withErrors("File upload is required")
            ->withInput();
        }else{
            if($request->hasFile('issue_image')){
                $fileName = auth()->id() . '_' . time() . '.'. $request->issue_image->extension();
                $request->issue_image->move('files/img', $fileName);
                $img = 'files/img/'.$fileName;
            }
        }
        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'vehicle_id' => $request->vehicle_id,
            'assignee' => $request->assignee,
            'title' => $request->title,
            'description' => $request->description,
            'issue_image' => $img,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ];
        Issue::create($data);
        return redirect()->back()->with('success','Issue has been added');
    }

    public function updateIssue(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_id' => ['required', 'string' , 'max:100000'],
            'assignee' => ['required', 'string' , 'max:225'],
            'title' => ['required', 'string' , 'max:225'],
            'description' => ['required', 'string' , 'max:225'],
            'priority' => ['required', 'string' , 'max:225'],
            'due_date' => ['required', 'string' , 'max:100000'],
        ]);
        $img ='';
        if ($request->issue_image == null){
           $img = $request->previous_image;
        }else{
            if($request->hasFile('vehicle_image')){
                $fileName = auth()->id() . '_' . time() . '.'. $request->issue_image->extension();
                $request->issue_image->move('files/img', $fileName);
                $img = 'files/img/'.$fileName;
            }
        }

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        $data = [
            'vehicle_id' => $request->vehicle_id,
            'assignee' => $request->assignee,
            'title' => $request->title,
            'description' => $request->description,
            'issue_image' => $img,
            'priority' => $request->priority,
            'due_date' => $request->due_date,
        ];
        Issue::whereId($id)->update($data);
        return redirect()->back()->with('success','Issue has been updated');
    }

    public function deleteIssue($id)
    {
        Issue::destroy($id);
        return redirect()->back()->with('success','Issue has been deleted');
    }
}
