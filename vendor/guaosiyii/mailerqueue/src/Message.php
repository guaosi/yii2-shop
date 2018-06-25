<?php
namespace guaosiyii\mailerqueue;

use Yii;

class Message extends \yii\swiftmailer\Message
{
    public function queue()
    {
        $redis = Yii::$app->redis;

        if (empty($redis)) {
            throw new \yii\base\InvalidConfigException('redis not found in config.');
        }
        // 0 - 15  select 0 select 1
        // db => 1
        $mailer = Yii::$app->mailer;
        $param=Yii::$app->params['mailerqueue'];
        if (empty($mailer) || !$redis->select($param['db'])) {
            throw new \yii\base\InvalidConfigException('db not defined.');
        }

        $message = [];
        $message['from'] = array_keys($this->from);
        $message['to'] = array_keys($this->getTo());
        $message['cc'] = empty($this->getCc())?'':array_keys($this->getCc());
        $message['bcc'] = empty($this->getBcc())?'':array_keys($this->getBcc());
        $message['reply_to'] = empty($this->getReplyTo())?'':array_keys($this->getReplyTo());
        $message['charset'] = empty($this->getCharset())?'':array_keys($this->getCharset());
        $message['subject'] = empty($this->getSubject())?[]:$this->getSubject();
        $parts = $this->getSwiftMessage()->getChildren();
        if (!is_array($parts) || !sizeof($parts)) {
            $parts = [$this->getSwiftMessage()];
        }
        foreach ($parts as $part) {
            if (!$part instanceof \Swift_Mime_Attachment) {
                switch($part->getContentType()) {
                    case 'text/html':
                        $message['html_body'] = $part->getBody();
                        break;
                    case 'text/plain':
                        $message['text_body'] = $part->getBody();
                        break;
                }
                if (!$message['charset']) {
                    $message['charset'] = $part->getCharset();
                }
            }
        }
        return $redis->rpush($param['key'], json_encode($message));
    }
}
