<?php

namespace App\Models;

use App\Contracts\ImportDtoRowInterface;

class BaseModel
{
    public static function fromDto(ImportDtoRowInterface $dto): static
    {
        $model = new static();

        foreach (get_object_vars($dto) as $prop => $value) {
            if (property_exists($model, $prop)) {
                $model->$prop = $value;
                continue;
            }

            $setter = 'set' . ucfirst($prop);
            if (method_exists($model, $setter)) {
                $model->$setter($value);
            }
        }

        return $model;
    }
}