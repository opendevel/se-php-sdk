<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;
use SmartEmailing\Types\Emailaddress;

final class Recipient implements ToArrayInterface
{

    /**
     * Recipient's e-mail address.
     *
     * @var \SmartEmailing\Types\Emailaddress
     */
    private $emailAddress;

    public function __construct(string $emailaddress)
    {
        $this->emailAddress = Emailaddress::from($emailaddress);
    }

    public function toArray(): array
    {
        return [
            'emailaddress' => $this->emailAddress->getValue(),
        ];
    }

}
