<?php

namespace App\Services\Auth;

use Illuminate\Auth\GenericUser;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Session;

class SessionUserProvider implements UserProvider
{
    /**
     * Retrieve a user by their unique identifier.
     */
    public function retrieveById($identifier)
    {
        $userData = Session::get('user');
        
        if ($userData) {
            $data = (array)$userData;
            // Ensure common keys exist to prevent "Undefined array key" errors in GenericUser
            $data['profile_photo'] = $data['profile_photo'] ?? $data['profilePhoto'] ?? null;
            $data['role'] = $data['role'] ?? 'user';
            $data['name'] = $data['name'] ?? $data['username'] ?? 'User';
            
            return new GenericUser($data);
        }

        return null;
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     */
    public function retrieveByToken($identifier, $token)
    {
        return null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     */
    public function updateRememberToken(Authenticatable $user, $token)
    {
        // No-op for session-based
    }

    /**
     * Retrieve a user by the given credentials.
     */
    public function retrieveByCredentials(array $credentials)
    {
        // This is used for initial login attempts.
        // In our case, the controller handles the API call and then calls auth()->login().
        return null;
    }

    /**
     * Validate a user against the given credentials.
     */
    public function validateCredentials(Authenticatable $user, array $credentials)
    {
        return false;
    }

    /**
     * Re-hash the user's password if required and supported.
     */
    public function rehashPasswordIfRequired(Authenticatable $user, array $credentials, bool $force = false)
    {
        // No-op
    }
}
