<?php

namespace Tests\Unit;

use Tests\TestCase;

class AppendComment extends TestCase
{
    /**
     * test for appending user comment through form field
     *
     * @return void
     */

    public function test_append_comment_by_user_through_form_field()
    {
        $response = $this->post('user/comment/form', [
            'id' => 1,
            'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB',
            'comment' => 'Hello World'
        ]);

        $response->assertRedirect();
    }

    /**
     * Atest for appending user comment through json
     *
     * @return void
     */

    public function test_append_comment_by_user_through_json_input()
    {
        $response = $this->post('api/user/comment/json', [
            'id' => 1,
            'password' => '720DF6C2482218518FA20FDC52D4DED7ECC043AB',
            'comment' => 'Hello World'
        ]);

        $response->assertStatus(201)->assertJson(['status' => 'success']);
    }

    /**
     *  test for appending user comment through artisan command
     *
     * @return void
     */
    public function test_append_comment_by_user_through_command()
    {
        $this->artisan('append:comments', [
            'id' => 1,
            'comments' => 'Hello world'
        ])->assertExitCode(0);
    }
}
