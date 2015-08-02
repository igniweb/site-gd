<?php

class ExampleTest extends TestCase
{
    /**
     * Test homepage.
     *
     * @return void
     */
    public function testHomePage()
    {
        $this->visit('/')->see('Sandbox');
    }

    /**
     * Test model factories.
     *
     * @return void
     */
    public function testModelFactories()
    {
        $user = factory('App\Models\User')->make();
        var_dump($user->toArray());
    }
}
