<?php

namespace Tests\Feature;

use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_get_tasks(): void
    {
        $response = $this->get('/api/tasks');
        $response->assertStatus(200);    
    }
    
    public function test_creat_task(): void
    {
        $response = $this->post('/api/tasks', ['title' => 'test', 'description' => 'description', 'status' => 'activ']);
        $response->assertStatus(201);
    }    
    
    public function test_get_task_id(): void
    {
        $response = $this->get('/api/tasks');
        $response->assertStatus(200);    
    }
    
    public function test_update_task(): void
    {
        $response = $this->put('/api/tasks', ['id' => 6, 'title' => 'test', 'description' => 'description', 'status' => 'activ']);
        $response->assertStatus(200);
    }        
    
    public function test_delete_task(): void
    {
        $response = $this->delete('/api/tasks/5');
        $response->assertStatus(204);    
    }        
}
