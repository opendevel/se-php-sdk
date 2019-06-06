<?php declare(strict_types = 1);

namespace SmartEmailing\Sdk\ApiV3Client\Request\Campaigns;

use SmartEmailing\Sdk\ApiV3Client\ApiRequestInterface;
use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\SenderCredentials;
use SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Task;

final class SendTransactionalEmailsBulkRequest implements ApiRequestInterface
{

    /**
     * @var string
     */
    protected static $method = 'POST';

    /**
     * @var string
     */
    protected static $endpoint = 'send/transactional-emails-bulk';

    /**
     * Sender's credentials for this request
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\SenderCredentials
     */
    private $senderCredentials;

    /**
     * Tag used for email grouping
     *
     * @var string
     */
    private $tag;

    /**
     * Id of E-mail or E-mail template to send.
     *
     * @var int
     */
    private $emailId;

    /**
     * Array of sending tasks, one per recipient.
     *
     * @var \SmartEmailing\Sdk\ApiV3Client\Request\Campaigns\Model\Task[]
     */
    private $tasks = [];

    public function __construct(SenderCredentials $senderCredentials, string $tag, int $emailId)
    {
        $this->senderCredentials = $senderCredentials;
        $this->tag = $tag;
        $this->emailId = $emailId;
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
            'sender_credentials' => $this->senderCredentials->toArray(),
            'tag' => $this->tag,
            'email_id' => $this->emailId,
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
