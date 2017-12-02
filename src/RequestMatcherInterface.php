<?php
declare(strict_types=1);

namespace N1215\Http\RequestMatcher;

use Psr\Http\Message\RequestInterface;

interface RequestMatcherInterface
{
    public function match(RequestInterface $request): RequestMatchResultInterface;
}
