<?php

namespace AS2;

use Psr\Log\{LoggerInterface, NullLogger};

trait LoggerTrait
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var null|string
     */
    protected $prefix;

    /**
     * @param string $prefix
     */
    protected function setPrefix(string $prefix)
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return null|string
     */
    protected function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param mixed[] $context
     *
     * @return string
     */
    protected function log($level, string $message, array $context = [])
    {
        if ($this->getPrefix() !== null) {
            $message = sprintf('%s - %s', $this->getPrefix(), $message);
        }

        return $this->getLogger()->log($level, $message, $context);
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        if (!$this->logger) {
            $this->logger = new NullLogger();
        }

        return $this->logger;
    }

    /**
     * @return $this
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }
}
