<?php

namespace App\Console\Commands;

use App\Models\Comment;
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
        $comment = Comment::findOrFail($this->argument('id'));
        $current_comment = $comment->comment;
        $new_comment = $current_comment ." ". $this->argument('comments');
        $comment->comment = $new_comment;
        $comment->update();
        return 0;
    }
}
