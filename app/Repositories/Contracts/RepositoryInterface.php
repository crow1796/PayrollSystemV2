<?php

namespace App\Repositories\Contracts;

interface RepositoryInterface {
    public function all($columns = array('*'));
    public function count();
    public function create($data = array());
    public function updateBySlug($data = array(), $slug);
    public function updateById($data = array(), $id);
    public function updateByModel($data = array(), $model);
    public function deleteBySlug($slug);
    public function deleteById($id);
    public function deleteByModel($model);
    public function paginate($itemsPerPage = 15, $columns = array('*'));
    public function findBySlug($slug);
    public function findById($id);
    public function orderByAsc($col);
    public function orderByDesc($col);
    public function limit($limit = 0);
    public function where($compareFrom, $operator = '=', $compareTo);
    public function whereThenLimit($compareFrom, $operator = '=', $compareTo, $limit, $offset = 0);
    public function whereThenOrderByAsc($compareFrom, $operator = '=', $compareTo, $orderBy);
    public function whereThenOrderByDesc($compareFrom, $operator = '=', $compareTo, $orderBy);
    public function matchLeft($columnsToMatch, $limit = 0, $columnsToGet = array('*'));
    public function matchRight($columnsToMatch, $limit = 0, $columnsToGet = array('*'));
    public function matchBoth($columnsToMatch, $limit = 0, $columnsToGet = array('*'));
}
