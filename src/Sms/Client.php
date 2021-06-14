<?php


namespace ZhyuInfo\Sms;


use Infobip\Api\SendSmsApi;
use Infobip\Configuration;
use GuzzleHttp\Client as GuzzleClient;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;

class Client
{
    private $client;
    private $configuration;

    public function __construct()
    {
        $configuration = (new Configuration())
            ->setHost(env('INFOBIP_URL_BASE_PATH'))
            ->setApiKeyPrefix('Authorization', 'App')
            ->setApiKey('Authorization', env('INFOBIP_API_KEY'));

        $client = new GuzzleClient();
    }

    public function send(string $mobile_number, string $message, string $from = null){
        $sendSmsApi = new SendSmsApi($this->client, $this->configuration);

        $from = is_null($from) ? env('INFOBIP_FROM', 'SMS') : $from;

        $destination = (new SmsDestination())->setTo($mobile_number);
        $message = (new SmsTextualMessage())
            ->setFrom($from)
            ->setText($message)
            ->setDestinations([$destination]);
        $request = (new SmsAdvancedTextualRequest())
            ->setMessages([$message]);
        try {
            $smsResponse = $sendSmsApi->sendSmsMessage($request);

            return $smsResponse;
        } catch (Throwable $apiException) {
            // HANDLE THE EXCEPTION
        }
    }


}