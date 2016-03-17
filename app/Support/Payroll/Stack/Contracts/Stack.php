<?php

namespace App\Support\Payroll\Stack\Contracts;

interface Stack {
	public function add($key, $value);
	public function delete($key, $index);
	public function all();
	public function get($key, $index);
	public function set($key, $index, $value);
	public function count();
}