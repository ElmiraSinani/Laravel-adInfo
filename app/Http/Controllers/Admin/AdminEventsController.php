<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;

use App\Event;

class AdminEventsController extends Controller
{

    use UploadTrait;

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $events = Event::paginate(10);       

        return view('admin.events', ['events'=>$events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){        
        return view('admin.createEvent');
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('admin.editEvent',['event'=>$event]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request){
        // Form validation
        $request->validate([
            'name' =>  'required',
            'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $event = new Event;        
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->start_time = $request->input('start_time');
        $event->end_time = $request->input('end_time');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->phone = $request->input('phone');
        $event->address = $request->input('address');
        $event->city = $request->input('city');
        $event->state = $request->input('state');
        $event->zip = $request->input('zip');       
        $event->views = 0;
        $event->status = 0;
        $event->type = 0;
        
        // Check if an image has been uploaded
        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on question and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/events/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $event->image = $filePath;
        }
        
        $event->save();
            
        return redirect()->route('adminEditEvent',['id' =>$event->id ])->with(['status' => 'Event Created successfully.']);
    }   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        // Form validation
        $request->validate([
            'name' =>  'required',
            'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $event = Event::find($id);        
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->start_time = $request->input('start_time');
        $event->end_time = $request->input('end_time');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->phone = $request->input('phone');
        $event->address = $request->input('address');
        $event->city = $request->input('city');
        $event->state = $request->input('state');
        $event->zip = $request->input('zip');  
         
        // Check if an image has been uploaded
        if ($request->has('image')) {
            //delete old image before upload new one
            $isImageExists = Storage::disk('local')->exists("public".$event->image);          
            if($isImageExists){            
                Storage::delete('public'.$event->image);
            } 
            // Get image file
            $image = $request->file('image');
            // Make a image name based on question and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/events/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $event->image = $filePath;
        }
        
        $event->save();
            
        return redirect()->route('adminEditEvent',['id' =>$event->id ])->with(['status' => 'Event Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){

        $event = Event::find($id);
        
        //delete image from server
        if($event->image){
            $isImageExists = Storage::disk('local')->exists("public".$event->image);
            if($isImageExists){            
                Storage::delete('public'.$event->image);
            } 
        }
 
        //delete record from database
        Event::destroy($id);
        
        return redirect()->route('adminDisplayEvents')->with(['status' => 'Event Deleted.']);
    }
}
