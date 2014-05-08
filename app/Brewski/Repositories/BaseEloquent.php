<?php  namespace Brewski\Repositories;

use \Brewski\BrewskiValidator;

class BaseEloquent {

    protected $errors;

    public function __construct(BrewskiValidator $validator)
    {
        $this->validator = $validator;
    }

    public function getErrors()
    {
        return $this->errors;
    }

}
