<?php

namespace Modules\Domain\Http\Controllers;

use Illuminate\Support\Facades\View;
use Modules\Domain\Classes\DomainProcessor;
use Modules\Domain\Models\Domain;

class DomainController extends Controller
{
    public function index(Request $request)
    {
        $context = [
            'title' => "Domains",
        ];

        return view('index', $context);
    }

    public function userDomainRenew(Request $request, $pk)
    {
        $domainProcessor = new DomainProcessor();
        $domain = Domain::find($pk);

        $context = $domainProcessor->prepareForRenewContext($domain);

        return View::make('user.domain_payment', $context);
    }

    public function userDomainPayment(Request $request, $pk)
    {
        $domainProcessor = new DomainProcessor();
        $domain = Domain::find($pk);

        $context = $domainProcessor->prepareForNewContext($domain);

        return View::make('user.domain_payment', $context);
    }

}
