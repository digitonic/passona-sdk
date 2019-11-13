<?php

namespace Digitonic\PassonaClient\Requests;

use Illuminate\Support\Collection;

abstract class CollectionRequest extends BaseRequest
{
    /**
     * @return Collection
     */
    public function send(): Collection
    {
       return parent::send();
    }
}
