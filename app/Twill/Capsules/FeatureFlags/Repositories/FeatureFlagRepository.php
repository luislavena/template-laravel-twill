<?php

namespace App\Twill\Capsules\FeatureFlags\Repositories;

use Throwable;
use Illuminate\Support\Collection;
use A17\Twill\Repositories\ModuleRepository;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use App\Twill\Capsules\FeatureFlags\Models\FeatureFlag;
use App\Twill\Capsules\FeatureFlags\Services\Geolocation\Service as GeolocationService;

class FeatureFlagRepository extends ModuleRepository
{
    use HandleRevisions;

    public function __construct(FeatureFlag $model = null)
    {
        $this->model = $model ?? new FeatureFlag();
    }

    public function feature(string $code): bool
    {
        try {
            /** @var \App\Twill\Capsules\FeatureFlags\Models\FeatureFlag|null $featureFlag */
            $featureFlag = FeatureFlag::where('code', $code)->first();
        } catch (Throwable) {
            return false;
        }

        if (blank($featureFlag) || blank($featureFlag?->published) || $featureFlag?->published === false) {
            return false;
        }

        if (!$this->isRealProduction() || $this->isPubliclyAvailableToCurrentUser($featureFlag)) {
            return true;
        }

        return $featureFlag->publicly_available;
    }

    private function isRealProduction(): bool
    {
        return (new Collection(config('app.domains.publicly_available')))->contains(request()->getHost());
    }

    public function featureList(): array
    {
        return $this->model
            ->all()
            ->filter(fn($feature) => $this->feature($feature->code))
            ->pluck('code')
            ->toArray();
    }

    private function isPubliclyAvailableToCurrentUser(FeatureFlag $featureFlag): bool
    {
        return (new GeolocationService())->currentIpAddressIsOnList(
            collect(explode(',', $featureFlag->ip_addresses))
                ->map(fn($ip) => trim($ip))
                ->toArray(),
        );
    }
}
