<?php
declare(strict_types=1);

namespace N1215\Http\RequestMatcher;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Uri;

class RequestMatcherTest extends TestCase
{
    /**
     * @param bool $expectedIsSuccess
     * @param array $expectedParams
     * @param string $path
     * @param string $method
     *
     * @dataProvider dataProvider_requests
     */
    public function test(bool $expectedIsSuccess, array $expectedParams, string $path, string $method)
    {
        $matcher = new SampleMethodAndPathMatcher();

        $request = new ServerRequest([], [], new Uri($path), $method);
        $result = $matcher->match($request);
        $this->assertEquals($expectedIsSuccess, $result->isSuccess());
        $this->assertEquals($expectedParams, $result->getParams());

    }

    public function dataProvider_requests(): array
    {
        return [
            [true,  ['resource_name' => 'posts', 'id' =>'12345'], '/resources/posts/12345', 'GET'],
            [false, [], '/resources/posts/fuga', 'GET'],
            [false, [], '/resources/posts/12345', 'POST'],
        ];
    }
}

class SampleMethodAndPathMatcher implements RequestMatcherInterface {

    /** @var string */
    private $method = 'GET';

    /** @var string */
    private $pathRegex = '|/resources/(?<resource_name>[a-z_]+)/(?<id>[0-9]+)|';

    public function match(RequestInterface $request): RequestMatchResultInterface
    {
        if (strtolower($this->method) !== strtolower($request->getMethod())) {
            return RequestMatchResult::failure();
        }

        if (!preg_match($this->pathRegex, $request->getUri()->getPath(), $matches)) {
            return RequestMatchResult::failure();
        }

        $params = array_filter($matches, function($key) {
            return is_string($key);
        }, ARRAY_FILTER_USE_KEY);

        return RequestMatchResult::success($params);
    }
}
