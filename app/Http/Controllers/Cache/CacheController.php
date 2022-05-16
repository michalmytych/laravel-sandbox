<?php

namespace App\Http\Controllers\Cache;

use App\Models\Cache\Location;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Collection;

class CacheController extends Controller
{
    /**
     * Normally I would put this method implementation details
     * in service or action class, but for this case it's ok.
     */
    public function all(): Collection
    {
        /**
         * Time after which cache is cleared.
         */
        $seconds = 15;

        if (Cache::has('map')) {
            return Cache::get('map');
        }

        return Cache::remember('map', $seconds, function () {
            return $this->longRunningProcessing();
        });
    }

    /**
     * Simulates some long-running processing.
     */
    private function longRunningProcessing(): Collection
    {
        sleep(4);

        return Location::all();
    }
}
