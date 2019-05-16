<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;
use SmartEmailing\Types\Emailaddress;

final class SenderCredentials implements ToArrayInterface
{

    /**
     * //@todo popis
     *
     * @var \SmartEmailing\Types\Emailaddress
     */
    private $from;

    /**
     * Sender's name as displayed in From header
     *
     * @var string
     */
    private $senderName;

    /**
     * E-mail address displayed in Reply-To header
     *
     * @var \SmartEmailing\Types\Emailaddress
     */
    private $replyTo;

    public function __construct(string $from, string $senderName, string $replyTo)
    {
        $this->from = Emailaddress::from($from);
        $this->senderName = $senderName;
        $this->replyTo = Emailaddress::from($replyTo);
    }


    public function toArray(): array
    {
        return [
            'from' => $this->from->getValue(),
            'sender_name' => $this->senderName,
            'reply_to' => $this->replyTo->getValue(),
        ];
    }

}
