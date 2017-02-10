<?php

class Base extends \Illuminate\Database\Eloquent\Model
{
    protected $rules = array();

    protected $errors;

    public function validate($data, $method = 'create')
    {
       
        // make a new validator object 
        $validation = new GUMP();
        $v = $validation->validate($data, $this->rules[$method]);

        // check for pass
        if ($v === true)
        {
            // validation pass
            return true;      
        }

        // failure
        else {
            // set errors and return false
            $this->errors = $validation->get_errors_array();
            return false;
        }

    }

    public function errors()
    {
        return $this->errors;
    }
}