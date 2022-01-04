<?php

namespace AldoZumaran\Kaleyra;

use GuzzleHttp\Client as HttpClient;

class Kaleyra
{
    protected $sid;
    protected $key;
    protected $config;
    protected $url;
    protected $sender;
    protected $body = null;

    public function __construct()
    {
        $this->url = config('kaleyra.url');
        $this->sid = config('kaleyra.sid');
        $this->key = config('kaleyra.key');
        $this->config = [
            'base_uri' => rtrim($this->url, '/') . '/' . $this->sid . '/',
            'headers' => [
                'api-key' => $this->key,
                'Content-Type' => 'application/json',
            ]
        ];
    }

    public function setHeaders($headers)
    {
        $this->config['headers'] = array_merge($this->config['headers'], $headers, [
            'api-key' => $this->key
        ]);
        if (!isset($headers['Content-type'])) {
            $this->config['headers']['Content-type'] = 'application/json';
        }
    }

    public function setBaseUrl($url)
    {
        $this->url = $url;
        $this->config['base_uri'] = rtrim($url, '/') . '/' . $this->sid . '/';
    }

    public function setSid($sid)
    {
        $this->sid = $sid;
        $this->config['base_uri'] = rtrim($this->url, '/') . '/' . $sid . '/';
    }

    public function setKey($key)
    {
        $this->key = $key;
        $this->config['headers'] = array_merge($this->config['headers'], [
            'api-key' => $key
        ]);
    }

    public function client()
    {
        //dd($this->config);
        return new HttpClient($this->config);
    }

    public function getBody()
    {
        return $this->body;
    }
}
