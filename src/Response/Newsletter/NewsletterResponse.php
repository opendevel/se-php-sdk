<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Newsletter;

use SmartEmailing\Sdk\ApiV3Client\Response\BaseResponse;
use SmartEmailing\Types\Arrays;
use SmartEmailing\Types\PrimitiveTypes;

final class NewsletterResponse extends BaseResponse
{

    /**
     * Response data
     *
     * @var array
     */
    private $data = [];

    public static function fromArray(array $array): self
    {
        $response = new self();

        $response->status = PrimitiveTypes::extractStringOrNull($array, 'status', true);

        $response->message = PrimitiveTypes::extractStringOrNull($array, 'message', true);

        $response->meta = Arrays::extractArray($array, 'meta');

        $response->data = Arrays::extractArray($array, 'data'); //@todo!!! pokud vraci validation error - prvek data neni pritomen - oseztrit

        return $response;
    }

    public function getData(): array
    {
        return $this->data;
    }

}
