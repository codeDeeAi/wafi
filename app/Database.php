<?php

declare(strict_types=1);

namespace App;

class Database
{
    // protected array $user_and_accounts = [];
    
    public function __construct()
    {
        $this->user_and_accounts = (is_array($this->retrieveData())) ? $this->retrieveData() : [];
    }

    /**
     * Cache Database 
     * @return bool
     */
    protected function cacheData(): bool
    {
        $storeData = array_merge($this->retrieveData(), $this->user_and_accounts);
        $data = json_encode($storeData);
        fwrite(fopen("cache.txt", "w"), $data);
        return true;
    }

    /**
     * Cache Database from cache
     * @return bool
     */
    protected function retrieveData()
    {
        $data = file_get_contents('cache.txt');
        return json_decode($data, true);
    }

    /**
     * Returns all records
     * @return array all records
     */
    public function getData(): array
    {
        return $this->user_and_accounts;
    }

    /**
     * Create new user
     * @param string User name - unique
     * @param float Balance (optional: defaults to 0)
     * @return bool 
     */
    public function createUser(string $name, float $balance = 0): bool
    {
        if (array_key_exists($name, $this->user_and_accounts)) {
            return false; // user exists
        } else {
            $this->user_and_accounts[$name] = $balance;
            $this->cacheData();
            return true;
        }
    }

    /**
     * Check if user exists
     * @param string User name - unique
     * @return bool 
     */
    public function checkUserExists(string $name): bool
    {
        if (array_key_exists($name, $this->user_and_accounts)) {
            return true; // user exists
        } else {
            return false;
        }
    }

    /**
     * Deposit / Add to user balance
     * @param string User name - unique
     * @param float amount deposited
     * @return bool 
     */
    public function depositAmountToBalance(string $name, float $amount): bool
    {
        if ($this->checkUserExists($name)) {
            $this->user_and_accounts[$name] += $amount; 
            $this->cacheData();
            return true; // Balance added to user 
        } else {
            return false;
        }
    }

    /**
     * Check if user balance
     * @param string User name - unique
     * @param float check amount
     * @return bool 
     */
    public function checkUserHasSufficientBalance(string $name, float $check_amount): bool
    {
        if ($this->user_and_accounts[$name] >= $check_amount) {
            return true; // Balance is sufficient
        } else {
            return false;
        }
    }


    /**
     * Transfer balance from one user to the other
     * @param string Sender name - unique
     * @param string Reciever name - unique
     * @param float Transfer Amount
     * @return bool 
     */
    public function transferBalance(string $sender, string $reciever, float $amount = 0): bool
    {
        if ($this->checkUserHasSufficientBalance($sender, $amount)) {
            $this->user_and_accounts[$sender] -= $amount;
            $this->user_and_accounts[$reciever] += $amount;
            $this->cacheData();

            return true; // Transaction successfull

        } else {

            return false;
        }
    }

    /**
     * Return user and balance
     * @param string user name - unique
     * @return array 
     */
    public function getUserAndBalance(string $user): array
    {
        if ($this->checkUserExists($user)) {

            return ['status' => true, 'name' => $user, 'balance' => $this->user_and_accounts[$user]];
        } else {

            return ['status' => false, 'error' => 'Error fetching user balance !'];
        }
    }
}
