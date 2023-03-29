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
    public function testDone()
    {
        $response = $this->get('/done');
        $response->assertStatus(200);
    }
    public function testThanks()
    {
        $response = $this->get('/thanks');
        $response->assertStatus(200);
    }
    public function testMenu2()
    {
        $response = $this->get('/menu2');

        $response->assertViewIs('menu2');
    }

    public function testMenu1()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $response = $this->get('/menu1');

        $response->assertViewIs('menu1');
    }
    public function testreserveadd()
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
    public function testfavoritedel()
    {
        // お気に入りの登録
        $user = User::factory()->create();
        Auth::login($user);
        $favorite = Favorite::factory()->create([
            'user_id' => $user->id,
        ]);
        $this->assertDatabaseHas('favorites', [
            'id' => $favorite->id,
        ]);

        // お気に入りの削除
        $response = $this->actingAs($user)
            ->post('/favoritedel/' . $favorite->shop_id);
        $response->assertRedirect();
        $this->assertDatabaseMissing('favorites', [
            'id' => $favorite->id,
        ]);
    }
    public function testReserve()
    {
        $shop = Shop::factory()->create(); // Shopオブジェクトを生成する
        $response = $this->get('/reserve/' . $shop->id);
        $response->assertStatus(200);
        $response->assertViewIs('reserve');
    }

    public function testReservationChange()
    {
        // テストに必要なユーザーを作成する
        $user = User::factory()->create();
        Auth::login($user);

        // テストに必要な予約を作成する
        $reserve = Reserve::factory()->create([
            'user_id' => $user->id,
        ]);

        // 予約変更のPOSTリクエストを送信する
        $response = $this->post('/reserveedit/' . $reserve->id, [
            'date' => '2023-03-20',
            'time' => '12:00',
            'number' => '2',
        ]);

        // 変更した予約が正しく保存されたことを確認する
        $this->assertDatabaseHas('reserves', [
            'id' => $reserve->id,
            'date' => '2023-03-20',
            'time' => '12:00',
            'number' => '2',
        ]);
    }
    public function testReservedel()
    {
        //テスト用のデータを作成
        $reserve = Reserve::factory()->create();

        //リクエストを送信してデータを削除
        $response = $this->post('/reservedel/' . $reserve->id);

        //削除後にReserveのレコードが0になっているか確認する
        $this->assertCount(0, Reserve::all());

        //正しくリダイレクトされているか確認する
        $response->assertRedirect();
    }
    public function testmypage()
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
    public function testReview()
    {
        $user = User::factory()->create();
        Auth::login($user);
        $shop = Shop::factory()->create();
        $reserve = Reserve::factory()->create([
            'user_id' => $user->id,
            'shop_id' => $shop->id,
        ]);
        $response = $this->post("/review/{$reserve->id}");
        $response->assertOk()
            ->assertViewIs('review')
            ->assertViewHas('shop', $shop)
            ->assertViewHas('reserve', $reserve->id);
    }

    public function testReviewAdd()
    {
        $user = User::factory()->create();
        Auth::login($user);
        // テスト用のデータを用意
        $reserve = Reserve::factory()->create();

        // テスト実行
        $response = $this->post('/reviewadd', [
            'evaluation' => 3,
            'review' => 'test review.',
            'reserve_id' => $reserve->id
        ]);

        // テスト結果の確認

        $this->assertDatabaseHas('histories', [
            'reserve_id' => $reserve->id,
            'evaluation' => 3,
            'review' => 'test review.',
        ]);
    }

    public function testUserlist()
    {
        $response = $this->get('/userlist'); // GETリクエストを送信
        $response->assertStatus(302); // リダイレクトが行われることを確認

        $user = User::factory()->create(); // テスト用ユーザーを作成
        $user->role = 2; // ロールを管理者に変更
        $user->save();

        $response = $this->actingAs($user)->get('/userlist'); // ログインした状態でGETリクエストを送信
        $response->assertOk(); // ステータスコードが200であることを確認
        $response->assertViewIs('userlist'); // userlistビューが返されたことを確認
        $response->assertViewHas('users', function ($users) use ($user) { // users変数が含まれ、その中にテスト用ユーザーが存在することを確認
            return $users->contains($user);
        });
    }

    public function testAuthorityDelMethod()
    {
        // テストに必要なレコードを作成する
        $user = User::factory()->create(['role' => 1]);
        $shop = Shop::factory()->create();
        $reserve = Reserve::factory()->create(['shop_id' => $shop->id, 'user_id' => $user->id]);

        // 管理者でログインする
        $admin = User::factory()->create(['role' => 2]);
        $this->actingAs($admin);

        // テスト対象のメソッドを実行する
        $response = $this->post('/authoritydel/' . $user->id);

        // メソッドの実行後、権限が削除されていることを確認する
        $this->assertEquals(0, User::find($user->id)->role);
    }
    public function test_shopmanagement()
    {
        $admin = User::factory()->create(['role' => 2]);
        $this->actingAs($admin);
        $response = $this->get('/shopmanagement');
        $response->assertStatus(200);
    }

    public function testShopEdit()
    {
        $shop = Shop::factory()->create();

        $response = $this->post("/shopedit/{$shop->id}", [
            'shop' => 'edited shop name',
            'img' => 'edited_shop_img.jpg',
            'area' => 'edited area',
            'genre' => 'edited genre',
            'introduction' => 'edited introduction',
        ]);

        $response->assertStatus(302); // redirect status code
        $response->assertRedirect('/shopmanagement'); // redirect to /shopmanagement route

        // check if shop data is updated
        $this->assertDatabaseHas('shops', [
            'id' => $shop->id,
            'shop' => 'edited shop name',
            'img' => 'edited_shop_img.jpg',
            'area' => 'edited area',
            'genre' => 'edited genre',
            'introduction' => 'edited introduction',
        ]);
    }









}

//php artisan test