<?php

namespace kopin88\LaravelMultiAuthRole;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

class MultiAuthRoleCommand extends Command
{

      use DetectsApplicationNamespace;

      /**
       * The name and signature of the console command.
       *
       * @var string
       */
      protected $signature = 'kopin88:multiauth
                      {--views : Only scaffold the authentication views}
                      {--force : Overwrite existing views by default}';

      /**
       * The console command description.
       *
       * @var string
       */
      protected $description = 'Make MultiUser & MultiRole';

      /**
       * The views that need to be exported.
       *
       * @var array
       */
      protected $views = [
          'auth/login.stub' => 'auth/login.blade.php',
          'auth/register.stub' => 'auth/register.blade.php',
          'auth/passwords/email.stub' => 'auth/passwords/email.blade.php',
          'auth/passwords/reset.stub' => 'auth/passwords/reset.blade.php',
          'layouts/app.stub' => 'layouts/app.blade.php',
          'home.stub' => 'home.blade.php',
      ];

      protected $migrations = [
          '2014_10_12_000000_create_users_table.php' => '2014_10_12_000000_create_users_table.php',
          '2017_01_17_085616_create_roles_table.php'=> '2017_01_17_085616_create_roles_table.php',
          '2017_01_17_085724_create_user_role_table.php' => '2017_01_17_085724_create_user_role_table.php',
      ];

      protected $seeds = [
          'DatabaseSeeder.php' => '/DatabaseSeeder.php',
          'RoleTableSeeder.php' => '/RoleTableSeeder.php',
          'UserTableSeeder.php' => '/UserTableSeeder.php',
      ];

      protected $models = [
          'Role.php' => 'Role.php',
          'User.php' => 'User.php',
      ];

      protected $controllers = [
          'Auth/RegisterController.php' => '/Auth/RegisterController.php',
          'Auth/UserCtrl.php' => '/Auth/UserCtrl.php',
      ];

      /**
       * Execute the console command.
       *
       * @return void
       */
      public function handle()
      {
          $this->createDirectories();

          $this->exportViews();

          $this->exportMigrations();

          $this->exportSeeds();

          $this->exportModels();

          $this->exportControllers();


          if (! $this->option('views')) {
              file_put_contents(
                  app_path('Http/Controllers/HomeController.php'),
                  $this->compileControllerStub()
              );

              file_put_contents(
                  app_path('Http/Kernel.php'),
                  file_get_contents(__DIR__.'/stubs/make/routes.stub'),
                  FILE_APPEND
              );

              file_put_contents(
                  base_path('routes/web.php'),
                  file_get_contents(__DIR__.'/stubs/make/routes.stub'),
                  FILE_APPEND
              );
          }

          $this->info('Authentication scaffolding generated successfully.');
      }

      /**
       * Create the directories for the files.
       *
       * @return void
       */
      protected function createDirectories()
      {
          if (! is_dir(resource_path('views/layouts'))) {
              mkdir(resource_path('views/layouts'), 0755, true);
          }

          if (! is_dir(resource_path('views/auth/passwords'))) {
              mkdir(resource_path('views/auth/passwords'), 0755, true);
          }
      }

      /**
       * Export the authentication views.
       *
       * @return void
       */
      protected function exportViews()
      {
          foreach ($this->views as $key => $value) {
              if (file_exists(resource_path('views/'.$value)) && ! $this->option('force')) {
                  if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
                      continue;
                  }
              }

              copy(
                  __DIR__.'/stubs/make/views/'.$key,
                  resource_path('views/'.$value)
              );
          }
      }

      /**
       * Export the authentication migrations.
       *
       * @return void
       */
      protected function exportMigrations()
      {
          foreach ($this->migrations as $key => $value) {
              // if (file_exists(resource_path('database/migrations/'.$value)) && ! $this->option('force')) {
              //     if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
              //         continue;
              //     }
              // }

              copy(
                  __DIR__.'/stubs/make/migrations/'.$key,
                  base_path('database/migrations/'.$value)
              );
          }
      }

      /**
       * Export the authentication seeds.
       *
       * @return void
       */
      protected function exportSeeds()
      {
          foreach ($this->seeds as $key => $value) {
              // if (file_exists(resource_path('database/seeds/'.$value)) && ! $this->option('force')) {
              //     if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
              //         continue;
              //     }
              // }

              copy(
                  __DIR__.'/stubs/make/seeds/'.$key,
                  base_path('database/seeds/'.$value)
              );
          }
      }

      /**
       * Export the authentication models.
       *
       * @return void
       */
      protected function exportModels()
      {
          foreach ($this->models as $key => $value) {
              // if (file_exists(resource_path('app/'.$value)) && ! $this->option('force')) {
              //     if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
              //         continue;
              //     }
              // }

              copy(
                  __DIR__.'/stubs/make/models/'.$key,
                  base_path('app/'.$value)
              );
          }
      }

      /**
       * Export the authentication controllers.
       *
       * @return void
       */
      protected function exportControllers()
      {
          foreach ($this->controllers as $key => $value) {
              // if (file_exists(resource_path('app/Http/Controllers'.$value)) && ! $this->option('force')) {
              //     if (! $this->confirm("The [{$value}] view already exists. Do you want to replace it?")) {
              //         continue;
              //     }
              // }

              copy(
                  __DIR__.'/stubs/make/controllers/'.$key,
                  base_path('app/Http/Controllers'.$value)
              );
          }
      }

      /**
       * Compiles the HomeController stub.
       *
       * @return string
       */
      protected function compileControllerStub()
      {
          return str_replace(
              '{{namespace}}',
              $this->getAppNamespace(),
              file_get_contents(__DIR__.'/stubs/make/controllers/HomeController.stub')
          );
      }

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
}
