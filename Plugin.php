<?php namespace Alexis\Botdetector;

use System\Classes\PluginBase;
use Alexis\Botdetector\Models\Settings;
use Alexis\Botdetector\Models\Visits;
use Mail;
use Config;
use Lang;

class Plugin extends PluginBase
{
    private $locale;

    public function registerComponents()
    {
        return [
            'Alexis\Botdetector\Components\Detector' => 'Botdetector',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'alexis.botdetector::lang.plugin.settings',
                'description' => 'alexis.botdetector::lang.plugin.settings_description',
                'category'    => 'Botdetector',
                'icon'        => 'oc-icon-bell-o',
                'class'       => 'Alexis\Botdetector\Models\Settings',
                'order'       => 500,
            ]
        ];
    }

    public function registerSchedule($schedule)
    {
        $periodicity = (int)Settings::get('periodicity');
        if($periodicity === 1) {
            $cronString = '00 * * * *';
        } else {
            $cronString = '* 0-23/' . $periodicity . ' * * *';
        }
        $schedule->call(function () {
            $this->setLocale();
            if ($report = $this->generateReport()) {
                Mail::send('alexis.botdetector::mail.report', ['report' => $report, 'subject' =>  Config::get('app.url') . ' - bot report'], function($message) {
                    $message->from(Config::get('mail.from.address'), Config::get('mail.from.name'));
                    $message->to(Settings::get('email'), Settings::get('emailRecepient'));
                });
            }
        })->cron($cronString);
    }

    public function generateReport() {
        $report = '<table><tr><td>'
            . Lang::get('alexis.botdetector::lang.texts.number')
            . '</td><td>'
            . Lang::get('alexis.botdetector::lang.texts.page_url')
            . '</td><td>'
            . Lang::get('alexis.botdetector::lang.texts.sercher')
            . '</td><td>'
            . Lang::get('alexis.botdetector::lang.texts.table_descr')
            . '</td><td>'
            . Lang::get('alexis.botdetector::lang.texts.income_time')
            . '</td></tr>';
        $i = 1;
        $visits = Visits::where('reported', '=', 0)->orderBy('created_at')->get();
        if(count($visits) == 0) {
            return FALSE;
        }
        foreach ($visits as $visit) {
            $report .= '<tr>';
                $report .= '<td>';
                    $report .= $i;
                $report .= '</td>';
                $report .= '<td>';
                    $report .= $visit->page_url;
                $report .= '</td>';
                $report .= '<td>';
                    $report .= $visit->bot_owner;
                $report .= '</td>';
                $report .= '<td>';
                    $report .= $visit->bot_description;
                $report .= '</td>';
                $report .= '<td>';
                    $report .= $visit->created_at->format('d.m.Y H:i:s');
                $report .= '</td>';
            $report .= '</tr>';
            $i++;
            $visit->reported = 1;
            $visit->save();
        }
        $report .= '</table>';
        return $report;
    }

    private function setLocale() {
        Lang::setLocale(Config::get('app.locale'));
    }
}
