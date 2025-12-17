<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Available cover images - cycling through these for each post
        $coverImages = [
            'post_images/brewconn-img1-can-label.jpeg',
            'post_images/brewconn-img2-cans.jpeg',
            'post_images/brewconn-img3-team.jpeg',
            'post_images/brewconn-img4-headlines.png',
            'post_images/brewconn-img5-map.png',
            'post_images/brewconn-img6-canvas.png',
            'post_images/brewconn-img7-sprint.png',
        ];

        $articles = [
            [
                'title' => 'The Future of Digital Innovation at i3',
                'subheader' => 'Exploring new frontiers in creative technology and interdisciplinary collaboration',
                'author' => 'Dr. Jane Smith',
                'published_at' => now()->subDays(2),
                'tags' => ['News', 'Projects'],
            ],
            [
                'title' => 'Building Bridges Between Design and Technology',
                'subheader' => 'Teaching students to think holistically about the creative process',
                'author' => 'Michael Chen',
                'published_at' => now()->subDays(5),
                'tags' => ['News', 'People'],
            ],
            [
                'title' => 'Student Spotlight: Recent Projects and Achievements',
                'subheader' => 'Showcasing the breadth of talent and innovation from our students',
                'author' => 'Sarah Williams',
                'published_at' => now()->subDays(8),
                'tags' => ['People', 'Projects'],
            ],
            [
                'title' => 'Exploring the Intersection of Art and Science',
                'subheader' => 'Where artistic vision meets scientific precision',
                'author' => 'Dr. Robert Martinez',
                'published_at' => now()->subDays(12),
                'tags' => ['News', 'People'],
            ],
            [
                'title' => 'Industry Partnerships: Connecting Students with Real Projects',
                'subheader' => 'Providing real-world experience through client collaborations',
                'author' => 'Emily Rodriguez',
                'published_at' => now()->subDays(15),
                'tags' => ['Projects', 'News'],
            ],
            [
                'title' => 'Virtual Reality and Immersive Experiences at i3',
                'subheader' => 'Exploring new possibilities for storytelling and user experience',
                'author' => 'James Thompson',
                'published_at' => now()->subDays(18),
                'tags' => ['News'],
            ],
            [
                'title' => 'Why Choose i3? A Guide for Prospective Students',
                'subheader' => 'Discover what makes i3 special',
                'author' => 'Lisa Anderson',
                'published_at' => now()->subDays(22),
                'tags' => ['People', 'News'],
            ],
            [
                'title' => 'Data Visualization as Storytelling',
                'subheader' => 'Teaching students to illuminate insights through compelling data narratives',
                'author' => 'David Kim',
                'published_at' => now()->subDays(25),
                'tags' => ['News', 'Projects'],
            ],
            [
                'title' => 'The Tools of Modern Design: Keeping Up with Technology',
                'subheader' => 'Teaching timeless principles while staying current with industry standards',
                'author' => 'Maria Garcia',
                'published_at' => now()->subDays(28),
                'tags' => ['News'],
            ],
            [
                'title' => 'Celebrating Innovation: Our Latest Work Highlights',
                'subheader' => 'Reflecting on a year of pushing creative boundaries',
                'author' => 'Alex Turner',
                'published_at' => now()->subDays(30),
                'tags' => ['Projects', 'News'],
            ],
        ];

        foreach ($articles as $index => $article) {
            $slug = Str::slug($article['title']);
            
            // Ensure unique slugs
            $counter = 1;
            while (Post::where('url_friendly', $slug)->exists()) {
                $slug = Str::slug($article['title']) . '-' . $counter;
                $counter++;
            }

            // Cycle through available cover images
            $coverImage = $coverImages[$index % count($coverImages)];

            Post::create([
                'title' => $article['title'],
                'subheader' => $article['subheader'] ?? null,
                'author' => $article['author'],
                'url_friendly' => $slug,
                'published' => true,
                'published_at' => $article['published_at'],
                'tags' => $article['tags'] ?? [],
                'featured_image' => $coverImage,
                'blade_file' => 'pages.blogs.brewingInnovation',
            ]);
        }
    }
}
