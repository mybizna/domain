<?php

namespace Modules\Domain\Classes;

class Domain
{
    public static function getDomainPrice($domain)
    {
        $registrarId = config('domain.default_registrar_id');
        $domainPrice = config('domain.default_price');

        $tld = self::getDomainTld($domain);

        $record = DB::table('domain_price')
            ->select('*')
            ->where('tld', $tld)
            ->first();

        if (is_object($record)) {
            $registrarId = $record->registrar_id;
            $domainPrice = $record->price;
        }

        return [$domainPrice, $registrarId];
    }

    public static function getDomainTld($domain)
    {
        $domainArr = explode('.', $domain);
        array_shift($domainArr);
        $tld = implode('.', $domainArr);

        return $tld;
    }

    public static function getCleanDomain($tld = '', $tmpDomain = '')
    {
        $tld = ($tld != '') ? $tld : request()->get('tld');
        $tmpDomain = ($tmpDomain != '') ? $tmpDomain : request()->get('domain');

        $tmpDomain = strtolower($tmpDomain);
        $tmpDomain = str_replace(['www.', 'http://', 'https://'], '', $tmpDomain);
        $tmpDomain = trim($tmpDomain);
        $tmpDomainArr = explode('.', $tmpDomain);
        $tmpDomain = preg_replace("/[^a-z0-9_\-]/", '', $tmpDomainArr[0]);

        $domainArr = explode('.', $tmpDomain);
        $domain = $domainArr[0] . '.' . $tld;

        return $domain;
    }

    public static function searchDomainWhois($domain)
    {
        if (self::isDomainValid($domain)) {
            $ip = gethostbyname($domain);

            if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                $result['is_available'] = false;
            } else {
                if (config('domain.search_type') == 'api') {
                    $result = self::searchDomainApi($domain);
                } else {
                    $result = self::searchDomainLocalScript($domain);
                }

                $defaultPrice = config('domain.default_price');
                $result['price'] = ($defaultPrice) ? number_format($defaultPrice, 2) : number_format(12, 2);
            }
        } else {
            $result['is_available'] = false;
        }

        return $result;
    }

    public static function searchDomainApi($domain)
    {
        $searchApiUrl = config('search_api_url');

        $response = Http::get($searchApiUrl . '?domain=' . $domain);

        return $response->json();
    }

    public static function searchDomainLocalScript($domain)
    {
        $whois = new Whois();
        $whois->deepWhois = true;

        $result = $whois->lookup($domain, false);

        $registered = isset($result['regrinfo']['registered']) && $result['regrinfo']['registered'] == 'yes';

        $result['is_available'] = ($registered) ? false : true;

        if (!$result['is_available']) {
            if (isset($result['regrinfo']['domain']['expires'])) {
                $result['additional_info'] = 'Domain: ' . $domain . PHP_EOL .
                    'Expired: ' . $result['regrinfo']['domain']['expires'] . PHP_EOL;
                $result['is_available'] = false;
            } else {
                $result['additional_info'] = 'Domain: ' . $domain . PHP_EOL .
                    'Trying to find expires date...' . PHP_EOL;
                foreach ($result['rawdata'] as $raw) {
                    $result['is_available'] = true;

                    if (strpos($raw, 'Expiry Date:') !== false) {
                        $result['additional_info'] = 'Expired: ' . trim(explode(':', $raw)[1]) . PHP_EOL;
                        $result['is_available'] = false;
                        break;
                    }

                    if (strpos($raw, 'Expiration Date:') !== false) {
                        $result['additional_info'] = 'Expired: ' . trim(explode(':', $raw)[1]) . PHP_EOL;
                        $result['is_available'] = false;
                        break;
                    }
                }
            }
        }

        return $result;
    }

    private static function isDomainValid($domain)
    {
        // Implement your domain validation logic here
        return true; // Replace with your validation check
    }
}
