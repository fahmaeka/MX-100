<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------


* User Requirement
| Freelancer provide budget and completion date estimation on proposal they submit
| Freelancer can only submit one proposal to any published job
| Each application submitted by freelancer will reduce the proposal space by 2pts, so the rank B freelancer can only submit 10times max and rank A can submit 20times max
| Employer can view proposal from freelancer for their job post
|
*/

$app->get('/', function () use ($app) {
  $res['success'] = true;
  $res['result'] = "Hello MX100";
  return response($res);
});

$app->post('/login', 'LoginController@index');
$app->post('/register-freelance', 'UserController@registerFreelancer');
$app->post('/register-company', 'UserController@registerCompany');
$app->get('/user/{id}', ['middleware' => 'auth', 'uses' =>  'UserController@index']);


$app->group(['prefix' => '/proposal'], 
  function ($app) 
  {
    $app->get('/', 'ProposalController@index');
    $app->post('/', 'ProposalController@store');
    $app->get('/{id}', [
      'as' => 'authors.show',
      'uses' => 'ProposalController@show'
    ]);
  }
);

