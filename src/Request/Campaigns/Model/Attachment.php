<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model;

use SmartEmailing\Sdk\ApiV3Client\ToArrayInterface;
use SmartEmailing\Types\Base64String;

final class Attachment implements ToArrayInterface
{

    /**
     * Attachment filename
     *
     * @var string
     */
    private $fileName;

    /**
     * Attachment content type
     *
     * @var string
     */
    private $contentType;

    /**
     * Attachment data, base64 encoded
     *
     * @var \SmartEmailing\Types\Base64String
     */
    private $dataBase64;

    public function __construct(string $fileName, string $contentType, string $dataBase64)
    {
        $this->fileName = $fileName;
        $this->contentType = $contentType;
        $this->dataBase64 = Base64String::from($dataBase64);
    }


    public function toArray(): array
    {
        return [
            'file_name' => $this->fileName,
            'content_type' => $this->contentType,
            'data_base64' => $this->dataBase64->getValue(),
        ];
    }

}
