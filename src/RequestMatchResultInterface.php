<?php
declare(strict_types=1);

namespace N1215\Http\RequestMatcher;

interface RequestMatchResultInterface
{
    public function getParams(): array;

    public function isSuccess(): bool;
}
