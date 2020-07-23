<?php

declare(strict_types=1);

namespace App\Xielei\Manual\Middleware;

use Ebcms\StreamFactory;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class PowerBy implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        $response = $handler->handle($request);
        if ($response->getStatusCode() == 200) {
            $insert = <<<'str'
<center style="margin-top:15px;margin-bottom:15px;">
<small style="color:gray;">由开源系统 <a href="https://github.com/xielei/manual" target="_blank" style="color:gray;font-weight:bold;">xielei/manual</a> 构建</small>
</center>
str;
            $contents = str_replace('</body>', $insert . '</body>', $response->getBody());
            return $response->withBody((new StreamFactory())->createStream($contents));
        } else {
            return $response;
        }
    }
}
