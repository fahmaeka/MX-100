<?php


class EnableCompanyToViewProposalForTheirJobPostCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    /** Employer can view proposal from freelancer for their job post */
    public function employerViewProposalFromFreelancerForTheirJobPost(\ApiTester $I)
    {
        $I->sendGET('/proposal?jobs_code=JOB/3/07/08/2018/CAM');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    }

    public function negativeCaseEmployerViewProposalFromCode(\ApiTester $I)
    {
        $I->sendGET('/proposal?jobs_code=JOB/3/07/08/2018/CAMM');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::NOT_FOUND);
    }
    
}
