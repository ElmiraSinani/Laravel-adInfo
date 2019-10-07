<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;

use App\Service;

class AdminServicesController extends Controller {
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
        $services = Service::paginate(10);       

        return view('admin.services', ['services'=>$services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){        
        return view('admin.createService');
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.editService',['service'=>$service]);
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

        $service = new Service;        
        $service->name = $request->input('name');        
        $service->phone = $request->input('phone');
        $service->email = $request->input('email');
        $service->address = $request->input('address');
        $service->description = $request->input('description');
        
        // Check if an image has been uploaded
        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on question and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/services/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $service->image = $filePath;
        }
        
        $service->save();
            
        return redirect()->route('adminEditService',['id' =>$service->id ])->with(['status' => 'Service Created successfully.']);
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

        $service = Service::find($id);        
        $service->name = $request->input('name');        
        $service->phone = $request->input('phone');
        $service->email = $request->input('email');
        $service->address = $request->input('address');
        $service->description = $request->input('description');
         
        // Check if an image has been uploaded
        if ($request->has('image')) {
            //delete old image before upload new one
            $isImageExists = Storage::disk('local')->exists("public".$service->image);          
            if($isImageExists){            
                Storage::delete('public'.$service->image);
            } 
            // Get image file
            $image = $request->file('image');
            // Make a image name based on question and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/services/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $service->image = $filePath;
        }
        
        $service->save();
            
        return redirect()->route('adminEditService',['id' =>$service->id ])->with(['status' => 'Service Updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){

        $service = Service::find($id);
        
        //delete image from server
        if($service->image){
            $isImageExists = Storage::disk('local')->exists("public".$service->image);
            if($isImageExists){            
                Storage::delete('public'.$service->image);
            } 
        }
 
        //delete record from database
        Service::destroy($id);
        
        return redirect()->route('adminDisplayServices')->with(['status' => 'Service Deleted.']);
    }
}