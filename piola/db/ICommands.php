<?php

namespace piola\db;

interface ICommands
{
    public function Select(AModel $model = null);
    public function Insert(array $model);
    public function Update(array $model);
    public function Delete(array $model);
}