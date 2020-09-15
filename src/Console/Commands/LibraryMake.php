<?php

namespace Aplify\Library\Console\Commands;

use Aplify\Library\Support\Alias;
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class LibraryMake extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'library:make {name} {--collection=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Resource';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $collection = $this->option('collection') ?? config('library.default');

        $name = $this->argument('name');

        $alias =  Alias::render($name);

        if ($alias->check())
        {
            $name = $alias->resource();
            $collection = $alias->collection();
        }

        $resource = library($collection)->resource()->generate($name);
        $response = $resource->build();

        if (!$response['status'])
            $this->error($response['message']);

        elseif($response['status'])
            $this->info($response['message']);
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['collection', null, InputOption::VALUE_OPTIONAL, 'Generate a resource for the given collection.'],
        ];
    }
}
