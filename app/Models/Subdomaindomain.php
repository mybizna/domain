<?php

namespace Modules\Domain\Models;

use Modules\Base\Models\BaseModel;
use Modules\Domain\Models\Domain;

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
    protected $table = "domain_subdomain_domain";

    /**
     * Add relationship to Domain
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
}
