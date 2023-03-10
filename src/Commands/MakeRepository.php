<?php

namespace Rakhiazfa\LaravelSarp\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRepository extends GeneratorCommand
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
    protected $description = 'Create a new repository class.';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../stubs/repository.stub';
    }

    public function handle()
    {
        $this->input->setArgument(
            'name',
            str_replace('Repository', '', $this->argument('name')) . 'Repository'
        );

        $this->call('make:repository-interface', ['name' => $this->getNameInput()]);

        $this->input->setArgument('name', $this->argument('name') . 'Model');

        return parent::handle();
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $model = Str::replace('RepositoryModel', '', $this->getNameInput());

        return $rootNamespace . '\Repositories\\' . $model;
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $model = Str::replace('RepositoryModel', '', $this->getNameInput());

        $classname = $model . 'Repository';

        $stub = Str::replace('$NAMESPACE$', 'App\Repositories\\' . $model, $stub);

        $stub = Str::replace('$CLASSNAME$', $classname, $stub);

        $stub = Str::replace('$MODEL$', $model, $stub);

        return parent::replaceNamespace($stub, $name);
    }
}
