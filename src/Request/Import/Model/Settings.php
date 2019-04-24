<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\Request\Import\Model;

use SmartEmailing\Sdk\Request\ToArrayInterface;

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
     * @var \SmartEmailing\Sdk\Request\Import\Model\SettingsConfirmationRequest|null
     */
    private $confirmationRequest = null;

    public function toArray(): array
    {
        $array = [
            'update' => $this->update,
            'add_namedays' => $this->addNamedays,
            'add_genders' => $this->addGenders,
            'add_salutions' => $this->addSalutions,
            'preserve_unsubscribed' => $this->preserveUnsubscribed,
            'skip_invalid_emails' => $this->skipInvalidEmails,
            'confirmation_request' => $this->confirmationRequest,
        ];

        return array_filter($array, function ($var) {
            return !is_null($var);
        });
    }

    public function setUpdate(bool $update = true): Settings
    {
        $this->update = $update;
        return $this;
    }

    public function setAddNamedays(bool $addNamedays): Settings
    {
        $this->addNamedays = $addNamedays;
        return $this;
    }

    public function setAddGenders(bool $addGenders): Settings
    {
        $this->addGenders = $addGenders;
        return $this;
    }

    public function setAddSalutions(bool $addSalutions): Settings
    {
        $this->addSalutions = $addSalutions;
        return $this;
    }

    public function setPreserveUnsubscribed(bool $preserveUnsubscribed): Settings
    {
        $this->preserveUnsubscribed = $preserveUnsubscribed;
        return $this;
    }

    public function setSkipInvalidemails(bool $skipInvalidEmails): Settings
    {
        $this->skipInvalidEmails = $skipInvalidEmails;
        return $this;
    }

    public function setConfirmationRequest(?SettingsConfirmationRequest $confirmationRequest): Settings
    {
        $this->confirmationRequest = $confirmationRequest;
        return $this;
    }

}
