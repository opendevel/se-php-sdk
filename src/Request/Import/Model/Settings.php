<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Import\Model;

use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;

final class Settings implements ToArrayInterface
{

    /**
     * @var bool
     */
    private $update = true;

    /**
     * @var bool
     */
    private $addNamedays = true;

    /**
     * @var bool
     */
    private $addGenders = true;

    /**
     * @var bool
     */
    private $addSalutions = true;

    /**
     * @var bool
     */
    private $preserveUnsubscribed = true;

    /**
     * @var bool
     */
    private $skipInvalidEmails = false;

    /**
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Import\Model\SettingsConfirmationRequest|null
     */
    private $confirmationRequest = null;

    public function __construct()
    {
    }

    public function toArray(): array
    {
        return [
            'update' => $this->update,
            'add_namedays' => $this->addNamedays,
            'add_genders' => $this->addGenders,
            'add_salutions' => $this->addSalutions,
            'preserve_unsubscribed' => $this->preserveUnsubscribed,
            'skip_invalid_emails' => $this->skipInvalidEmails,
            'confirmation_request' => $this->confirmationRequest !== null ? $this->confirmationRequest->toArray() : null,
        ];
    }

    public function setUpdate(bool $update): void
    {
        $this->update = $update;
    }

    public function setAddNamedays(bool $addNamedays): void
    {
        $this->addNamedays = $addNamedays;
    }

    public function setAddGenders(bool $addGenders): void
    {
        $this->addGenders = $addGenders;
    }

    public function setAddSalutions(bool $addSalutions): void
    {
        $this->addSalutions = $addSalutions;
    }

    public function setPreserveUnsubscribed(bool $preserveUnsubscribed): void
    {
        $this->preserveUnsubscribed = $preserveUnsubscribed;
    }

    public function setSkipInvalidemails(bool $skipInvalidEmails): void
    {
        $this->skipInvalidEmails = $skipInvalidEmails;
    }

    public function setConfirmationRequest(?SettingsConfirmationRequest $confirmationRequest): void
    {
        $this->confirmationRequest = $confirmationRequest;
    }

}
