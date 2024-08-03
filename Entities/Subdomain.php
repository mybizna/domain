<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Schema\Blueprint;
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

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id' )->html('textarea');
        $this->fields->string('subdomain')->html('text');
        $this->fields->string('description')->nullable()->html('textarea');

    }





}
