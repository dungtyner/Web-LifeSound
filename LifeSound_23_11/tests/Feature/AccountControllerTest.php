<?php

namespace Tests\Feature;

use App\Models\Account;
use App\Http\Controllers\AccountController;
use Tests\TestCase;

use Mockery;

class AccountControllerTest extends TestCase
{

    /**
     * Test the testIndexRedirectsToHomePageIfNotLoggedInSuccess method.
     *
     * @return void
     */
    public function testIndexRedirectsToHomePageIfNotLoggedInSuccess()
    {
        $response = $this->get('/account/profile');
        $response->assertRedirect('/');
    }

    /**
     * Test the testIndexReturnsAccountProfileIfNotLoggedInSuccess method.
     *
     * @return void
     */
    public function testIndexReturnsAccountProfileIfNotLoggedInSuccess()
    {
        $mockedAccount = Mockery::mock('alias:App\Models\Account');
        $mockedAccount->shouldReceive('where->get')->andReturn(collect([['id_account' => 1]]));

        $controller = new AccountController($mockedAccount);
        $response = $controller->index();

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals('http://localhost', $response->getTargetUrl());
        $this->assertEquals(302, $response->getStatusCode());
    }

    /**
     * Test the signIn method.
     *
     * @return void
     */
    public function testSignIn()
    {
        $response = $this->get('/account/signin');
        $response->assertStatus(200);
        $response->assertViewIs('account.signIn');
    }

    /**
     * A basic feature test testHandleSignInFail.
     *
     * @return void
     */
    public function testHandleSignInFail()
    {
        $response = $this->post('/account/signin', [
            'email' => 'example@example.com',
            'password' => 'valid_password',
        ]);
        $response->assertJson(['account' => null]);

        $this->assertIsObject(json_decode($response->getContent()));
        $this->assertObjectHasProperty('account', json_decode($response->getContent()));
        $this->assertNull(json_decode($response->getContent())->account);
    }

    /**
     * A basic feature test testHandleSignInSuccess.
     *
     * @return void
     */
    public function testHandleSignInSuccess()
    {
        $response = $this->post('/account/signin', [
            'email' => 'dunglm.21it@vku.udn.vn',
            'password' => 'soaika1810',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'account' => true,
                'validateErrors' => false,
            ]);
    }

    /**
     * Test getEmailAccount_withIDAccount method with valid IDAccount.
     *
     * @return void
     */
    public function testGetEmailAccountWithValidID()
    {
        $resultWhereJson = Account::where('id_account','=',1)->get();
        $resultGetEmail = (new AccountController())->getEmailAccount_withIDAccount(1);

        $resultWhere = json_decode($resultWhereJson)[0];

        $this->assertEquals($resultWhere->email, $resultGetEmail);
    }

    /**
     * Test handleCheckLoginEd when logged in.
     *
     * @return void
     */
    public function testHandleCheckLoginEdWhenNotLoggedIn()
    {
        $response = (new AccountController())->handleCheckLoginEd();

        $responseData = $response->original;

        $this->assertFalse($responseData['account']);
        $this->assertEquals('', $responseData['avt_url']);
        $this->assertEquals('', $responseData['name_customer']);
    }

     /**
     * A basic feature test testLoadChatWhenNotLoggedIn.
     *
     * @return void
     */
    public function testLoadChatWhenNotLoggedIn()
    {
        $controller = new AccountController();
        $response = $controller->loadChat();

        $this->assertInstanceOf(\Illuminate\Http\RedirectResponse::class, $response);
        $this->assertEquals('http://localhost', $response->getTargetUrl());
    }

}
