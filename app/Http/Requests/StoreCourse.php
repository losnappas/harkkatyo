<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
// use Illuminate\Foundation\Http\FormRequest;

class StoreCourse extends /*FormRequest*/ Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = '';
        if (isset($this->user)) {
            $user = \App\User::findOrFail($this->user)->id;
        }
        
        return [
            'title' => 'sometimes|required|min:3',
            'body' => 'sometimes|required',
            'answer' => 'sometimes|required',
            'name' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|max:255|unique:users,email,'.$user,
            'password' => 'sometimes|required|min:6|confirmed',
            'teacher' => 'sometimes|required'
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
        //unless model is Posts ofc.. form: {MODEL}Controller
        $class = $this->get_calling_class();

        $newThing = new $class([
                'body' => $this->body,
                'title' => $this->title,
                'answer' => $this->answer, //it's empty if the calling thing is Course so nbd
            ]);
        
        if (isset($this->teacher_id)) {
            $newThing->teacher()->associate(\App\User::find($this->teacher_id));
        }
        $newThing->save();  

        if(isset($this->tasks)){
            $newThing->tasks()->attach($this->tasks);
        }
    }

    //saves edits to courses/tasks
    public function savechanges($id)
    {
        $class = $this->get_calling_class();
        $thing = $class::findOrFail($id);

        //if you pick no tasks it doesn't change the course's tasks
        //bug or feature-to-be? heh

        if (isset($this->tasks) && $this->tasks != $id) {
            $thing->tasks()->sync($this->tasks);
        }

        //user roles changed?
        if (isset($this->roles)) {
            $thing->roles()->sync($this->roles);
        }

        $thing->fill($this->request->all())->save();
    }
}
