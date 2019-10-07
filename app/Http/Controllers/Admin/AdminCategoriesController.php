<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;

use App\Category;

class AdminCategoriesController extends Controller{

    use UploadTrait;

    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $categories = Category::paginate(10);

        return view('admin.categories',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){     
        
        return view('admin.createCategory');
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

        $category = new Category;
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        
        // Check if an image has been uploaded
        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on question and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/categories/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $category->image = $filePath;
        }
        
        $category->save();
            
        return redirect()->route('adminDisplayCategories',['id' =>$category->id ])->with(['status' => 'Question Created successfully.']);
        
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){

        $category = Category::find($id);

        return view('admin.editCategory',['category'=>$category]);
    }

    /**
     * Update category
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

        $category = Category::find($id);
        $category->name = $request->input('name');
        $category->slug = $request->input('slug');
        $category->description = $request->input('description');
        
        // Check if an image has been uploaded
        if ($request->has('image')) {
            //delete old image before upload new one
            $isImageExists = Storage::disk('local')->exists("public".$category->image);          
            if($isImageExists){            
                Storage::delete('public'.$category->image);
            } 
            // Get image file
            $image = $request->file('image');
            // Make a image name based on question and current timestamp
            $name = str_slug($request->input('name')).'_'.time();
            // Define folder path
            $folder = '/uploads/categories/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $category->image = $filePath;
        }
        
        $category->save();
            
        return redirect()->route('adminEditCategory',['id' =>$category->id ])->with(['status' => 'Question Created successfully.']);
        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        return 123;
    }
}
