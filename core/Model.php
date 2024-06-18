<?php

namespace Core;

use Core\Traits\Queryable;

abstract class Model
{
    use Queryable;
    public int $id;

    public function toArray(): array
    {
        $data = [];

        $vars = get_object_vars($this); // only public props 'll be returned
        foreach ($vars as $key => $value) {
            if (in_array($key, ['commands', 'tableName'])){
                continue;
            }
            $data[$key] = $value;
        }
        return $data;
    }

}