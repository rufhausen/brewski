<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Push extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Push application updates to remote';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        //Vars
        $remote = $this->argument('remote');
        //old habits die hard.
        if ($remote == 'prod')
        {
            $remote = 'production';
        }
        $version_file             = 'version.txt';
        $remote_path              = Config::get('remote.connections.' . $remote . '.root');
        $git_repo                 = Config::get('remote.connections' . $remote . '.git_repo');
        $local_version_file_path  = base_path() . '/' . $version_file;
        $remote_version_file_path = $remote_path . '/' . $version_file;

        $this->info('Pushing to ' . $remote);

        //Local Commands
        exec('git push ' . $remote . ' --force');
        exec('git describe --always > ' . $version_file);
        $this->info('Git Push Complete');

        $commands = [
            'cd /var/git/thereluctantdeveloper.com.git',
            'GIT_WORK_TREE=' . $remote_path . ' git checkout master -f',
            'cd ' . $remote_path,
            'php artisan cache:clear',
            'rm -f app/storage/cache/*',
            'rm -f app/storage/views/*',
            'composer install',
            'php artisan migrate',
            'chmod 774 -R ' . $remote_path . ' -f'
        ];

        //Remote Commands
        SSH::into($remote)->run($commands);
        $this->info('Git Checkout Complete');
        SSH::into($remote)->put($local_version_file_path, $remote_version_file_path);
        $this->info('Version File Updated');
        $this->info('Operation Complete!');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('remote', InputArgument::REQUIRED, 'Remote Host'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}
