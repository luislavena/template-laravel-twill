<?php

namespace App\Twill\Capsules\FeatureFlags\Services\Geolocation;

use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\IpUtils;

class Service
{
    public function ipAddress(): string|null
    {
        $ipAddress = $this->getTrueClientIP() ?? $this->getXForwardedIp();

        if (blank($ipAddress)) {
            return request()->ip() ?? request()->getClientIp();
        }

        if (!$this->isIPv6((string) $ipAddress)) {
            $ipAddress = Str::before((string) $ipAddress, ':');
        }

        return $ipAddress;
    }

    public function isIPv6(string $ipAddress): bool
    {
        return filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }

    public function currentIpAddressIsOnList(array $ipAddresses): bool
    {
        if (($ipAddress = $this->ipAddress()) === null) {
            return false;
        }

        return IpUtils::checkIp($ipAddress, $ipAddresses);
    }

    private function getXForwardedIp(): string|null
    {
        if (is_array($xForwardedForIps = request()->header('X-Forwarded-For'))) {
            return $xForwardedForIps[0] ?? null;
        }

        return collect(explode(',', (string) $xForwardedForIps))
            ->filter()
            ->first();
    }

    private function getTrueClientIP(): string|null
    {
        $trueClientIp = request()->header('True-Client-IP');

        if (is_array($trueClientIp)) {
            return $trueClientIp[0] ?? null;
        }

        return $trueClientIp;
    }
}
