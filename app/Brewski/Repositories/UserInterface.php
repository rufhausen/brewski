<?php  namespace Brewski\Repositories;

interface UserInterface {

    public function find($id);
    public function store($input);
    public function update($input);
    public function destroy($id);
}
