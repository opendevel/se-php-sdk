<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response\Import;

use SmartEmailing\Sdk\ApiV3Client\Response\BaseResponse;
use SmartEmailing\Sdk\ApiV3Client\Response\Import\Model\Contact;
use SmartEmailing\Types\PrimitiveTypes;

final class ImportResponse extends BaseResponse
{

    /**
     * Imported contacts
     *
     * @var mixed[]
     */
    private $contacts = [];

    /**
     * @param mixed[] $array
     * @return \SmartEmailing\Sdk\ApiV3Client\Response\Import\ImportResponse
     */
    public static function fromArray(array $array): self
    {
        $response = new self();

        $response->status = PrimitiveTypes::extractStringOrNull($array, 'status', true);

        $response->message = PrimitiveTypes::extractStringOrNull($array, 'message', true);

        $response->meta = PrimitiveTypes::extractArray($array, 'meta');

        $contacts = PrimitiveTypes::extractArrayOrNull($array, 'contacts_map');

        if (is_array($contacts)) {
            foreach ($contacts as $contact) {
                $contactObj = Contact::fromArray($contact);
                $response->contacts[$contactObj->getId()] = $contactObj;
            }
        }

        return $response;
    }

    /**
     * @return \SmartEmailing\Sdk\ApiV3Client\Response\Import\Model\Contact[]
     */
    public function getContacts(): array
    {
        return $this->contacts;
    }

    public function hasContact(int $id): bool
    {
        return isset($this->contacts[$id]);
    }

    public function getContact(int $id): ?Contact
    {
        return $this->hasContact($id) ? $this->contacts[$id] : null;
    }

}
