<?php

namespace Modules\Domain\Models;

use Modules\Base\Models\BaseModel;

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

}
