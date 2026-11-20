<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Throwable;

/**
 * Consumes the free open.er-api.com exchange-rate API (no key required).
 */
class ExchangeRateService
{
    private const URL = 'https://open.er-api.com/v6/latest/USD';

    /**
     * @param  array<int, string>  $currencies
     * @return array{rates: array<string, float>, updated_at: ?string}|null  null when the API is unavailable
     */
    public function latest(array $currencies): ?array
    {
        try {
            $data = Cache::remember('exchange_rates_usd', now()->addHour(), function () {
                $response = Http::timeout(5)->retry(2, 200)->get(self::URL)->throw()->json();

                if (($response['result'] ?? null) !== 'success') {
                    throw new \RuntimeException('Exchange rate API returned an error.');
                }

                return [
                    'rates' => $response['rates'],
                    'updated_at' => $response['time_last_update_utc'] ?? null,
                ];
            });
        } catch (Throwable $e) {
            report($e);

            return null;
        }

        return [
            'rates' => collect($data['rates'])->only($currencies)->all(),
            'updated_at' => $data['updated_at'],
        ];
    }
}
