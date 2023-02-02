<?php

namespace Rakhiazfa\LaravelSarp\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeService extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class.';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/../../stubs/service.stub';
    }

    public function handle()
    {
        $this->input->setArgument(
            'name',
            str_replace('Service', '', $this->argument('name')) . 'Service'
        );

        $this->call('make:service-interface', ['name' => $this->getNameInput()]);

        $this->input->setArgument('name', $this->argument('name') . 'Implementation');

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
        $model = Str::replace('ServiceImplementation', '', $this->getNameInput());

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
        $model = Str::replace('ServiceImplementation', '', $this->getNameInput());

        $classname = $model . 'Service';

        $stub = Str::replace('$NAMESPACE$', 'App\Services\\' . $model, $stub);

        $stub = Str::replace('$CLASSNAME$', $classname, $stub);

        $stub = Str::replace('$MODEL$', $model, $stub);

        return parent::replaceNamespace($stub, $name);
    }
}
