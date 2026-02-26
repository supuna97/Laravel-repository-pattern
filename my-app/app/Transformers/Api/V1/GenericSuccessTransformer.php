<?php

namespace App\Transformers\Api\V1;

use League\Fractal\TransformerAbstract;

class GenericSuccessTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @param string $message
     * @return array
     */
    public function transform(string $message)
    {
        return [
            'message' => $message,
        ];
    }
}
