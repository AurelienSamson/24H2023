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
                'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJITlhWT3dMMVNwaXRINmh0Q052aVJPSjlrcjFSd05PM3NqckVqbTdlWUswIn0.eyJleHAiOjE2ODAzOTAxNDYsImlhdCI6MTY4MDM2ODU0NiwianRpIjoiMDFkNDE3NTItODFlZC00MGI4LWFhYjEtMGMzM2MzY2FjMGM1IiwiaXNzIjoiaHR0cDovLzE4NS45OC4xMzYuNjA6ODA4MC9yZWFsbXMvY29kZWxlbWFucyIsImF1ZCI6ImFjY291bnQiLCJzdWIiOiJlZDkxMzAxYy1lZDFlLTRlNWQtYTcxNS0wODUyMmQ5ZmE4ZTUiLCJ0eXAiOiJCZWFyZXIiLCJhenAiOiJhcHAtZGVmaS0yNGgiLCJzZXNzaW9uX3N0YXRlIjoiMTRiOTA5MDctZDg0OS00ZDFlLWFiNDAtNmRhMzUzNDE2Mzg4IiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyIqIl0sInJlYWxtX2FjY2VzcyI6eyJyb2xlcyI6WyJvZmZsaW5lX2FjY2VzcyIsImRlZmF1bHQtcm9sZXMtY29kZWxlbWFucyIsInVtYV9hdXRob3JpemF0aW9uIiwidXNlciJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoiZW1haWwgcHJvZmlsZSIsInNpZCI6IjE0YjkwOTA3LWQ4NDktNGQxZS1hYjQwLTZkYTM1MzQxNjM4OCIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiJzbW9vdGh5IiwidGVhbV9pZCI6IjIxIiwiZ2l2ZW5fbmFtZSI6IiIsImZhbWlseV9uYW1lIjoiIiwidGVhbV9uYW1lIjoiU21vb3RoeSJ9.SxM_8lfgo7gxbwI8AjFE64HUFF99PEfnLCTDW1SlpbHrxYivxekriJgVaIoPgNzmVp9aidt7vIMHBqRtefrTyaAdtc0DhezTSJNQF8vIKLqPkhcDo_ftRFWKAX8JPK0dcDiHqRgrNgv399sYD5WmAMQv5b3Ia1DG0O5raoUN7uj0zBDzM2p6RELZGIYgYWY_rVrX3oU1PC92F70sGFrHBGayX-w1l-nvH3FpmtREIcJe-u8nYsxSfliIRIMvHbP13e8PvNTzfG41wn0y5N-f6p9LqSifYPShGZVYGq0l7RBu3DSkP5snhPr_WqQM0Cnm-d9kQ2Muy4wknxN2iztO-g',
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

    public function CallItems($methode, $url = '', $itemId = '', $teamId = '', $params = [])
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
                'query' => $params
            ]);
            $statusCode = $response->getStatusCode();
            $content = json_decode( $response->getBody()->getContents() );
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }
}