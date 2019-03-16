<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Role;
use App\Group;
use App\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
  use RefreshDatabase;

  protected $user;

  public function setUp()
  {
    parent::setUp(); // TODO: Change the autogenerated stub
    $this->user = factory('App\User')->create();
    $this->actingAs($this->user);
  }

  /** @test **/

  public function admin_can_create_user()
  {
    $this->create_and_assing_role('Admin');
    $roles = factory(Role::class,2)->create();
    $groups= factory(Group::class,2)->create();
    $this->post('user',[
      'name' => 'Test User',
      'email' => 'test@gmail.com',
      'password' => '123456',
      'password_confirmation'=>'123456',
      'roles' => $roles->pluck('id')->toArray(),
      'groups'=> $groups->pluck('id')->toArray(),
    ]);
    $this->assertDatabaseHas('users',['name'=>'Test User']);
  }

  /** @test **/

  public function admin_can_update_user_date()
  {
    $this->create_and_assing_role('Admin');
    $user = factory(User::class)->create();
    $roles = factory(Role::class,2)->create();
    $groups= factory(Group::class,2)->create();
    $this->put('user/'.$user->id,[
      'name' => 'Test update user',
      'email' => 'test@gmail.com',
      'roles' => $roles->pluck('id')->toArray(),
      'groups'=> $groups->pluck('id')->toArray(),
    ]);
    $this->assertDatabaseHas('users',['name'=>'Test update user']);
  }

  /** @test **/

  public function admin_can_delete_user()
  {
    $this->create_and_assing_role('Admin');
    $user = factory(User::class)->create();
    $this->delete('user/'.$user->id);
    $this->assertDatabaseMissing('users', ['deleted_at' => null, 'id' => $user->id]);

  }

  /** @test **/

  public function a_user_can_not_view_users()
  {
    $this->create_and_assing_role('Viewer');
    $this->get('/user')->assertStatus(404);
  }

  /** @test **/

  public function guests_can_not_view_users()
  {
    \Auth::logout();
    $this->get('/user')->assertLocation('/');
  }

  public function create_and_assing_role($role)
  {
    $role  = factory('App\Role')->create(['name' => $role]);
    $this->user->assignRoles($role->id);
  }


}