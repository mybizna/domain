<?php
namespace Modules\Domain\Models;

use Base\Casts\Money;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Models\BaseModel;
use Modules\Domain\Models\Registrar;

class Price extends BaseModel
{

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'total' => Money::class, // Use the custom MoneyCast
    ];
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
    public function registrar(): BelongsTo
    {
        return $this->belongsTo(Registrar::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->string('title');
        $table->integer('price');
        $table->string('currency')->default('USD');
        $table->string('tld');
        $table->integer('ordering')->nullable();
        $table->boolean('published')->nullable()->default(false);
        $table->unsignedBigInteger('registrar_id')->nullable();
    }

    public function post_migration(Blueprint $table): void
    {
        $table->foreign('registrar_id')->references('id')->on('domain_registrar')->onDelete('set null');
    }
}
