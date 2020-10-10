<?php

namespace App\helper\SendEmail;

class RequestSendMail
{

    private $url ;
    private $dataMail;

    public function __construct($dataMail)
    {
        $this->dataMail = (object) $dataMail;
        $this->dataMail->key = "edsendmail";
        $this->dataMail->from = env('API_MAIL_FROM', 'edyamishiro@gmail.com');
        $this->url = env('API_MAIL_URL', 'https://app-compact.000webhostapp.com/api/mail/') ;
    }

    public function mail($view, $data = null)
    {
        $view = view($view, compact('data'));

        $data = [
            'key' => $this->dataMail->key,
            'mail_from' => $this->dataMail->from,
            'mail_to' => $this->dataMail->to,
            'mail_subject' => $this->dataMail->subject,
            'mail_body' => $view->render(),
            'mail_from_title' => $this->dataMail->title
        ];
        return $this->request_guzzle($data);
    }

    public function request_guzzle($data)
    {
        return (new \GuzzleHttp\Client())->post($this->url, [
            'form_params' => $data
        ])->getBody();
    }

    public static function send($view, $to, $data){
        $dataMain = [
            'to' => $to,
            'subject' => $data['subject'],
            'title' => $data['title'],
        ];

        $sMail = new RequestSendMail($dataMain);
        try {
            $sMail->mail($view, $data);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
        
    }
}