<?php

namespace Pterodactyl\Http\Requests\Api\Application\Users;

use IPTools\Range;
use Pterodactyl\Models\ApiKey;
use Illuminate\Validation\Validator;
use Pterodactyl\Services\Acl\Api\AdminAcl as Acl;
use Pterodactyl\Http\Requests\Api\Application\ApplicationApiRequest;

class StoreUserApiKeyRequest extends ApplicationApiRequest
{
    protected ?string $resource = Acl::RESOURCE_USERS;

    protected int $permission = Acl::WRITE;

    public function rules(): array
    {
        $rules = ApiKey::getRules();

        return [
            'description' => $rules['memo'],
            'allowed_ips' => [...$rules['allowed_ips'], 'max:50'],
            'allowed_ips.*' => 'string',
        ];
    }

    /**
     * Validate that each IP / CIDR range submitted is valid.
     */
    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            if (!is_array($ips = $this->input('allowed_ips'))) {
                return;
            }

            foreach ($ips as $ip) {
                try {
                    Range::parse($ip);
                } catch (\Exception) {
                    $validator->errors()->add('allowed_ips', sprintf('"%s" is not a valid IP address or CIDR range.', $ip));
                }
            }
        });
    }
}
