<?php

namespace Modules\Domain\Models;

use Modules\Base\Models\BaseModel;
use Modules\Domain\Models\Registrar;

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

    /**
     * Add relationship to Registrar
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function registrar()
    {
        return $this->belongsTo(Registrar::class);
    }

}
