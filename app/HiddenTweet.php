<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HiddenTweet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'hidden_tweets';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'tweet_id_str';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['tweet_id_str', 'user_id'];
}
