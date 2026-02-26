<?php

namespace App\Transformers\Api\V1\Item;

use League\Fractal\TransformerAbstract;

class GetItemListTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform($result)
    {
        return [
            'id' => $result['id'],
            'name' => $result['name'],
            'description' => $result['description'],
            'price' => $result['price'],
            'is_available' => $result['is_available']
        ];
    }
}
