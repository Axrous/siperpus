<?php

namespace axrous\siperpus\App;

use PHPUnit\Framework\TestCase;

class ViewTest extends TestCase {

    public function testView() {
        View::render('/Home/index', [
            "title" => 'Login'
        ]);

        $this->expectOutputRegex('[Login]');
        $this->expectOutputRegex('[Welcome Back]');
        $this->expectOutputRegex('[Sign In]');
    }
}