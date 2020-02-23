<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    private $table = 'user';
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
        $id          = $this->id; 
        $task        = $this->task; 
        
        $conUsername ="";
        $conEmail    ="";
        $conAvatar   ="";
        $conPass     ="";
        $conLevel    ="";
        $conStatus   ="";
        $conFullname ="";
        switch ($task) {
            case 'add':
            $conUsername ="bail|required|between:5,100|unique:$this->table,username";
            $conEmail    ="bail|required|email|unique:$this->table,email";
            $conAvatar   ="bail|required|image|max:500";
            $conPass     ="required|between:5,100";
            $conLevel    ="bail|in:admin,member";
            $conStatus   ="bail|in:active,inactive";
            $conFullname ="bail|required|between:5,100";
            break;
            
            case 'edit-info':
            $conUsername ="bail|required|between:5,100|unique:$this->table,username,$id";
            $conEmail    ="bail|required|email|unique:$this->table,email,$id";
            $conStatus   ="bail|in:active,inactive";
            $conFullname ="bail|required|between:5,100";
            break;
            case 'change-password': 
            $conPass     ="required|between:5,100";
            break;
            case 'change-level': 
            $conLevel    ="bail|in:admin,member";

            break;
        }

        return [
         'username'              => $conUsername,
         'email'                 => $conEmail,
         'avatar'                => $conAvatar,
         'password'              => $conPass,
         'status'                => $conStatus,
     ];
 }

 public function messages()
 {
    return [
        // 'name.required' => 'Name không được rỗng !',
        // 'name.min' => 'Name :input có chiều dài ít nhất :min kí tự !',
        // 'body.required'  => 'A message is required',
    ];
}

public function attributes()
{
    return [
        // 'description' => 'Field description: ',
    ];
}
}
