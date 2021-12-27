<?php

namespace Mz2p15\Kaleyra;

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
        /*
     curl -X POST "https://api.kaleyra.io/v1/<SID>/messages" \
     -H "api-key: <API_KEY>" \
     -H "Content-Type: <CONTENT_TYPE>" \
     -d "to=<TO_NUMBER>" \
     -d "sender=<SENDER_ID>" \
     -d "type=MKT" \
     -d "body=Hello! This is my first SMS." \
     -d "source=API" \
     -d "ref=<OPTIONAL_PARAMETER>" \
     -d "ref1=<OPTIONAL_PARAMETER1>" \
     -d "ref2=<OPTIONAL_PARAMETER2>"

        */

        $http = $this->client();

        return $http->request('POST','messages', [
            'json' => $this->getParams($config)
        ]);
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
