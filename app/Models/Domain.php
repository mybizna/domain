<?php
namespace Modules\Domain\Models;

use Base\Casts\Money;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Schema\Blueprint;
use Modules\Account\Models\Payment;
use Modules\Base\Models\BaseModel;
use Modules\Core\Models\Country;
use Modules\Domain\Models\Price;
use Modules\Partner\Models\Partner;

class Domain extends BaseModel
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
    protected $fillable = ['id', 'name', 'amount', 'first_name', 'last_name', 'email', 'phone', 'address', 'post_code', 'city', 'expiry_date', 'upgrade_date', 'last_upgrade_date', 'paid', 'completed', 'successful', 'status', 'is_new', 'whois_synced', 'payment_id', 'partner_id', 'country_id', 'price_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "domain_domain";

    /**
     * Add relationship to Country
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Add relationship to Payment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Add relationship to Price
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function price(): BelongsTo
    {
        return $this->belongsTo(Price::class);
    }

    public function migration(Blueprint $table): void
    {

        $table->string('name');
        $table->integer('amount')->nullable();
        $table->string('currency')->default('USD');
        $table->string('first_name');
        $table->string('last_name');
        $table->string('email');
        $table->string('phone');
        $table->string('address');
        $table->string('post_code');
        $table->string('city');
        $table->dateTime('expiry_date', 6)->nullable();
        $table->dateTime('upgrade_date', 6)->nullable();
        $table->dateTime('last_upgrade_date', 6)->nullable();
        $table->boolean('paid')->nullable()->default(false);
        $table->boolean('completed')->nullable()->default(false);
        $table->boolean('successful')->nullable()->default(false);
        $table->boolean('status')->nullable()->default(false);
        $table->boolean('is_new')->nullable()->default(false);
        $table->boolean('whois_synced')->nullable();
        $table->foreignId('payment_id')->nullable()->constrained(table: 'account_payment')->onDelete('set null');
        $table->foreignId('partner_id')->nullable()->constrained(table: 'partner_partner')->onDelete('set null');
        $table->foreignId('country_id')->nullable()->constrained(table: 'core_country')->onDelete('set null');
        $table->foreignId('price_id')->nullable()->constrained(table: 'domain_price')->onDelete('set null');
    }
}
