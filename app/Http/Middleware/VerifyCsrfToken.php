<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/logo-design/*',
        '/logo-feedback/*',
        '/logo-first-feedback/*',
        '/logo-final-feedback/*',
        '/webdesign/*',
        '/webdesign-onboarding/*',
        '/text-writing/*',
        '/onboarding/*',
        '/text-adding/*',
        '/first-feedback/*',
        '/final-feedback/*',
        '/website-feedback/*',
        '/hosting/*',
        '/extra-function/*',
        '/text-first-feedback/*',
        '/text-final-feedback/*',
        '/text-feedback/*',
        '/extra-work/*',
        '/mail-instellen/*',
        '/webdesign-version-1/*',
        '/webdesign-version-2/*',
        '/webdesign-development/*',
        '/first-home/*',
        '/mail-error/*',
        '/webshop-onboarding/*',
        '/content-adding/*'
    ];
}
