<?php  namespace Brewski;

use \Validator;

class BrewskiValidator {

    protected $errors;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function validate($input, $rules, $messages)
    {
        $validation = Validator::make($input, $rules, $messages);

        if ($validation->fails())
        {
            $this->errors = $validation->messages();
        }

        return true;

    }

    public function getErrors()
    {
        return $this->errors;
    }

}
