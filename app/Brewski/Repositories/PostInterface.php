<?php
namespace Brewski\Repositories;

interface PostInterface {

    public function find($id);

    public function findBySlug($slug);

    public function search($q);

    public function paginate($num, $status = 'published', $column = 'created_at', $order = 'DESC');

    public function create();

    public function update($id);

    public function destroy($id);

    public function getRecentlyPublished();

    public function getByCategorySlug($slug, $per_page = null);
}
