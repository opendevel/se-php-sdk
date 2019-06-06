<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Newsletter;

use DateTimeImmutable;
use SmartEmailing\Sdk\ApiV3Client\ApiRequestInterface;
use SmartEmailing\Types\Emailaddress;
use SmartEmailing\Types\PrimitiveTypes;

final class NewsletterRequest implements ApiRequestInterface
{

    /**
     * @var string
     */
    protected static $method = 'POST';

    /**
     * @var string
     */
    protected static $endpoint = 'newsletter';

    /**
     * Id of email to send
     *
     * @var int
     */
    private $emailId;

    /**
     * Ids of contactlists to send newsletter to.
     *
     * @var mixed[]
     */
    private $contactLists = [];

    /**
     * Ids of contactlists to exclude from sending
     *
     * @var mixed[]
     */
    private $excludedContactLists = [];

    /**
     * @var string|null
     */
    private $name = null;

    /**
     * When should sending start.
     * Sending will be started immediately if left empty.
     *
     * @var \DateTimeImmutable|null
     */
    private $start = null;

    /**
     * Should statistics be measured.
     *
     * @var bool|null
     */
    private $measureStats = null;

    /**
     * Should newsletter be send to contact during the time it most often reads emails.
     *
     * @var bool|null
     */
    private $sendOnPreferredTime = null;

    /**
     * Sender email address.
     * Sender email, name and replyto needs to be set,
     * otherwise contactlist settings will be used. Must be a confirmed email.
     *
     * @var \SmartEmailing\Types\Emailaddress|null
     */
    private $senderEmail = null;

    /**
     * Sender name.
     * Sender email, name and replyto needs to be set,
     * otherwise contactlist settings will be used.
     *
     * @var string|null
     */
    private $senderName = null;

    /**
     * Reply to email address.
     * Sender email, name and replyto needs to be set,
     * otherwise contactlist settings will be used. Must be a confirmed email.
     *
     * @var \SmartEmailing\Types\Emailaddress|null
     */
    private $replyTo = null;

    /**
     * GA settings
     *
     * @var string|null
     */
    private $utmSource = null;

    /**
     * GA settings
     *
     * @var string|null
     */
    private $utmMedium = null;

    /**
     * GA settings
     *
     * @var string|null
     */
    private $utmCampaign = null;

    /**
     * GA settings
     *
     * @var string|null
     */
    private $utmContent = null;

    /**
     * NewsletterRequest constructor.
     * @param int $email_id
     * @param mixed[] $contactlists
     */
    public function __construct(int $email_id, array $contactlists)
    {
        $this->emailId = $email_id;

        foreach ($contactlists as $contactlist) {
            $this->contactLists[] = PrimitiveTypes::getInt($contactlist);
        }
    }

    public static function getHttpMethod(): string
    {
        return self::$method;
    }

    public function getEndpoint(): string
    {
        return self::$endpoint;
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        $return = [
            'email_id' => $this->emailId,
            'contactlists' => $this->contactLists,
        ];

        if (!empty($this->excludedContactLists)) {
            $return['excluded_contactlists'] = $this->excludedContactLists;
        }

        if (!is_null($this->name)) {
            $return['name'] = $this->name;
        }

        if (!is_null($this->start)) {
            $return['start'] = $this->start->format('Y-m-d H:i:s');
        }

        if (!is_null($this->measureStats)) {
            $return['measurestats'] = $this->measureStats;
        }

        if (!is_null($this->sendOnPreferredTime)) {
            $return['sendOnPreferredTime'] = $this->sendOnPreferredTime;
        }

        if (!is_null($this->senderEmail)) {
            $return['senderemail'] = $this->senderEmail->getValue();
        }

        if (!is_null($this->senderName)) {
            $return['sendername'] = $this->senderName;
        }

        if (!is_null($this->replyTo)) {
            $return['replyto'] = $this->replyTo->getValue();
        }

        if (!is_null($this->utmSource)) {
            $return['utm_source'] = $this->utmSource;
        }

        if (!is_null($this->utmMedium)) {
            $return['utm_medium'] = $this->utmMedium;
        }

        if (!is_null($this->utmCampaign)) {
            $return['utm_campaign'] = $this->utmCampaign;
        }

        if (!is_null($this->utmContent)) {
            $return['utm_content'] = $this->utmContent;
        }

        return $return;
    }

    /**
     * @param mixed[] $excludedContactLists
     */
    public function setExcludedContactLists(array $excludedContactLists): void
    {
        foreach ($excludedContactLists as $excludedContactList) {
            $this->excludedContactLists[] = PrimitiveTypes::getInt($excludedContactList);
        }
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setStart(?DateTimeImmutable $start): void
    {
        $this->start = $start;
    }

    public function setMeasureStats(?bool $measureStats): void
    {
        $this->measureStats = $measureStats;
    }

    public function setSendOnPreferredTime(?bool $sendOnPreferredTime): void
    {
        $this->sendOnPreferredTime = $sendOnPreferredTime;
    }

    public function setSenderEmail(?string $senderEmail): void
    {
        $this->senderEmail = Emailaddress::from($senderEmail);
    }

    public function setSenderName(?string $senderName): void
    {
        $this->senderName = $senderName;
    }

    public function setReplyTo(?string $replyTo): void
    {
        $this->replyTo = Emailaddress::from($replyTo);
    }

    public function setUtmSource(?string $utmSource): void
    {
        $this->utmSource = $utmSource;
    }

    public function setUtmMedium(?string $utmMedium): void
    {
        $this->utmMedium = $utmMedium;
    }

    public function setUtmCampaign(?string $utmCampaign): void
    {
        $this->utmCampaign = $utmCampaign;
    }

    public function setUtmContent(?string $utmContent): void
    {
        $this->utmContent = $utmContent;
    }

}
