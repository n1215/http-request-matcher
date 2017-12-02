<?php
declare(strict_types=1);

namespace N1215\Http\RequestMatcher;

use Psr\Http\Message\ServerRequestInterface;

interface ServerRequestMatcherInterface
{
    public function match(ServerRequestInterface $request): RequestMatchResultInterface;
}
