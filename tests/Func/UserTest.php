<?php

declare(strict_types=1);

namespace App\Tests\Func;

use Symfony\Component\HttpFoundation\Request;

class UserTest extends AbstractEndPoint
{

    public function testGetUsers(): void
    {
        dd($this->testGetResponseFromRequest(Request::METHOD_GET, '/api/users'));
    }
}
