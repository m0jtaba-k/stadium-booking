<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Stadium;
use App\Models\Booking;
use App\Models\Rating;
use App\Policies\StadiumPolicy;
use App\Policies\BookingPolicy;
use App\Policies\RatingPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Stadium::class => StadiumPolicy::class,
        Booking::class => BookingPolicy::class,
        Rating::class => RatingPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}