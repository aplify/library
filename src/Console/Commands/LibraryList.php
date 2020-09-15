<?php

namespace Aplify\Library\Console\Commands;

use Illuminate\Console\Command;

class LibraryList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'library:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all resources Library';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->table(['Name', 'Alias/collection:resource', 'Status', 'Core', 'Path'], $this->getRows());
    }

    /**
     * Get table rows.
     *
     * @return array
     */
    public function getRows()
    {
        $rows = [];

        foreach (library()->resource()->all() as $package) {
            $rows[] = [
                $package->name,
                $package->alias,
                $package->active ? 'Enabled' : 'Disabled',
                $package->core ? 'true' : 'false',
                $package->path(),
            ];
        }
        return $rows;
    }

}
