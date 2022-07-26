<?php
namespace App\Services;


//use Illuminate\Support\Facades\Cache;

use App\Contracts\CounterContract;
use Illuminate\Contracts\Cache\Factory as Cache;
use Illuminate\Contracts\Session\Session;

class Counter implements CounterContract {

    private $timeout;
    private $cache;
    private $session;
    private $supportTags;

    public function __construct(Cache $cache, Session $session,$timeout)
    {
        $this->cache = $cache;
        $this->session = $session;
        $this->timeout = $timeout;
        $this->supportTags = method_exists($cache, 'tags');
    }

    public  function  increment(string $key, array $tags) :int{

        $sessionId = $this->session->getId();
        $counterKey = "$key-counter";
        $usersKey = "$key-users";

        $cache = $this->supportTags && $tags != null ? $this->cache->tags($tags) : $this->cache;

        $users = $cache->get($usersKey, []);
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
        $cache->forever($usersKey, $usersUpdate);

        if (!$cache->has($counterKey)) {
            $cache->forever($counterKey, 1);
        } else {
            $cache->increment($counterKey, $diffrence);
        }

        return $cache->get($counterKey);

    }



}
