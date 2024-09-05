<?php

namespace Modules\Domain\Models;

use Modules\Account\Models\Payment;
use Modules\Base\Models\BaseModel;
use Modules\Core\Models\Country;
use Modules\Domain\Models\Price;
use Modules\Partner\Models\Partner;

class Domain extends BaseModel
{

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
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * Add relationship to Payment
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    /**
     * Add relationship to Partner
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Add relationship to Price
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function price()
    {
        return $this->belongsTo(Price::class);
    }

}
