<?php

namespace Pterodactyl\Http\Controllers\Api\Application\Users;

use Pterodactyl\Models\User;
use Pterodactyl\Models\ApiKey;
use Illuminate\Http\JsonResponse;
use Pterodactyl\Facades\Activity;
use Pterodactyl\Exceptions\DisplayException;
use Pterodactyl\Transformers\Api\Client\ApiKeyTransformer;
use Pterodactyl\Http\Controllers\Api\Application\ApplicationApiController;
use Pterodactyl\Http\Requests\Api\Application\Users\GetUserApiKeysRequest;
use Pterodactyl\Http\Requests\Api\Application\Users\StoreUserApiKeyRequest;

class ApiKeyController extends ApplicationApiController
{
    /**
     * Returns all of the API keys that exist for the given user.
     */
    public function index(GetUserApiKeysRequest $request, User $user): array
    {
        return $this->fractal->collection($user->apiKeys)
            ->transformWith($this->getTransformer(ApiKeyTransformer::class))
            ->toArray();
    }

    /**
     * Store a new API key for the given user's account.
     *
     * @throws \Pterodactyl\Exceptions\DisplayException
     */
    public function store(StoreUserApiKeyRequest $request, User $user): array
    {
        if ($user->apiKeys->count() >= 25) {
            throw new DisplayException('This user has reached the account limit for number of API keys.');
        }

        $token = $user->createToken(
            $request->input('description'),
            $request->input('allowed_ips')
        );

        Activity::event('user:api-key.create')
            ->subject($token->accessToken)
            ->property('identifier', $token->accessToken->identifier)
            ->log();

        return $this->fractal->item($token->accessToken)
            ->transformWith($this->getTransformer(ApiKeyTransformer::class))
            ->addMeta(['secret_token' => $token->plainTextToken])
            ->toArray();
    }

    /**
     * Deletes a given API key for the specified user.
     */
    public function delete(GetUserApiKeysRequest $request, User $user, string $identifier): JsonResponse
    {
        /** @var ApiKey $key */
        $key = $user->apiKeys()
            ->where('key_type', ApiKey::TYPE_ACCOUNT)
            ->where('identifier', $identifier)
            ->firstOrFail();

        Activity::event('user:api-key.delete')
            ->property('identifier', $key->identifier)
            ->log();

        $key->delete();

        return new JsonResponse([], JsonResponse::HTTP_NO_CONTENT);
    }
}
