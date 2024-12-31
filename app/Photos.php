<?php

namespace App;

class Photos
{
    // public $photos;

    public $id = "";
    public $slug = "";
    public $alternative_slugs = [];
    public $created_at = "";
    public $updated_at = "";
    public $promoted_at = "";
    public $width = 0;
    public $height = 0;
    public $color = "";
    public $blur_hash = "";
    public $description = "";
    public $alt_description = "";
    public $breadcrumbs = [];
    public $urls = [];
    public $links = [];
    public $likes = 0;
    public $liked_by_user = false;
    public $current_user_collections = [];
    public $sponsorship = null;
    public $topic_submissions = [];
    public $asset_type = "";
    public $user = [];
}
