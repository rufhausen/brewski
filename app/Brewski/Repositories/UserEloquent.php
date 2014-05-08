<?php  namespace Brewski\Repositories;

class UserEloquent implements UserInterface {

    public function find($id)
    {
        return User::find($id);
    }

    public function store($input)
    {

    }

    public function update($input)
    {

    }

    public function destroy($id)
    {

    }
}
