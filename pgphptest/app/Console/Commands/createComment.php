<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Users\User;
use App\Repositories\UserRepo;

class createComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comments:create {user : The ID of user} {comments*}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Appends new comment to users existing comments';

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
     * @return int
     */
    public function handle()
    {
        $id = $this->argument('user');
        $comments = $this->argument('comments');
        
        $user = UserRepo::getUserById($id);

        if (!empty($user)) {

            if (!empty($comments)) {

                $insert_comment = UserRepo::updateUserComments($id, $comments);

                if ($insert_comment) {

                    $this->info('Comments successfully added!');
                }

            } else {

                $this->error('Please provide atleast 1 comment in the array.');
            }

        } else {

            $this->error('Invalid user');
        }
        
    }
}
