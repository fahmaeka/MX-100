<?php


class EnableFreelanceToSubmitProposalToJobPostCest
{
    public function _before(ApiTester $I)
    {
    }

    public function _after(ApiTester $I)
    {
    }

    /* 
     * Freelancer provide budget and completion date estimation on proposal they submit 
     * */
    public function FreelancerProvideBudgetAndCompletionDateEstimationOnProposalTheySubmit(\ApiTester $I)
    {
        $I->sendPOST('/proposal?api_token=37487901e58bfa91e593bc5c93201bcb9478f3c8', 
        ['jobs_code' => 'JOB/3/07/08/2018/CAM', 'provide_budget' => '100000', 'completion_date_estimation' => '17-08-2018']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    }

    /*
     * Freelancer can only submit one proposal to any published job 
     * */
    public function FreelancerCanOnlySubmitOneProposalToAnyPublishedJob(\ApiTester $I)
    {
        $I->sendPOST('/proposal?api_token=37487901e58bfa91e593bc5c93201bcb9478f3c8', 
        ['jobs_code' => 'JOB/3/07/08/2018/CAM', 'provide_budget' => '100000', 'completion_date_estimation' => '17-08-2018']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::NOT_FOUND);
    }

    /*
    * Each application submitted by freelancer will reduce the proposal space by 2pts, 
    * so the rank B freelancer can only submit 10times max and rank A can submit 20times max 
    * */
    public function balanceFreelancerMaxSubmit(\ApiTester $I)
    {
        $I->sendPOST('/proposal?api_token=2f6125b02174f2d87c124f4b28f7a57a006f1599', 
        ['jobs_code' => 'JOB/3/07/08/2018/CAM', 'provide_budget' => '100000', 'completion_date_estimation' => '17-08-2018']);
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CONFLICT);
    }
    
}
