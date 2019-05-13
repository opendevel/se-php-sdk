<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Contacts;

use SmartEmailing\Sdk\ApiV3Client\Response\BaseResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model\Contact;
use SmartEmailing\Types\PrimitiveTypes;

final class ContactResponse extends BaseResponse
{

    /**
     * Single sontact
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model\Contact
     */
    private $contact;

    public static function fromArray(array $array): self
    {
        $response = new self();

        $response->status = PrimitiveTypes::extractStringOrNull($array, 'status', true);

        $response->message = PrimitiveTypes::extractStringOrNull($array, 'message', true);

        $response->meta = PrimitiveTypes::extractArray($array, 'meta');

        $response->contact = Contact::fromArray(PrimitiveTypes::extractArray($array, 'data'));

        return $response;
    }

    public function getContact(): Contact
    {
        return $this->contact;
    }

}
