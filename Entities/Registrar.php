<?php

namespace Modules\Domain\Entities;

use Modules\Base\Entities\BaseModel;

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

}
