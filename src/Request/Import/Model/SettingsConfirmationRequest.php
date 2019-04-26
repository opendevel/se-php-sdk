<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\Request\ToArrayInterface;
use SmartEmailing\Types\Emailaddress;
use SmartEmailing\Types\UrlType;

final class SettingsConfirmationRequest implements ToArrayInterface
{

    /**
     * ID of E-mail containing {{confirmlink}}.
     *
     * @var int
     */
    private $emailId;

    /**
     * From e-mail address of opt-in campaign
     *
     * @var \SmartEmailing\Types\Emailaddress
     */
    private $from;

    /**
     * From name of opt-in campaign
     *
     * @var string
     */
    private $senderName;

    /**
     * Reply-To e-mail address in opt-in campaign
     *
     * @var \SmartEmailing\Types\Emailaddress
     */
    private $replyTo;

    /**
     * URL of thank-you page where contact will be redirected after clicking at confirmation link. If not provided, contact will be redirected to default page
     *
     * @var \SmartEmailing\Types\UrlType|null
     */
    private $confirmationThankYouPageUrl = null;

    public function __construct(
        int $emailId,
        Emailaddress $from,
        string $senderName,
        Emailaddress $replyTo,
        ?UrlType $confirmationThankYouPageUrl = null
    ) {
        $this->emailId = $emailId;
        $this->from = $from;
        $this->senderName = $senderName;
        $this->replyTo = $replyTo;
        $this->confirmationThankYouPageUrl = $confirmationThankYouPageUrl;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'email_id' => $this->emailId,
            'sender_credentials' => [
                'from' => $this->from->getValue(),
                'sender_name' => $this->senderName,
                'reply_to' => $this->replyTo->getValue(),
            ],
            'confirmation_thank_you_page_url' => $this->confirmationThankYouPageUrl !== null ? $this->confirmationThankYouPageUrl->getValue() : null,
        ];

    }

    public function setConfirmationThankYouPageUrl(?UrlType $confirmationThankYouPageUrl): SettingsConfirmationRequest
    {
        $this->confirmationThankYouPageUrl = $confirmationThankYouPageUrl;
        return $this;
    }

}
