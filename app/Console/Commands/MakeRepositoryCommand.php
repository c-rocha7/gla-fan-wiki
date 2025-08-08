<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MakeRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Repository class in the app/Repositories directory';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $input = $this->argument('name');

        $validator = Validator::make(['name' => $input], [
            'name' => 'required|string|regex:/^[a-zA-Z\\\\\/]+$/',
        ]);

        if ($validator->fails()) {
            $this->error('Invalid service name. Only alphabetic characters and namespaces are allowed.');

            return;
        }

        $path      = str_replace(['\\',  '/'], DIRECTORY_SEPARATOR, $input);
        $className = Str::studly(class_basename($path));
        $directory = dirname($path);
        $fullPath  = app_path("Repositories/{$className}Repository.php");

        if (file_exists($fullPath)) {
            $this->error("Repository {$className} already exists at {$fullPath}!");

            return;
        }

        $directoryPath = app_path('Repositories/'.str_replace('\\', '/', $directory));
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        $namespace = 'App\\Repositories'.('.' !== $directory ? '\\'.str_replace('/', '\\', $directory) : '');

        $content = <<<PHP
        <?php

        namespace {$namespace};

        class {$className}Repository
        {

        }
        PHP;

        File::put($fullPath, $content);
        $this->info("Repository {$className} created successfully at {$fullPath}!");
    }
}
