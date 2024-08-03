<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Subdomaindomain extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = [ 'id', 'description', 'domain_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "domain_subdomaindomain";

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id' )->html('hidden');
        $this->fields->string('description')->nullable()->html('textarea');
        $this->fields->bigInteger('domain_id')->nullable()->html('recordpicker')->relation(['domain', 'domain']);

    }
 


}
