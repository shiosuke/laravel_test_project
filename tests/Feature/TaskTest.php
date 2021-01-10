<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Carbon\Carbon;
use App\Http\Requests\CreateTask;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    // テストケースごとにDatabaseをリフレッシュしてマイグレーションを再実行する
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed('FoldersTableSeeder');
    }

    /**
     * @test
     */
    public function due_date_should_be_date()
    {
        $response = $this->post('folders/1/tasks/create', [
            'title' => 'sample task',
            'due_date' => 123,
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には日付を入力して下さい。'
        ]);
    }

    /**
     * @test
     */
    public function due_date_should_not_be_past()
    {
        $response = $this->post('folders/1/tasks/create', [
            'title' => 'sample task',
            'due_date' => Carbon::yesterday()->format('Y/m/d'),
        ]);

        $response->assertSessionHasErrors([
            'due_date' => '期限日 には今日以降の日付を入力して下さい。'
        ]);
    }
}
