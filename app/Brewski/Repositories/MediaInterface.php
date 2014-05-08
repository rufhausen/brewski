<?php namespace Brewski\Repositories;


interface MediaInterface {

    public function find($id);

    public function create();

    public function update($input);

    public function destroy($id);
}
