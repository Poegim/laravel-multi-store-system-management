<?php 
namespace App\Livewire;

use Livewire\Component;

class LogViewer extends Component
{
    public $logs = [];
    public $filter = '';

    public function mount()
    {
        $this->readLog();
    }

    public function readLog()
    {
        $logFile = storage_path('logs/laravel.log');

        if (file_exists($logFile)) {
            $lines = file($logFile, FILE_IGNORE_NEW_LINES);
            $lines = array_reverse($lines);

            if ($this->filter) {
                $lines = array_filter($lines, fn($line) => stripos($line, $this->filter) !== false);
            }

            $this->logs = $lines;
        } else {
            $this->logs = ['Brak pliku logów.'];
        }

    }

    public function updatedFilter()
    {
        $this->readLog();
    }

    public function render()
    {
        return view('livewire.log-viewer');
    }
}
