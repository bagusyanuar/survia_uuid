<?php


namespace App\Http\Controllers;


use App\Helper\CustomController;
use App\Helper\ValidationRules;
use App\Models\User;
use App\Scopes\MemberScope;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends CustomController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function admin_sign_in()
    {
        DB::beginTransaction();
        try {
            $username = $this->postField('username');
            $password = $this->postField('password');
            $user = User::roleAdmin($username)->activeAdmin()->first();
            if (!$user) {
                return $this->jsonNotFoundResponse('user account not found!');
            }

            $is_password_valid = Hash::check($password, $user->password);
            if (!$is_password_valid) {
                return $this->jsonAcceptedResponse('password did not match');
            }

            $access_token = $this->generateTokenById($user->id, 'admin');
            DB::commit();
            return $this->jsonSuccessResponse('success', [
                'access_token' => $access_token,
                'token_type' => 'bearer'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->jsonErrorResponse($e->getMessage());
        }
    }
}
