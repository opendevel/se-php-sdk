<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;

class Task implements ToArrayInterface
{

    /**
     * Single recipient's data. New contact will be created if it does not exist yet.
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Recipient
     */
    private $recipient;

    /**
     * Multidimensional JSON structure which will be merged into contact-specific data
     * before passing them to template renderer.
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\TemplateVariable[]
     */
    private $templateVariables = [];

    /**
     * Task constructor.
     * @param \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Recipient $recipient
     */
    public function __construct(Recipient $recipient)
    {
        $this->recipient = $recipient;
    }

    public function toArray(): array
    {
        $return['recipient'] = $this->recipient->toArray();

        /** @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\TemplateVariable $templateVariable */
        foreach ($this->templateVariables as $templateVariable) {
            $return['template_variables'][$templateVariable->getKey()] = $templateVariable->getValue();
        }

        return $return;
    }

    public function addTemplateVariable(string $key, $value): void
    {
        $templateVariable = new TemplateVariable($key, $value);
        $this->templateVariables[] = $templateVariable;
    }

}
