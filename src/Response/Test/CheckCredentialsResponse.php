<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Test;

use SmartEmailing\Sdk\ApiV3Client\Response\BaseResponse;
use SmartEmailing\Types\PrimitiveTypes;

final class CheckCredentialsResponse extends BaseResponse
{

    /**
     * Your account Id
     *
     * @var int|null
     */
    private $accountId = null;

    public static function fromArray(array $array): self
    {
        $response = new self();

        $response->status = PrimitiveTypes::extractStringOrNull($array, 'status', true);

        $response->message = PrimitiveTypes::extractStringOrNull($array, 'message', true);

        $response->meta = PrimitiveTypes::extractArray($array, 'meta');

        $response->accountId = PrimitiveTypes::extractIntOrNull($array, 'account_id', true);

        return $response;
    }

    public function getAccountId(): ?int
    {
        return $this->accountId;
    }

}
