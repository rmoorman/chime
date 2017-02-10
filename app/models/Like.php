<?php

class Like extends Base
{

    protected $visible = ['user'];

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];   

    /**
     * Get all of the owning likeable models.
     */
    public function likeable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user who created the comment
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

}