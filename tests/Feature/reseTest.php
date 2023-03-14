<?php

namespace Tests\Feature;

use App\Models\Shop;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Reserve;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\History;
use App\Models\Favorite;

class ShopControllerTest extends TestCase
{
    use RefreshDatabase;


    public function testIndex()
    {
        $shop = Shop::create([
            'shop' => 'test_shop',
            'area' => 'test_area',
            'genre' => 'test_genre',
            'introduction' => 'test_introduction',
        ]);

        $response = $this->get('/');

        $response->assertOk()
            ->assertViewIs('index')
            ->assertViewHas('shops')
            ->assertSee($shop->shop)
            ->assertSee($shop->area)
            ->assertSee($shop->genre);
    }


    public function test_reserveadd_method_can_create_a_reserve()
    {
        // テストユーザーの作成
        $user = new User([
            'name' => 'testuser',
            'email' => 'testuser@example.com',
            'password' => 'password'
        ]);
        $user->save();

        // テストショップの作成
        $shop = new Shop([
            'shop' => 'testshop',
            'area' => 'testarea',
            'genre' => 'testgenre',
            'introduction' => 'introduction'
        ]);
        $shop->save();

        // テストリクエストの作成
        $request = new \Illuminate\Http\Request();
        $request->setMethod('POST');
        $request->request->add([
            'shop_id' => $shop->id,
            'date' => '2023-03-20',
            'time' => '18:00',
            'number' => '2',
        ]);

        // リクエストを送信
        $response = $this->actingAs($user)->post('/reserveadd', $request->all());

        // データベースに予約が保存されたことを確認
        $this->assertDatabaseHas('reserves', [
            'user_id' => $user->id,
            'shop_id' => $shop->id,
            'date' => '2023-03-20',
            'time' => '18:00',
            'number' => '2',
        ]);

        // リダイレクトされたことを確認
        $response->assertRedirect('done');
    }



    public function test_mypage()
    {
        // テストに必要なデータを用意する
        $user = User::factory()->create();
        $this->actingAs($user);

        // テストを実行する
        $response = $this->get('/mypage');

        // テスト結果のアサーション
        $response->assertStatus(200);
        $response->assertViewIs('mypage');
        $response->assertSee($user->name);
    }
}
