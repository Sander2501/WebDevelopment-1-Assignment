<?php

namespace App\Models;

class BlogPost
{
    public int $id;
    public int $trainer_id;
    public string $title;
    public string $content;
    public string $published_at;
    public ?string $author_name = null;
    public ?string $author_photo = null;
    public ?string $author_spec = null;
}