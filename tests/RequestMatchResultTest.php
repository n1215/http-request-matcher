<?php
declare(strict_types=1);

namespace N1215\Http\RequestMatcher;

use PHPUnit\Framework\TestCase;

class RequestMatchResultTest extends TestCase
{
    public function test_success()
    {
        $params = [
            'hoge' => 'fuga',
            'test' => 12345,
        ];
        $result = RequestMatchResult::success($params);

        $this->assertTrue($result->isSuccess());
        $this->assertEquals($params, $result->getParams());
    }

    public function test_failure()
    {
        $result = RequestMatchResult::failure();

        $this->assertFalse($result->isSuccess());
    }
}
