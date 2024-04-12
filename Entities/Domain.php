<?php

namespace Modules\Domain\Entities;

use Illuminate\Database\Schema\Blueprint;
use Modules\Base\Entities\BaseModel;

class Domain extends BaseModel
{

    /**
     * The fields that can be filled
     *
     * @var array<string>
     */
    protected $fillable = ['id', 'name', 'amount', 'first_name', 'last_name', 'email', 'phone', 'address', 'post_code', 'city', 'expiry_date', 'upgrade_date', 'last_upgrade_date', 'paid', 'completed', 'successful', 'status', 'is_new', 'whois_synced', 'payment_id', 'partner_id', 'country_id', 'price_id'];

    /**
     * The fields that are to be render when performing relationship queries.
     *
     * @var array<string>
     */
    public $rec_names = ['name'];

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
    protected $table = "domain_domain";

    /**
     * List of fields to be migrated to the datebase when creating or updating model during migration.
     *
     * @param Blueprint $table
     * @return void
     */
    public function fields(Blueprint $table = null): void
    {
        $this->fields = $table ?? new Blueprint($this->table);

        $this->fields->increments('id')->html('hidden');
        $this->fields->string('name')->html('text');
        $this->fields->decimal('amount', 11)->nullable()->html('amount');
        $this->fields->string('first_name')->html('text');
        $this->fields->string('last_name')->html('text');
        $this->fields->string('email')->html('email');
        $this->fields->string('phone')->html('text');
        $this->fields->string('address')->html('text');
        $this->fields->string('post_code')->html('text');
        $this->fields->string('city')->html('text');
        $this->fields->dateTime('expiry_date', 6)->nullable()->html('datetime');
        $this->fields->dateTime('upgrade_date', 6)->nullable()->html('datetime');
        $this->fields->dateTime('last_upgrade_date', 6)->nullable()->html('datetime');
        $this->fields->boolean('paid')->nullable()->html('switch')->default(false);
        $this->fields->boolean('completed')->nullable()->html('switch')->default(false);
        $this->fields->boolean('successful')->nullable()->html('switch')->default(false);
        $this->fields->boolean('status')->nullable()->html('switch')->default(false);
        $this->fields->boolean('is_new')->nullable()->html('switch')->default(false);
        $this->fields->boolean('whois_synced')->nullable()->html('switch');
        $this->fields->bigInteger('payment_id')->nullable()->html('recordpicker')->relation(['domain', 'invoice']);
        $this->fields->integer('partner_id')->nullable()->html('recordpicker')->relation(['partner']);
        $this->fields->bigInteger('country_id')->nullable()->html('recordpicker')->relation(['core', 'country']);
        $this->fields->bigInteger('price_id')->nullable()->html('recordpicker')->relation(['domain', 'price']);

    }
    /**
     * List of structure for this model.
     */
    public function structure($structure): array
    {
        $structure['table'] = ['name', 'amount', 'first_name', 'last_name', 'paid', 'completed', 'successful', 'status', 'payment_id', 'partner_id'];
        $structure['form'] = [
            ['label' => 'Domain Detail', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['name', 'amount', 'payment_id', 'partner_id', 'country_id', 'price_id']],
            ['label' => 'Domain Contact', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['first_name', 'last_name', 'email', 'phone', 'address', 'post_code', 'city']],
            ['label' => 'Domain Dates', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['expiry_date', 'upgrade_date', 'last_upgrade_date']],
            ['label' => 'Domain Status', 'class' => 'col-span-full md:col-span-6 md:pr-2', 'fields' => ['paid', 'completed', 'successful', 'status', 'is_new', 'whois_synced']],
        ];
        $structure['filter'] = ['name', 'amount', 'paid', 'completed', 'successful', 'status', 'payment_id', 'partner_id', 'country_id', 'price_id'];
        return $structure;
    }


    /**
     * Define rights for this model.
     *
     * @return array
     */
    public function rights(): array
    {

    }

}
