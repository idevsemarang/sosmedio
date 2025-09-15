<?php
require_once "DbConfig.php";


class UserController
{

    private $mysqlDb;

    public function __construct()
    {
        $this->mysqlDb = new DbConfig();
    }



    public function countries()
    {
        $sql = "SELECT * FROM `countries`;";

        $countries = $this->mysqlDb->getRows($sql);

        return $countries;
    }


    public function register($bodyRequest)
    {
        $name = $bodyRequest['name'];
        $email = $bodyRequest['email'];
        $countryId = $bodyRequest['country_id'];
        $password = $bodyRequest['password'];

        $password = md5($password);

        $sql = "INSERT INTO users (name, email, country_id, password, created_at)
                VALUES ('" . $name . "', '" . $email . "', '" . $countryId . "', '" . $password . "', now());";

        try {
            $this->mysqlDb->setStatement($sql);

            return [
                'success' => true,
                'alert' => 'success',
                'message' => 'success register, please login with your account',
            ];
        } catch (\Throwable $th) {
            return [
                'success' => false,
                'alert' => 'danger',
                'message' => $th->getMessage(),
            ];
        }
    }



    public function login($bodyRequest)
    {
        $email = $bodyRequest['email'];
        $password = $bodyRequest['password'];

        $password = md5($password);

        $sql = "SELECT id, email, name FROM users WHERE email = '" . $email . "' AND password = '" . $password . "' LIMIT 1;";

        try {
            $users = $this->mysqlDb->getRows($sql);

            if (count($users) > 0) {
                return [
                    'success' => true,
                    'alert' => 'success',
                    'message' => 'success login',
                    'data' => $users[0],
                ];
            } else {
                return [
                    'success' => false,
                    'alert' => 'danger',
                    'message' => 'Username atau password salah',
                ];
            }

        } catch (\Throwable $th) {
            return [
                'success' => false,
                'alert' => 'danger',
                'message' => $th->getMessage(),
            ];
        }
    }
}
