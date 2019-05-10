<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Contacts;

use SmartEmailing\Sdk\ApiV3Client\Response\BaseResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model\Contact;
use SmartEmailing\Types\PrimitiveTypes;

final class ContactsResponse extends BaseResponse
{

    /**
     * Contacts collection
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Response\Contacts\Model\Contact[]
     */
    private $data = [];

    public static function fromArray(array $array): self
    {
        $response = new self();

        $response->status = PrimitiveTypes::extractStringOrNull($array, 'status', true);

        $response->message = PrimitiveTypes::extractStringOrNull($array, 'message', true);

        $response->meta = PrimitiveTypes::extractArray($array, 'meta');

        $data = PrimitiveTypes::extractArrayOrNull($array, 'data');

        if (is_array($data)) {
            foreach ($data as $contact) {
                $contactObj = Contact::fromArray($contact);
                $response->data[$contactObj->getId()] = $contactObj;
            }
        }

        return $response;
    }

    public function getContacts(): array
    {
        return $this->data;
    }

    public function hasContact(int $id): bool
    {
        return isset($this->data[$id]);
    }

    public function getContact(int $id): ?Contact
    {
        return $this->hasContact($id) ? $this->data[$id] : null;
    }

}
