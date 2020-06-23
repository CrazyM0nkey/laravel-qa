<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostAnswerRequst;

class AnswersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, PostAnswerRequst $request)
    {  
        
        $question->answers()->create([
            'user_id' => Auth::id(),
            'body' => \htmlspecialchars($request->body)
            ]);
        return \back()->with('success', 'Your answer has been submitted successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {   
        $question->title = \htmlspecialchars_decode($question->title);
        $answer->body = \htmlspecialchars_decode($answer->body);
        $this->authorize('update', $answer);
        return view('answers.edit', compact('question', 'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(PostAnswerRequst $request, Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        $answer->update([
            'body' => htmlspecialchars($request->body)
        ]);

        return redirect()->route('questions.show', $question->slug)->with('success', 'Your answer has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $this->authorize('delete', $answer);
        $answer->delete();
        return back()->with('success', 'Your answer has been removed.');
    }
}
