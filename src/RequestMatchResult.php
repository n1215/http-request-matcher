<?php
declare(strict_types=1);

namespace N1215\Http\RequestMatcher;

final class RequestMatchResult implements RequestMatchResultInterface
{
    /** @var bool */
    private $isSuccess;

    /** @var array */
    private $params;

    private function __construct(bool $isSuccess, array $params = [])
    {
        $this->isSuccess = $isSuccess;
        $this->params = $params;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public static function success(array $params): self
    {
        return new self(true, $params);
    }

    public static function failure(): self
    {
        return new self(false);
    }
}
