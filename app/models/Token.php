<?php

use \Firebase\JWT\JWT;

class Token extends Base
{

    public $incrementing = false;

    protected $visible = ['id', 'description', 'access_level', 'created_ip', 'current', 'created_at'];
    
    protected $rules = array(
        'create' => [
            'description' => 'required|alpha_space|max_len,100|min_len,1',
            'access_level' => 'required|max_numeric,3|min_numeric,1'
        ]
    );

    protected $appends = [
        'current'
    ];

    /**
     * Get the user who owns the token
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Get the current token attribute (compare with current authenticated user)
     */
    public function getCurrentAttribute()
    {
        $app = \Slim\Slim::getInstance();
        return $this->id == $app->token_id ? true : false; 
    }    

    /**
     * Generate token
     */
    public function generate($user, $description, $access_level)
    {

    $app = \Slim\Slim::getInstance();

    $tokenId = bin2hex(random_bytes(16));
    $issuedAt = time();

    $data = [
        'iat'  => $issuedAt,
        'jti'  => $tokenId,
        'data' => [
            'username' => $user['username'],
            'description' => $description,
            'access_level' => $access_level,
        ]
    ];  

    $jwt = JWT::encode($data, base64_decode($app->jwt_key), 'HS512');    

    return ['id' => $tokenId, 'token' => $jwt];

    }

    public function decode($jwt)
    {
        $app = \Slim\Slim::getInstance();

        try {
            $token = JWT::decode($jwt, base64_decode($app->jwt_key), array('HS512'));
                return $token;

            } catch (Exception $e) {
                return false;
            }
    }

}
