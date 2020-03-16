<?php

namespace Models;

class UserModel extends Model
{
    /**
     * Alle User ermitteln
     *
     * @return array
     */
    public function getAllUsers(): array
    {
        return $this->db->exec('SELECT * FROM users');
    }

    /**
     * Einen einzelnen User ermitteln
     *
     * @param string $userName
     * @return array
     */
    public function getUserName(string $userName): array
    {
        $userName = $this->db->exec('SELECT * FROM users WHERE username=?', $userName);

        // if (count($user) === 0) {
        //     return [];
        // }

        // return $user[0];
        return $userName;
    }


    /**
     * Einen einzelnen User ermitteln
     *
     * @param string $userEmail
     * @return array
     */
    public function getUserEmail(string $userEmail): array
    {
        $userEmail = $this->db->exec('SELECT * FROM users WHERE email=?', $userEmail);

        // if (count($user) === 0) {
        //     return [];
        // }

        // return $user[0];
        return $userEmail;
    }


    /**
     * Einen einzelnen User ermitteln
     *
     * @param string $userPassword
     * @return array
     */
    public function getUserPassword(string $userPassword): array
    {
        $userPassword = $this->db->exec('SELECT * FROM users WHERE password=?', $userPassword);

        // if (count($user) === 0) {
        //     return [];
        // }

        // return $user[0];

        return $userPassword;
    }


    /**
     * Returns 0 if user data doesn´t exist and 1 if exists/is correct 
     *
     * @param string $userName
     * @param string $userPassword
     * 
     */
    public function getUserCredentials(string $userName, string $userPassword)
    {
        $userCredentials = $this->db->exec('SELECT * FROM users WHERE username=? AND password=?', [$userName, $userPassword]);
        if ($this->db->count() == 0)
            return false;

        return $userCredentials;
    }






    public function storeUser(string $username, string $password, string $email, string $vkey): bool
    {
        $isStored = $this->db->exec('INSERT INTO users (username, password, email, vkey)
                                    VALUES(?, ?, ?, ?)', [$username, $password, $email, $vkey]);
        return $isStored;
    }



    public function lastInsertedId()
    {
        return $this->db->pdo()->lastInsertId();
    }
}
