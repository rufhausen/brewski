<?php
namespace Brewski\Repositories;

interface PageInterface {

    public function find($id);

    public function findBySlug($slug);

    public function create();

    public function update($id);

    public function destroy($id);
}
