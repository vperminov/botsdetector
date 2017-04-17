<?php namespace Alexis\Botdetector\Components;

use Cms\Classes\ComponentBase;
use Alexis\Botdetector\Models\Settings;
use Alexis\Botdetector\Models\Visits;
use Log;
use Mail;
use Config;
use Lang;

class Detector extends ComponentBase
{
    /**
     * @var object
     */
    private $settings;

    public function componentDetails()
    {
        return [
            'name'        => 'alexis.botdetector::lang.component.name',
            'description' => 'alexis.botdetector::lang.component.description'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun() {
        $this->settings = Settings::instance();
        $this->setLocale();
        if (preg_match($this->generateBotsMatchPattern(), $_SERVER['HTTP_USER_AGENT'], $out)) {
            $mess = $this->generateMessage($_SERVER['REQUEST_URI'], $out[0], $_SERVER['HTTP_USER_AGENT']);
            if ($this->getSetting('logging')) {
                Log::info($mess);
            }
            if ($this->getSetting('mailing')) {
                Mail::send('alexis.botdetector::mail.bot', ['mess' => $mess, 'subject' =>  Config::get('app.url') . ' - bot report'], function($message) {
                    $message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));
                    $message->to($this->getSetting('email'), $this->getSetting('emailRecepient'));

                });
            } else {
                $model = new Visits;
                $model->bot_owner = $out[0];
                $model->bot_description = $_SERVER['HTTP_USER_AGENT'];
                $model->page_url = $_SERVER['REQUEST_URI'];
                $model->save();
            }
        }
    }

    /**
     * @return string
     */
    private function generateBotsMatchPattern() {
        $allowed = [];
        foreach ($this->getSetting('bot') as $botName => $value) {
            if($value || $this->getSetting('allowOnlySome')) {
                $allowed[] = '(' . $botName . ')';
            }
        }
        $pattern = '/' . implode('|', $allowed) . '/msi';
        return $pattern;
    }

    /**
     * @param $field
     * @return mixed
     */
    private function getSetting($field) {
        return $this->settings->{$field};
    }

    /**
     * @param $pageUrl
     * @param $bot
     * @param $description
     * @return string
     */
    private function generateMessage($pageUrl, $bot, $description) {
        return Lang::get('alexis.botdetector::lang.texts.on_page')
            . $pageUrl
            . Lang::get('alexis.botdetector::lang.texts.came')
            . $bot . ', '
            . Lang::get('alexis.botdetector::lang.texts.description')
            . $description;
    }

    private function setLocale() {
        Lang::setLocale(Config::get('app.locale'));
    }

}
