<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;

use App\QuestionOption;

class AdminQuestionOptionsController extends Controller {

    use UploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request, $questionId) {
         // Form validation
         $request->validate([
            'option' =>  'required'
        ]);

        $questionOption = new QuestionOption;
        $questionOption->question_id = $questionId;
        $questionOption->option = $request->input('option');
        $questionOption->correct = $request->input('correct');

         // Check if an image has been uploaded
         if ($request->has('optionImage')) {
            // Get image file
            $image = $request->file('optionImage');            
            // Make a image name based on question and current timestamp
            $name = str_slug($request->input('option')).'_'.time(); 
            // Define folder path
            $folder = '/uploads/options/';
            // Make a file path where image will be stored [ folder path + file name + file extension]
            $filePath = $folder . $name. '.' . $image->getClientOriginalExtension(); 
            // Upload image
            $this->uploadOne($image, $folder, 'public', $name);
            // Set user profile image path in database to filePath
            $questionOption->image = $filePath;
        }

        $questionOption->save();

        return redirect()->route('adminEditQuestion',['id' =>$questionId ])->with(['status' => 'Question Option updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($questionId, $optionId){

        $option = QuestionOption::find($optionId);
        
        //delete image from server
        if($option->image){
            $isImageExists = Storage::disk('local')->exists("public".$option->image);
            if($isImageExists){            
                Storage::delete('public'.$option->image);
            } 
        }
 
        //delete record from database
        QuestionOption::destroy($optionId);
        
        return redirect()->route('adminEditQuestion',['id' =>$questionId ])->with(['status' => 'Question Option updated successfully.']);
    }

}
