<?php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiRestService
{
    private $client, $body;
    public function __construct() {
        $this->client = new Client([
            'base_uri' => 'http://185.98.136.60:9090',
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJITlhWT3dMMVNwaXRINmh0Q052aVJPSjlrcjFSd05PM3NqckVqbTdlWUswIn0.eyJleHAiOjE2ODA0MTIyMDUsImlhdCI6MTY4MDM5MDYwNSwianRpIjoiZWQ5YWE3MTEtMGI0OC00YjRhLTliZDItNzY1OGVmNmYxMjQzIiwiaXNzIjoiaHR0cDovLzE4NS45OC4xMzYuNjA6ODA4MC9yZWFsbXMvY29kZWxlbWFucyIsImF1ZCI6ImFjY291bnQiLCJzdWIiOiJlZDkxMzAxYy1lZDFlLTRlNWQtYTcxNS0wODUyMmQ5ZmE4ZTUiLCJ0eXAiOiJCZWFyZXIiLCJhenAiOiJhcHAtZGVmaS0yNGgiLCJzZXNzaW9uX3N0YXRlIjoiZDYxMmI2OTUtY2RlYy00M2Q2LWIzZmUtMmQ2YjZkNTE4Y2I1IiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyIqIl0sInJlYWxtX2FjY2VzcyI6eyJyb2xlcyI6WyJvZmZsaW5lX2FjY2VzcyIsImRlZmF1bHQtcm9sZXMtY29kZWxlbWFucyIsInVtYV9hdXRob3JpemF0aW9uIiwidXNlciJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoiZW1haWwgcHJvZmlsZSIsInNpZCI6ImQ2MTJiNjk1LWNkZWMtNDNkNi1iM2ZlLTJkNmI2ZDUxOGNiNSIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiJzbW9vdGh5IiwidGVhbV9pZCI6IjIxIiwiZ2l2ZW5fbmFtZSI6IiIsImZhbWlseV9uYW1lIjoiIiwidGVhbV9uYW1lIjoiU21vb3RoeSJ9.aSrT7qWB_MnsGSxBzetfrKseAdaE2ATEQMCt1-fW97vfKy6vtgRoV_cz6pVGVwve96tSmJfhRMvz-BfTUq0K_0VYHLsfzFFHz_hafdZZiZc_pgu0Tiwps_Usn7crzf2CgaO01kvfq_EzEeaoNO0Qvftl5TapQR1NCQ64xTSeOWrMh7xHuuHFpNtTAd9Y1FJqlu-pL70yFrPldFZk8uNHDQlaiREAJtbzt7VMSVkMvlbOhDjZVp4SSFtmT6RSNk0yESdgjPgGbI87kGFb_SDKQL8qUCmUiiTAH_oRdqmC6P8xEJZBWLG-JVfqK4C6MXrTG9nycd2OnM4RrsURlb7Lxw',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ]
        ]);
        $this->body = [
            'client_id' => 'app-defi-24h',
            'grant_type' => 'password',
            'username' => 'smoothy',
            'password' => 'r6Q5$0RzNIzv^2Eq',
        ];
    }

    public function CallTeams($teamId = "", $url = "", $raceId = "")
    {
        // "/teams"
        // "/teams/{teamId}"
        // "/teams/{teamId}/bestTimes"
        // "/teams/{teamId}/allTimes"
        // "/teams/{teamId}/allTimes/{raceId}"

        $call = '';
        if ($teamId) $call .= '/' . $teamId;
        if ($teamId && $url) $call .= '/' . $url;
        if ($teamId && $url && $raceId) $call .= '/' . $raceId;

        try {
            $response = $this->client->request('GET', '/teams' . $call, [
                'json' => $this->body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = json_decode( $response->getBody()->getContents() );
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }

    public function CallTeamInventory($methode = 'GET', $teamId = '', $url = '', $itemId = '')
    {
        if ( !in_array($methode, ['GET', 'PUT']) ) return "Methode non autorisé";

        // "/teams/{teamId}/inventory"
        // "/teams/{teamId}/inventory/equip"
        // "/teams/{teamId}/inventory/equip/{itemId}"

        $call = '';
        if ($url) $call .= '/' . $url;
        if ($methode == 'PUT' && $url && $itemId) $call .= '/' . $itemId;

        try {
            $response = $this->client->request($methode, '/teams/' . $teamId . '/inventory' . $call, [
                'json' => $this->body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = json_decode( $response->getBody()->getContents() );
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }

    public function CallTransactions($teamId = "")
    {
        // "/transactions"
        // "/transactions/{teamId}"

        $call = '';
        if ($teamId) $call .= '/' . $teamId;

        try {
            $response = $this->client->request('GET', '/transactions' . $call, [
                'json' => $this->body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = json_decode( $response->getBody()->getContents() );
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }

    public function CallRaces($raceId = "", $url = "", $teamId = "")
    {
        // /races/{raceId}
        // /races/{raceId}/teamRace/{teamId}/bestTime
        // /races/{raceId}/teamRace/{teamId}/all
        // /races/{raceId}/teamRace/{teamId}/allBestTime
        // /races/{raceId}/run/{teamId}
        // /races/all/{teamId}

        $call = '';
        if ($url == "all" && $teamId) {
            $call = '/' . $url . '/' . $teamId;
        }else{
            $call = '/' . $raceId;

            $call .= ($url == "run")? '/run' : '/teamRace';
            $call .= $teamId;
            $call .= ($url == "run")? '' : '/' . $url;
        }

        try {
            $response = $this->client->request('GET', '/races' . $call, [
                'json' => $this->body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = json_decode( $response->getBody()->getContents() );
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }

    public function CallItems($methode, $url = '', $itemId = '', $teamId = '')
    {
        if ( !in_array($methode, ['GET', 'POST']) ) return "Methode non autorisé";

        // /items
        // /items/{itemId}
        // /items/sell/{teamId}/teams
        // /items/sell/{teamId}/marketplace
        // /items/search
        // /items/buy/{itemId}/{teamId}

        $call = '';
        if ($methode == 'POST' && $url) {
            switch ($url) {
                case 'search':
                    $call .= '/' . $url;
                    break;
                case 'buy':
                    $call .= '/' . $url . '/' . $itemId . '/' . $teamId;
                    break;
                default:
                    $call .= '/sell/' . $itemId . '/' . $url;
                    break;
            }
        }
        if ($methode == 'GET' && $itemId) {
            $call .= '/' . $itemId;
        }

        try {
            $response = $this->client->request('GET', '/items', [
                'json' => $this->body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = json_decode( $response->getBody()->getContents() );
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }
}