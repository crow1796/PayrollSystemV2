<?php

namespace App\Support\Registrars\Contracts;

interface Registrar {
	public function createFromModel($model, $data);
	public function updateFromModel($model, $data);
	public function setModel($model);
	public function setData($data);
	public function setModelAndData($model, $data);
}