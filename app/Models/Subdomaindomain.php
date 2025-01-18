<?php

namespace Modules\Domain\Models;

use Modules\Base\Models\BaseModel;
use Modules\Domain\Models\Domain;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->string('subdomain');
        $table->text('description')->nullable();

    }
}
