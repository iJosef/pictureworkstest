<?php

namespace App\Console\Commands;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Console\Command;

class AppendComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'append:comments {id} {comments}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Append new comment to existing user comments';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::where('id',$this->argument('id'))->first();
        if ($user != null) {
            $comment = Comment::where('user_id',$this->argument('id'))->first();
            $current_comment = $comment->comment;
            $new_comment = $current_comment ." ". $this->argument('comments');
            $comment->comment = $new_comment;
            $comment->update();
        }


        return 0;
    }
}
