<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\Request\AbstractModel;

final class SettingsConfirmationRequest extends AbstractModel
{

    /**
     * @var int
     */
    private $email_id;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $sender_name;

    /**
     * @var string
     */
    private $reply_to;

    /**
     * @var string|null
     */
    private $confirmation_thank_you_page_url = null;

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'email_id' => $this->email_id,
            'sender_credentials' => [
                'from' => $this->from,
                'reply_to' => $this->reply_to,
                'sender_name' => $this->sender_name,
            ],
            'confirmation_thank_you_page_url' => $this->confirmation_thank_you_page_url,
        ];
    }

    public function __construct(int $emailId, string $from, string $replyTo, string $senderName, ?string $confirmationThankYouPageUrl = null)
    {
        $this->email_id = $emailId;
        $this->from = $from;
        $this->reply_to = $replyTo;
        $this->sender_name = $senderName;
        $this->confirmation_thank_you_page_url = $confirmationThankYouPageUrl;
    }

    public function setConfirmationThankYouPageUrl(?string $confirmation_thank_you_page_url): SettingsConfirmationRequest
    {
        $this->confirmation_thank_you_page_url = $confirmation_thank_you_page_url;
        return $this;
    }

}
