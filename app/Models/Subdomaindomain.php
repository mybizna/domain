<?php

namespace Modules\Domain\Models;

use Modules\Base\Models\BaseModel;

class Subdomaindomain extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'description', 'domain_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "domain_subdomaindomain";
}
