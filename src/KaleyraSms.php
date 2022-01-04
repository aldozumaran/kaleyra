<?php

namespace AldoZumaran\Kaleyra;

class KaleyraSms extends Kaleyra
{
    protected $smsParams = [];
    public function configureSms($params)
    {
        $this->smsParams = $params;
    }

    public function sendSms($to, $body)
    {
        return $this->send([
            'to' => $to,
            'body' => $body
        ]);
    }

    public function send($config)
    {
        $http = $this->client();

        $response = $http->request('POST','messages', [
            'json' => $this->getParams($config)
        ]);
        $this->body = json_decode((string) $response->getBody(), true);
        return isset($this->body['error']) && empty($this->body['error']);
    }

    public function getParams($config)
    {
        $this->smsParams = array_merge($this->smsParams, $config);

        if (!isset($this->smsParams['sender']) || !$this->smsParams['sender']) {
            $sender = config('kaleyra.sms.sender');
            $this->smsParams['sender'] = $sender ?: 'KLRHXA';
        }
        if (!isset($this->smsParams['type'])) {
            $this->smsParams['type'] = config('kaleyra.sms.type');
        }

        return $this->smsParams;
    }
}
