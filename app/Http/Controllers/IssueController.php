<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Issue;

use Illuminate\Support\Facades\Validator;

class IssueController extends Controller
{
    public function Issue()
    {
        $issue = Issue::all();
        $i =1;
        return view('issues')->with(['issue'=>$issue, 'i'=>$i]);
    }

    public function addIssue(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_name' => ['required', 'string' , 'max:100000'],
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
            'vehicle_name' => $request->vehicle_name,
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
        $validator = Issue::make($request->all(), [
            'vehicle_name' => ['required', 'string' , 'max:100000'],
            'assignee' => ['required', 'string' , 'max:225'],
            'title' => ['required', 'string' , 'max:225'],
            'description' => ['required', 'string' , 'max:225'],
            'priority' => ['required', 'string' , 'max:225'],
            'due_date' => ['required', 'string' , 'max:100000'],

        ]);
        $img ='';
        if ($request->issue_image == null){
            return redirect()->back()
            ->withErrors("File upload required")
            ->withInput();
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
            'vehicle_name' => $request->vehicle_name,
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
