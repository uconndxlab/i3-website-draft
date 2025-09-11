<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tag;
use Illuminate\Support\Str;

class AddTag extends Command
{
    protected $signature = 'tag:add {name*}';
    protected $description = 'Add one or more tags to the database';

    public function handle(): void
    {
        $names = $this->argument('name');

        foreach ($names as $name) {
            $slug = Str::slug($name);
            $tag = Tag::firstOrCreate(['name' => $name, 'slug' => $slug]);
            $this->info("Tag '{$tag->name}' added.");
        }
    }
}
