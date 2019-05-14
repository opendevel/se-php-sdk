<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns;

use SmartEmailing\Sdk\ApiV3Client\ApiRequestInterface;
use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\SenderCredentials;
use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Task;

final class SendCustomEmailsBulkRequest implements ApiRequestInterface
{

    /**
     * @var string
     */
    protected static $method = 'POST';

    /**
     * @var string
     */
    protected static $endpoint = 'send/custom-emails-bulk';

    /**
     * Sender's credentials for this request
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\SenderCredentials
     */
    private $sender_credentials;

    /**
     * Tag used for email grouping
     *
     * @var string
     */
    private $tag;

    /**
     * Id of E-mail or E-mail template to send.
     * All dynamic fields in E-mail will be customized per contact.
     *
     * @var int
     */
    private $email_id;

    /**
     * Array of sending tasks, one per recipient.
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Task[]
     */
    private $tasks = [];

    public function __construct(SenderCredentials $sender_credentials, string $tag, int $email_id)
    {
        $this->sender_credentials = $sender_credentials;
        $this->tag = $tag;
        $this->email_id = $email_id;
    }


    public static function getHttpMethod(): string
    {
        return self::$method;
    }

    public function getEndpoint(): string
    {
        return self::$endpoint;
    }

    public function toArray(): array
    {
        return [
            'sender_credentials' => $this->sender_credentials->toArray(),
            'tag' => $this->tag,
            'email_id' => $this->email_id,
            'tasks' => $this->toArrayTasks(),
        ];
    }

    public function addTask(Task $task): void
    {
        $this->tasks[] = $task;
    }

    private function toArrayTasks(): array
    {
        $return = [];

        /** @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Task $task */
        foreach ($this->tasks as $task) {
            $return[] = $task->toArray();
        }

        return $return;
    }

}
