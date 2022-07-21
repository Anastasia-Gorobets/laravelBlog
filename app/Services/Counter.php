<?php
namespace App\Services;


use Illuminate\Support\Facades\Cache;

class Counter{

    private $timeout;
    public function __construct($timeout)
    {
        $this->timeout = $timeout;
    }

    public  function  increment(string $key, array $tags) :int{

        $sessionId = session()->getId();
        $counterKey = "$key-counter";
        $usersKey = "$key-users";

        $users = Cache::tags($tags)->get($usersKey, []);
        $usersUpdate = [];
        $diffrence = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= $this->timeout) {
                $diffrence--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if(
            !array_key_exists($sessionId, $users)
            || $now->diffInMinutes($users[$sessionId]) >= $this->timeout
        ) {
            $diffrence++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::tags($tags)->forever($usersKey, $usersUpdate);

        if (!Cache::tags($tags)->has($counterKey)) {
            Cache::tags($tags)->forever($counterKey, 1);
        } else {
            Cache::tags($tags)->increment($counterKey, $diffrence);
        }

        return Cache::tags($tags)->get($counterKey);

    }



}
