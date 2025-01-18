<?php

namespace Modules\Domain\Models;

use Modules\Base\Models\BaseModel;
use Illuminate\Database\Schema\Blueprint;

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


    public function migration(Blueprint $table): void
    {

        $table->string('subdomain');
        $table->text('description')->nullable();

    }
}
