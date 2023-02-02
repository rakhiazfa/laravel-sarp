<?php

namespace Rakhiazfa\LaravelSarp\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeServiceInterface extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service-interface {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service interface.';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../stubs/service-interface.stub';
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
        $model = Str::replace('Service', '', $this->getNameInput());

        return $rootNamespace . '\Services\\' . $model;
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
        $model = Str::replace('Service', '', $this->getNameInput());

        $stub = Str::replace('$NAMESPACE$', 'App\Services\\' . $model, $stub);

        $stub = Str::replace('$CLASSNAME$', $classname, $stub);

        return parent::replaceNamespace($stub, $name);
    }
}
