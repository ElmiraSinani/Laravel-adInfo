<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;

use App\Question;
use App\Category;

class AdminQuestionsController extends Controller
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
    public function index(){
        $questions = Question::paginate(10);
        return view('admin.questions',['questions'=>$questions]);
    }

    /**
     * Display add question.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){     
        $categories = Category::all();

        return view('admin.createQuestion')->with(['categories'=>$categories]);
    }

    /**
     * Display insert question.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request){   
         // Form validation
         $request->validate([
            'question' =>  'required',
            'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $question = new Question;
        $question->question = $request->input('question');
        $question->description = $request->input('description');
        
        // Check if an image has been uploaded
        if ($request->has('image')) {
            // Get image file
            $image = $request->file('image');
            // Make a image name based on question and current timestamp
            $name = str_slug($request->input('question')).'_'.time();
            // Define folder path
            $folder = '/uploads/questions/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $question->image = $filePath;
        }
        
        if($question->save()) {
            $question->categories()->sync($request->get('categories'));
            return redirect()->route('adminEditQuestion',['id' =>$question->id ])->with(['status' => 'Question Created successfully.']);
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $question = Question::find($id);
        $categories = Category::all();
       
        $selectedCatIds = [];
        foreach($question->categories as $cat){      
            $selectedCatIds[] = $cat->id;
        }
        
        return view('admin.editQuestion')->with(['question'=>$question, 'selectedCatIds'=> $selectedCatIds,'categories'=>$categories]);
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
            'question' =>  'required',
            'image'  =>  'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $question = Question::find($id);
        $question->question = $request->input('question');
        $question->description = $request->input('description');
        
        // Check if an image has been uploaded
        if ($request->has('image')) {
            //delete old image before upload new one
            $isImageExists = Storage::disk('local')->exists("public".$question->image);          
            if($isImageExists){            
                Storage::delete('public'.$question->image);
            } 
            // Get image file
            $image = $request->file('image');
            // Make a image name based on question and current timestamp
            $name = str_slug($request->input('question')).'_'.time();
            // Define folder path
            $folder = '/uploads/questions/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension();
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $question->image = $filePath;
        }
        
        $question->save();

        $question->categories()->sync($request->get('categories'));

        return redirect()->route('adminEditQuestion',['id' =>$id ])->with(['status' => 'Question updated successfully.']);
    }

   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id){

        $question = Question::find($id);
        
        //delete image from server
        if($question->image){
            $isImageExists = Storage::disk('local')->exists("public".$question->image);
            if($isImageExists){            
                Storage::delete('public'.$question->image);
            } 
        }
 
        //delete record from database
        Question::destroy($id);
        
        return redirect()->route('adminDisplayQuestions')->with(['status' => 'Question Deleted.']);
    }
}
