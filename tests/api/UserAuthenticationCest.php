<?php


class UserAuthenticationCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    /** check exsiting API */
    public function visitApi(\ApiTester $I)
    {
        $I->sendGET('/');
        $I->seeResponseContains('{"success":true,"result":"Hello MX100"}');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    }

    /** User authentication */
    public function freelancerAuthenticationReadDataJobsWithOutToken(\ApiTester $I)
    {
        $I->sendGET('/user/4');
        $I->seeResponseContains('{"success":false,"message":"Login please!"}');
    }

    public function readDataJobsWithTokenExpired(\ApiTester $I)
    {
        $I->sendGET('/user/4?api_token=5d1588ffe391c5bb1596c8e7dcce937759c939a62xxxxxx');
        $I->seeResponseContains('{"success":false,"message":"Permission not allowed!"}');
    }

    public function readDataJobsWithToken(\ApiTester $I)
    {
        $I->sendGET('/user/4?api_token=bf18fb39b0b77ada7428921136f6ef05fdd9220b');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    }
    
}
