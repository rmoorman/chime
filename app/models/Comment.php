<?php

class Comment extends Base
{
    protected $visible = ['id', 'post_id', 'body', 'created_at', 'user', 'likes_count', 'is_liked', 'entities'];

    protected $rules = array(
        'create' => [
            'body' => 'required|max_len,200|min_len,1'
        ]
    );

    protected $appends = [
        'entities'
    ];   

    /**
     * Get the user who created the comment
     */
    public function user()
    {
        return $this->belongsTo('User');
    }

    /**
     * Get the post to which the comment belongs
     */
    public function post()
    {
        return $this->belongsTo('Post');
    }

    /**
     * Get all of the comment's likes
     */
    public function likes()
    {
        return $this->morphMany('Like', 'likeable');
    }

    /**
     * Check if liked
     */
    public function is_liked()
    {
        $this->is_liked = (bool) count($this->likes);
    }

    /**
     * Extract entities into comma-delimited lists (+ pass through body)
     */
    public function setBodyAttribute($value) {

        $extracted = Twitter_Extractor::create();

        $this->attributes['body'] = $value;
        $this->attributes['mentions'] = implode(',', $extracted->extractMentionedScreennames($value));
        $this->attributes['hashtags'] = implode(',', $extracted->extractHashtags($value));
        $this->attributes['urls'] = implode(',', $extracted->extractURLs($value));
    }    

    /**
     * Entities attribute
     */
    public function getEntitiesAttribute() {

            $extracted = Twitter_Extractor::create();

            $mentions = $extracted->extractMentionedScreennamesWithIndices($this->body);
            $hashtags = $extracted->extractHashtagsWithIndices($this->body);
            $urls = $extracted->extractURLsWithIndices($this->body);

            $entities = [
                'user_mentions' => $mentions,
                'hashtags' => $hashtags,
                'urls' => $urls
            ];

            return $entities;

    }

}
