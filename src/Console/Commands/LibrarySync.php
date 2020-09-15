<?php

namespace Aplify\Library\Console\Commands;

use Illuminate\Console\Command;

class LibrarySync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'library:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync all resource Library';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        library()->sync();

        $this->info('Library successfully synchronized');
    }
}
