<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use App\Question;
use App\Category;


class QuestionsController extends Controller
{
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
     * Show Questions by Category.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showQuestionsByCategory($categoryId)
    {
        $category = Category::with([
            'questions'=>function($query){$query->orderByRaw('RAND()');},
            'questions.options'=>function($query){$query->orderByRaw('RAND()');}
        ]
        )->findOrFail($categoryId);

        return view('frontend.showTestsByCategory',['test'=>$category, 'number'=>1]);

    }

    /**
     * List all Categories/Tests
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function listTests()
    {
        $categories = Category::with([
            'questions'=>function($query){$query->orderByRaw('RAND()');},
            'questions.options'=>function($query){$query->orderByRaw('RAND()');}
        ]
        )->get();
        

        return view('frontend.listTests',['tests'=>$categories, 'number'=>1]);

    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
