<?php

namespace Modules\Domain\Classes;

use App\Http\Middleware\RequestMiddleware;
use Modules\Core\Entities\Country;
use Modules\Domain\Entities\Domain;
use Modules\Domain\Entities\Price;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class DomainProcessor
{
    public function autoExtend()
    {
        $test = 1;
    }

    public function validDomain($domainToSearch)
    {
        $valid = true;

        $requestMiddleware = new RequestMiddleware();
        $request = $requestMiddleware->getRequest();

        if ($domainToSearch == null) {
            return [$domainToSearch, $valid];
        }

        $domainToSearch = trim($domainToSearch);

        if ($domainToSearch[0] == '.') {
            $valid = false;
            $request->session()->flash('error', 'Your domain Name should not start with "."');
        }

        if ($valid && strpos($domainToSearch, '.') === false) {
            $domainToSearch = $domainToSearch ? $domainToSearch : $domainToSearch . ".com";
            $request->session()->flash('success', 'Your domain Name had no extension and will default to ' . $domainToSearch);
        }

        return [$domainToSearch, $valid];
    }

    public function saveDomainFromInput($request)
    {
        $countryId = $request->input('country') ?: $request->query('country');
        $userId = $request->input('user_id') ?: $request->query('user_id');
        $domainName = $request->query('domain_name') ?: $request->query('domain_to_search') ?: $request->input('domain_name');

        $user = User::find($userId) ?: $request->user();
        $country = Country::first();
        $price = $this->getDomainPrice($request->input('name', $domainName));

        $domain = Domain::where('name', $domainName)->where('user_id', $user->id)->first();

        if ($domain) {
            return $domain;
        }

        if ($countryId) {
            $country = Country::find($countryId);
        }

        $firstName = $user->first_name ?: 'first_name';
        $lastName = $user->last_name ?: 'last_name';
        $phone = optional($user->profile)->phone ?: '0723232323';
        $address = optional($user->profile)->address ?: 'Nairobi Kenya';
        $town = optional($user->profile)->address ?: 'Nairobi';

        $domain = new Domain([
            'name' => $request->input('name', $domainName),
            'first_name' => $request->input('first_name', $firstName),
            'last_name' => $request->input('last_name', $lastName),
            'email' => $request->input('email', $user->email),
            'phone' => $request->input('phone', $phone),
            'post_code' => $request->input('post_code', '00000'),
            'address' => $request->input('address', $address),
            'city' => $request->input('city', $town),
            'country_id' => $country->id,
            'price_id' => $price->id,
            'user_id' => $user->id,
        ]);

        $domain->save();

        return $domain;
    }

    public function domainSearch($domainToSearch, $context)
    {
        $globalPreferences = config('global_preferences');
        $whmcsServerEnabled = $globalPreferences['hosting__whmcs_server_enabled'];

        $domainResult = '';
        $domainAvailable = false;

        if ($domainToSearch) {
            $price = $this->getDomainPrice($domainToSearch);

            if ($price) {
                $context['price'] = $price;
                $context['domain_acceptable'] = $price !== null;
            }

            if ($whmcsServerEnabled) {
                list($domainResult, $domainAvailable) = $this->whmcsDomainSearch($domainToSearch);
            } else {
                list($domainResult, $domainAvailable) = $this->whoisXMLDomainSearch($domainToSearch);
            }

            $context['domain_result'] = $domainResult;
            $context['domain_available'] = $domainAvailable;
            $context['domain_to_search'] = $domainToSearch;
        }

        return $context;
    }

    public function whoisXMLDomainSearch($domainToSearch)
    {
        $params = [
            'apiKey' => 'at_KegtvWltFvstirZ25eXo4Er4XkpfO',
            'domainName' => $domainToSearch,
            'outputFormat' => 'json',
            'da' => '1',
        ];

        $response = Http::get('https://www.whoisxmlapi.com/whoisserver/WhoisService', $params);

        $domainDict = $response->json();

        $domainAvailable = $domainDict['WhoisRecord']['domainAvailability'] === 'AVAILABLE';

        return [$domainDict, $domainAvailable];
    }

    public function whmcsDomainSearch($domainToSearch)
    {
        $whmcs = new Whmcs();

        $domainDict = $whmcs->domainWhois($domainToSearch);

        $domainAvailable = false;

        if ($domainDict['result'] !== 'error') {
            $domainAvailable = $domainDict['status'] === 'available';
        }

        return [$domainDict, $domainAvailable];
    }

    public function prepareForRenewContext($domain, $nextTo = 'user_domain_list')
    {
        $paymentProcessor = new PaymentProcessor();

        $paymentDict = [
            "user_id" => $domain->user_id,
            "app_name" => 'domain',
            "model_name" => 'Domain',
            "next_to" => $nextTo,
            "type" => 'purchase-domain',
            "is_new" => 0,
            "description" => 'Renew Domain[' . $domain->name . '] worth ' . $domain->price->price,
            "quantity" => 1,
            "amount" => $domain->price->price,
            "source_ident" => $domain->id,
            "source_package_ident" => $domain->price->id,
            "items" => [],
        ];

        $context = $paymentProcessor->prepareContext($paymentDict);
        $context['title'] = 'Domain Payment';
        $context['domain'] = $domain;

        // Save payment
        $domain->payment_id = $context['payment']->id;
        $domain->save();

        return $context;
    }

    public function prepareForNewContext($domain, $nextTo = 'user_domain_list')
    {
        $paymentProcessor = new PaymentProcessor();

        $paymentDict = [
            "user_id" => $domain->user_id,
            "app_name" => 'domain',
            "model_name" => 'Domain',
            "next_to" => $nextTo,
            "type" => 'purchase-domain',
            "is_new" => 1,
            "description" => 'Purchase Domain[' . $domain->name . '] worth ' . $domain->price->price,
            "quantity" => 1,
            "amount" => $domain->price->price,
            "source_ident" => $domain->id,
            "source_package_ident" => $domain->price->id,
            "items" => [],
        ];

        $context = $paymentProcessor->prepareContext($paymentDict);
        $context['title'] = 'Domain Payment';
        $context['domain'] = $domain;

        // Save payment
        $domain->payment_id = $context['payment']->id;
        $domain->save();

        return $context;
    }

    public function updateRecord($domain, $payment)
    {
        $this->updateDomain($domain);
    }

    public function updateDomain($domain)
    {
        $expiryDate = $this->getExpiryDate($domain->expiry_date, 365);

        $domain->status = 1;
        $domain->paid = 1;
        $domain->completed = 1;
        $domain->is_new = 0;
        $domain->expiry_date = $expiryDate;
        $domain->last_upgrade_date = Carbon::now();

        if (!$domain->upgrade_date) {
            $domain->upgrade_date = Carbon::now();
        }

        if ($domain->is_new) {
            $domain->upgrade_date = Carbon::now();
        }

        $domain->save();
    }

    public function getExpiryDate($expiryDate, $numberOfDays = 30)
    {
        $numberOfDays = $numberOfDays ?: 30;
        $d = Carbon::now()->addDays($numberOfDays);

        if (!$expiryDate) {
            $expiryDate = Carbon::now()->addDays($numberOfDays);
        } else {
            $expiryDate = $expiryDate->tz(null);
            $expiryDateStamp = $expiryDate;
            $todayDateStamp = Carbon::now();

            if ($expiryDateStamp->gt($todayDateStamp)) {
                $expiryDate = $expiryDate->addDays($numberOfDays);
            } else {
                $expiryDate = Carbon::now()->addDays($numberOfDays);
            }
        }

        return $expiryDate;
    }

    public function syncDomainPurchase()
    {
        $whmcs = new Whmcs(); // Assuming you have the Whmcs class set up

        $domains = Domain::where('paid', true)
            ->where('whois_synced', false)
            ->take(100)
            ->get();

        foreach ($domains as $domain) {
            $whmcs->createCustomer($domain->user);
            $whmcs->getRegisterDomain($domain);

            $domain->whois_synced = true;
            $domain->save();
        }
    }

    public function syncExpiryPaidStatus()
    {
        $activeDomainList = $this->getActiveToSync();

        foreach ($activeDomainList as $domain) {
            $domain->update([
                'paid' => true,
                'status' => true,
                'completed' => true,
                'successful' => true,
            ]);
        }

        $inactiveDomainList = $this->getInActiveToSync();

        foreach ($inactiveDomainList as $domain) {
            $domain->update([
                'paid' => true,
                'status' => true,
                'completed' => true,
                'successful' => true,
            ]);
        }
    }

    public function getActiveToSync()
    {
        return Domain::where('paid', false)
            ->where('expiry_date', '>', Carbon::today())
            ->take(100)
            ->get();
    }

    public function getInActiveToSync()
    {
        return Domain::where('paid', true)
            ->where('expiry_date', '<', Carbon::today())
            ->take(100)
            ->get();
    }

    public function getDomainPrice($domain)
    {
        $defaultRegistrarId = config('domain.default_registrar_id');
        $defaultPrice = config('domain.default_price');

        list($name, $tld) = explode(".", $domain, 2);

        $price = Price::where('tld', '.' . $tld)->first();

        return $price;
    }

}
