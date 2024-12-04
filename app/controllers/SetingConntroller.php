<?php
require_once __DIR__ . '/../models/Setting.php';

class SettingsController
{
    public function index()
    {
        require_once __DIR__ . '/../models/Setting.php';
        $settingsModel = new Setting();
        $settings = $settingsModel->getAll();
        require_once __DIR__ . '/../views/admin/settings.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once __DIR__ . '/../models/Setting.php';
            $settingsModel = new Setting();

            foreach ($_POST as $key => $value) {
                $settingsModel->update($key, $value);
            }

            header('Location: /admin/settings');
            exit;
        }
    }
    
    public function getSettings() {
        $setting = new Setting();
        return $setting->getAll();
    }

    public function updateSetting($key, $value) {
        $setting = new Setting();
        return $setting->update($key, $value);
    }
}

