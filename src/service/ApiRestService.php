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
                'Authorization' => 'Bearer eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJITlhWT3dMMVNwaXRINmh0Q052aVJPSjlrcjFSd05PM3NqckVqbTdlWUswIn0.eyJleHAiOjE2ODAzNzM1MTUsImlhdCI6MTY4MDM1MTkxNSwianRpIjoiYzYyNjc4ZjQtODQzZi00ZTI4LWI1Y2MtYzMxZmY2ZGMxMDk5IiwiaXNzIjoiaHR0cDovLzE4NS45OC4xMzYuNjA6ODA4MC9yZWFsbXMvY29kZWxlbWFucyIsImF1ZCI6ImFjY291bnQiLCJzdWIiOiJlZDkxMzAxYy1lZDFlLTRlNWQtYTcxNS0wODUyMmQ5ZmE4ZTUiLCJ0eXAiOiJCZWFyZXIiLCJhenAiOiJhcHAtZGVmaS0yNGgiLCJzZXNzaW9uX3N0YXRlIjoiMWVkZmFmZDctNzNkZC00NDAwLWE0MmQtMDE4ZmY3M2E1NmEyIiwiYWNyIjoiMSIsImFsbG93ZWQtb3JpZ2lucyI6WyIqIl0sInJlYWxtX2FjY2VzcyI6eyJyb2xlcyI6WyJvZmZsaW5lX2FjY2VzcyIsImRlZmF1bHQtcm9sZXMtY29kZWxlbWFucyIsInVtYV9hdXRob3JpemF0aW9uIiwidXNlciJdfSwicmVzb3VyY2VfYWNjZXNzIjp7ImFjY291bnQiOnsicm9sZXMiOlsibWFuYWdlLWFjY291bnQiLCJtYW5hZ2UtYWNjb3VudC1saW5rcyIsInZpZXctcHJvZmlsZSJdfX0sInNjb3BlIjoiZW1haWwgcHJvZmlsZSIsInNpZCI6IjFlZGZhZmQ3LTczZGQtNDQwMC1hNDJkLTAxOGZmNzNhNTZhMiIsImVtYWlsX3ZlcmlmaWVkIjp0cnVlLCJwcmVmZXJyZWRfdXNlcm5hbWUiOiJzbW9vdGh5IiwidGVhbV9pZCI6IjIxIiwiZ2l2ZW5fbmFtZSI6IiIsImZhbWlseV9uYW1lIjoiIiwidGVhbV9uYW1lIjoiU21vb3RoeSJ9.ZdhgcxsquijJnYL0QZnEC2G13E1qNoKRx4hU70Q45Pz3fSEzcBm_nM7ImBokto9ImZWd8UQ5u6ggTD4Gr69TE4Vi8Il3O59InsCErJEVhlovTEhA0CDPsPMZ3-8EEwQuMe6koWqXlOrVaumryDz8i7UyEI5w0iKS5cLn-8GVC3FKOjjjsKfA6UX7i-pI7f8lJbLo0JGwJaU1HkcbNL-JA-H1XLDR__iWo-K-6uXFj6Em7mM9FaKTqvavgSANzFj0zKY75sUN6WQhDjuvZbGK2nO42Bj7PvK92iREuEGVxODB6JuyiRvkKWKpZ_czcKYl_gwEpD2OXvFFEhE7HVjYGw',
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

    public function CallTeams()
    {
        try {
            $response = $this->client->request('GET', '/teams', [
                'json' => $this->body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }

    public function CallTeamInventory()
    {
        try {
            $response = $this->client->request('GET', '/teams/'.'/inventory', [
                'json' => $this->body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }

    public function CallTransactions()
    {
        try {
            $response = $this->client->request('GET', '/transactions', [
                'json' => $this->body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }

    public function CallRaces()
    {
        try {
            $response = $this->client->request('GET', '/races', [
                'json' => $this->body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }

    public function CallItems()
    {
        try {
            $response = $this->client->request('GET', '/items', [
                'json' => $this->body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
        } catch (RequestException $e) {
            $content = $e;
        }
        return $content;
    }
}