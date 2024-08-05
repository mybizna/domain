<?php

namespace Modules\Domain\Entities;

use Modules\Base\Entities\BaseModel;

class Price extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'title', 'price', 'tld', 'ordering', 'published', 'registrar_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "domain_price";

}
