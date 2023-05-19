<?php

namespace App\Api;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     description="API response model",
 *     title="API Response",
 * )
 */
class ApiResponse {
    private $message;
    private $success;

    /**
     * @OA\Property(type="object", nullable=true)
     */
    private $data;

    public function __construct(bool $success = false, $data = null, ?string $message = null)
    {
        $this->message = $message;
        $this->data = $data;
        $this->success = $success;
    }

    public function getMessage(): ?string {
        return $this->message;
    }

    public function getSuccess(): bool {
        return $this->success;
    }

    public function getData() {
        return $this->data;
    }

    public function setMessage(string $message): self {
        $this->message = $message;
        return $this;
    }

    public function setSuccess(bool $success): self {
        $this->success = $success;
        return $this;
    }

    public function setData($data): self {
        $this->data = $data;
        return $this;
    }
}