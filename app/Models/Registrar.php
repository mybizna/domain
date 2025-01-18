<?php

namespace Modules\Domain\Models;

use Modules\Base\Models\BaseModel;
use Illuminate\Database\Schema\Blueprint;

class Registrar extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'title', 'name', 'description', 'params', 'test', 'file_path', 'published'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "domain_registrar";


    public function migration(Blueprint $table): void
    {
        $table->id();

        $table->string('title');
        $table->string('name');
        $table->longText('description');
        $table->longText('params')->nullable();
        $table->integer('test')->nullable();
        $table->string('file_path')->nullable();
        $table->boolean('published')->nullable()->default(false);
    }
}
