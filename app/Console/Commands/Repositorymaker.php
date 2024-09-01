<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Repositorymaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository and corresponding interface';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $baseName = $this->argument('name');

        $interfaceName = $this->interfaceMaker($baseName);

        $repoName = $this->repositoryMaker($baseName,$interfaceName);

        $this->updateServiceProvider($repoName,$interfaceName);

        $this->info("Repository {$baseName} created successfully!");
    }

    private function interfaceMaker($baseName)
    {
        $interfaceName = $baseName . 'Interface';

        $interfacePath = app_path("Interfaces/{$interfaceName}.php");

        if (File::exists($interfacePath)) {
            $this->error("Interface {$interfaceName} already exists!");
            return;
        }

        $interfaceContent = <<<EOD
<?php

namespace App\Interfaces;

interface {$interfaceName}
{
    // Define your interface methods here
}
EOD;

        File::put($interfacePath, $interfaceContent);

        return $interfaceName;
    }

    private function repositoryMaker($base,$interface)
    {
        $repoName = $base . 'Repository';
        $repoPath = app_path("Repositories/{$repoName}.php");

        if (File::exists($repoPath)) {
            $this->error("Repository {$repoName} already exists!");
            return;
        }

        $repoContent = <<<EOD
<?php

namespace App\Repositories;
use  App\Interfaces\\{$interface};
class {$repoName} implements {$interface}
{
    // Define your repository methods here
}
EOD;

        File::put($repoPath, $repoContent);

        return $repoName;
    }


    private function updateServiceProvider($repoName,$interfaceName)
    {
        $interfacePath = "App\\Interfaces\\{$interfaceName}";
        $repoPath = "App\\Repositories\\{$repoName}";

        $serviceProviderPath = app_path('Providers/RepositoryServiceProvider.php');

        if (!File::exists($serviceProviderPath)) {
            $this->error("RepositoryServiceProvider does not exist!");
            return;
        }

        $serviceProviderContent = File::get($serviceProviderPath);

        $binding = "\$this->app->bind(\n            '{$interfacePath}',\n            '{$repoPath}',\n        );\n";

        // Insert the binding just before the closing brace of the register method
        $pattern = '/(public function register\(\): void\s*\{\s*)/';
        $replacement = "\$1\n        {$binding}\n";
        $updatedServiceProviderContent = preg_replace($pattern, $replacement, $serviceProviderContent, 1);

        File::put($serviceProviderPath, $updatedServiceProviderContent);

        $this->info("Service provider updated with binding for {$interfaceName} and {$repoName}");
    }

}
