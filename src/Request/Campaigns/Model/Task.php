<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;

final class Task implements ToArrayInterface
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
     * E-mail's attachments.
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Attachment[]
     */
    private $attachments = [];

    /**
     * Task constructor.
     * @param \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Recipient $recipient
     */
    public function __construct(Recipient $recipient)
    {
        $this->recipient = $recipient;
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        $return['recipient'] = $this->recipient->toArray();

        /** @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\TemplateVariable $templateVariable */
        foreach ($this->templateVariables as $templateVariable) {
            $return['template_variables'][$templateVariable->getKey()] = $templateVariable->getValue();
        }

        /** @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Attachment $attachment */
        foreach ($this->attachments as $attachment) {
            $return['attachments'][] = $attachment->toArray();
        }

        return $return;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function addTemplateVariable(string $key, $value): void
    {
        $this->templateVariables[] = new TemplateVariable($key, $value);
    }

    public function addAttachment(string $fileName, string $contentType, string $dataBase64): void
    {
        $this->attachments[] = new Attachment($fileName, $contentType, $dataBase64);
    }

}
