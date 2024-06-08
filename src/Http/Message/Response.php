<?php

namespace Webdevcave\Pharkus\Http\Message;

class Response
{
    private object|null $entity = null;
    private array $headers = [];
    private ResponseStatus $status = ResponseStatus::OK;

    /**
     * @return static
     */
    public static function create(): static
    {
        return new static();
    }

    /**
     * @return $this
     */
    public function clearHeaders(): static
    {
        $this->headers = [];
        return $this;
    }

    /**
     * @param object|array|null $entity
     * @return $this
     */
    public function entity(object|array|null $entity): static
    {
        $this->entity = (object) $entity;
        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     * @return $this
     */
    public function header(string $name, string $value): static
    {
        $this->headers[$name] = $value;
        return $this;
    }

    /**
     * @param ResponseStatus $status
     * @return $this
     */
    public function status(ResponseStatus $status): static
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return object|null
     */
    public function getEntity(): ?object
    {
        return $this->entity;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return ResponseStatus
     */
    public function getStatus(): ResponseStatus
    {
        return $this->status;
    }
}
