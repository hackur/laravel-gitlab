<?php
namespace App\Console\Commands;

use \Illuminate\Support\Facades\Config;
use Illuminate\Console\Command;

class GitlabAPIConnector extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gitlab:api-token
           {token? : The API token for Gitlab Connector to use.}
           {--y|yes : Skip confirmation}
           {--S|show : Show the current api token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        if ($this->option('show')) {
            $token = Config::get('gitlab.token');

            if(isset($token) && !is_null($token))
                $this->info($token);
            else
                $this->info("No token set yet.");
        } else {
            if (!$this->argument('token'))
                $token = $this->ask("Enter the new API token");
            else
                $token = $this->argument('token');

            // Get Confirmation of the update
            if (!$this->option('yes')) {
                $confirm = $this->confirm("Are you sure you want to update the API token?");

                if (!$confirm) {
                    $this->error('No confirmation given. Stopping.');
                }
            }
            
            // Set the new token
            //TODO add the ability to update API tokens from the command line
            $this->error("This feature is not yet supported. Try updating the .env file manually");
            
        }
    }
}
