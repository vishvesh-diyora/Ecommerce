<?php

namespace Smartisan\Settings;

use Illuminate\Support\Arr;
use Smartisan\Settings\Contracts\Castable;
use Smartisan\Settings\Exceptions\CastHandlerException;

class CastHandler
{
    /**
     * Evaluate all casts on the given payload and return the new modified payload.
     */
    public function handle(mixed $payload): array
    {
        if (is_array($payload)) {
            $entries = $payload;

            array_walk_recursive($entries, function (&$payload) {
                $payload = $this->applyCast($payload);
            });

            return $entries;
        }

        return $this->applyCast($payload);
    }

    /**
     * Determine the appropiate cast to the given payload value.
     */
    protected function applyCast(mixed $payload): array
    {
        $cast = $this->resolveCast($payload);

        if (! $cast->handler) {
            return [
                '$value' => $payload,
                '$cast' => null,
            ];
        }

        if (is_string($cast->handler) &&
            class_exists($cast->handler) &&
            Arr::exists(class_implements($cast->handler), Castable::class)) {
            return [
                '$value' => app($cast->handler)->set($payload),
                '$cast' => $cast->type,
            ];
        }

        if (is_object($cast->handler) && $cast->handler instanceof Castable) {
            return [
                '$value' => ($cast->handler)->set($payload),
                '$cast' => get_class($payload),
            ];
        }

        throw CastHandlerException::invalid($cast->handler);
    }

    /**
     * Resolve the corresponding cast of the given payload data type.
     */
    protected function resolveCast(mixed $payload): object
    {
        $casts = config('settings.casts');

        foreach ($casts as $type => $handler) {
            if ($payload instanceof $type) {
                return (object) [
                    'type' => $type,
                    'handler' => $handler,
                ];
            }
        }

        return (object) [
            'type' => null,
            'handler' => null,
        ];
    }
}
