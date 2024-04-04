<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Price extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = [ 'id', 'title', 'price', 'tld', 'ordering', 'published', 'registrar_id'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['title'];

    /**
     * List of tables names that are need in this model during migration.
     *
     * @var array<string>
     */
    public array $migrationDependancy = [];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "domain_price";

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
        $this->fields->string('title')->html('text');
        $this->fields->decimal('price', 11)->html('amount');
        $this->fields->string('tld')->html('text');
        $this->fields->integer('ordering')->nullable()->html('number');
        $this->fields->boolean('published')->nullable()->html('switch')->default(false);
        $this->fields->bigInteger('registrar_id')->nullable()->html('recordpicker')->relation(['domain', 'registrar']);

    }
    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['title', 'price', 'tld', 'ordering', 'published', 'registrar_id'];
        $structure['form'] = [
            ['label' => 'Domain Price', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['title', 'price', 'tld', 'ordering', 'published', 'registrar_id']],
        ];
        $structure['filter'] = ['title', 'price', 'tld', 'ordering', 'published', 'registrar_id'];
        return $structure;
    }

}
