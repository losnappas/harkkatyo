<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourse extends FormRequest // this is actually misnamed. . .
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // change to Gate::allows or whatever
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:3',
            'body' => 'required',
            //add 'answer' => 'sometimes' later
        ];
    }

    function get_calling_class() {

        //get the trace
        $trace = debug_backtrace();

        // Get the class that is asking for who awoke it
        $class = $trace[1]['class'];

        // +1 to i cos we have to account for calling this function
        for ( $i=1; $i<count( $trace ); $i++ ) {
            if ( isset( $trace[$i] ) ) // is it set?
                 if ( $class != $trace[$i]['class'] ) // is it a different class
                     break;//return $trace[$i]['class'];
        }
        $class = $trace[$i]['class'];

        //strip so it's \App\Class
        $class = '\\'.preg_replace('/^|Controller$/', '', $class);
        $class = str_replace('\\Http\\Controllers', '', $class);

        return $class;
    }

    //stores new courses and tasks
    public function persist()
    {
        //calls 'create' based on which class called
        //so don't use plurals in controller names (postscontroller => postcontroller)
        $class = $this->get_calling_class();

        $course = $class::create([
                'body' => $this->body,
                'title' => $this->title,
                'answer' => $this->answer, //it's empty if the calling thing is Course so nbd
            ]);

        if(isset($this->tasks)){
            $course->tasks()->attach($this->tasks);
        }
    }

    //saves edits to courses/tasks
    public function savechanges($id)
    {
        $class = $this->get_calling_class();
        $thing = $class::findOrFail($id);

        //if you pick no tasks it doesn't change the course's tasks
        //bug or feature-to-be? heh
        if (isset($this->tasks)) {
            $thing->tasks()->sync($this->tasks);
        }

        $thing->fill($this->request->all())->save();
    }

}
