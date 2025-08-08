<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MakeRouteCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:route {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new route file';

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
        $fileName  = Str::lower($className);
        $fullPath  = base_path("routes/{$fileName}.php");

        if (file_exists($fullPath)) {
            $this->error("Route file {$fileName} already exists at {$fullPath}!");

            return;
        }

        $directoryPath = base_path('routes/'.str_replace('\\', '/', $directory));
        if (!File::exists($directoryPath)) {
            File::makeDirectory($directoryPath, 0755, true);
        }

        $prefix = Str::plural(Str::lower($className));

        $content = <<<PHP
        <?php

        use App\\Http\\Controllers\\{$className}Controller;
        use Illuminate\\Support\\Facades\\Route;

        Route::prefix('{$prefix}')->group(function () {
            Route::get('/', [{$className}Controller::class, 'index']);
            Route::post('/', [{$className}Controller::class, 'store']);
            Route::get('/{id}', [{$className}Controller::class, 'show']);
            Route::put('/{id}', [{$className}Controller::class, 'update']);
            Route::delete('/{id}', [{$className}Controller::class, 'destroy']);
        });
        PHP;

        File::put($fullPath, $content);
        $this->info("Route file created successfully at {$fullPath}!");
    }
}
