<?php

namespace App\Services\Auth;


use Illuminate\Auth\EloquentUserProvider;
use Illuminate\Support\Str;

class FlexibleUserProvider extends EloquentUserProvider
{
    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
            (count($credentials) === 1 &&
                array_key_exists('password', $credentials))
        ) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // Eloquent User "model" that will be utilized by the Guard instances.
        $query = $this->createModel()->newQuery();

        list($enough, $necessary) = $this->parseCredentials($credentials);

        $query->when(count($enough) > 0, function ($q) use ($enough) {
            foreach ($enough as $key => $value) {
                $q->orWhere($key, $value);
            }
        });

        foreach ($necessary as $key => $value) {
            if (!Str::contains($key, 'password')) {
                $query->where($key, $value);
            }
        }

        return $query->first();
    }

    protected function parseCredentials(array $credentials)
    {
        $enough = array_get($credentials, 'enough', []);

        $necessary = array_get($credentials, 'necessary', $credentials);

        return [$enough, $necessary];
    }
}