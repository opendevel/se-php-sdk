<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Response;

class BaseResponse
{

    /**
     * Response status shortcode
     *
     * @var string|null
     */
    protected $status = null;

    /**
     * Response status message
     *
     * @var string|null
     */
    protected $message = null;

    /**
     * Response meta
     *
     * @var array
     */
    protected $meta = [];

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }

}
