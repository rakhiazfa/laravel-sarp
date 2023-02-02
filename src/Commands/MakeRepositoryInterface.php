<?php

namespace Rakhiazfa\LaravelSarp\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeRepositoryInterface extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository-interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository interface.';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../stubs/repository-interface.stub';
    }

    public function handle()
    {

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
        $model = Str::replace('Repository', '', $this->getNameInput());

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
        $classname = Str::replace('Interface', '', $this->getNameInput());
        $model = Str::replace('Repository', '', $this->getNameInput());

        $stub = Str::replace('$NAMESPACE$', 'App\Repositories\\' . $model, $stub);

        $stub = Str::replace('$CLASSNAME$', $classname, $stub);

        return parent::replaceNamespace($stub, $name);
    }
}
