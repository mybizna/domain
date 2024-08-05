<?php

namespace Modules\Domain\Entities;

use Modules\Base\Entities\BaseModel;

class Subdomain extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'subdomain', 'description'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "domain_subdomain";

}
