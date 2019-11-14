<?php

namespace Digitonic\PassonaClient\Requests;

abstract class EntityRequest extends BaseRequest
{
    /**
     * @return \stdClass
     */
    public function send(): \stdClass
    {
        return parent::send()->first();
    }
}
