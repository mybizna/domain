<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Registrar extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'title', 'name', 'description', 'params', 'test', 'file_path', 'published', ];

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
    protected $table = "domain_registrar";

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
        $this->fields->string('name')->html('text');
        $this->fields->longText('description')->html('textarea');
        $this->fields->longText('params')->nullable()->html('textarea');
        $this->fields->integer('test')->nullable()->html('text');
        $this->fields->string('file_path')->nullable()->html('text');
        $this->fields->boolean('published')->nullable()->html('switch')->default(false);

    }
    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['title', 'name', 'published'];
        $structure['form'] = [
            ['label' => 'Registrar Detail', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['title', 'name', 'test', 'file_path', 'published']],
            ['label' => 'Registrar Setting', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['description', 'params']],
        ];
        $structure['filter'] = ['title', 'name', 'published'];
        return $structure;
    }

}
