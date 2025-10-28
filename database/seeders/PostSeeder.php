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
        $articles = [
            [
                'title' => 'The Future of Digital Innovation at i3',
                'subheader' => 'Exploring new frontiers in creative technology and interdisciplinary collaboration',
                'author' => 'Dr. Jane Smith',
                'content' => '<p>At i3, we\'re constantly exploring the boundaries of digital innovation. This year has brought exciting developments in how we approach creative technology and interdisciplinary collaboration.</p><p>Our team has been working on groundbreaking projects that merge traditional design principles with cutting-edge technology. From immersive experiences to data visualization, we\'re pushing the envelope of what\'s possible.</p><h2>What Makes Us Different</h2><p>What sets i3 apart is our commitment to hands-on learning and real-world applications. Students don\'t just study theory—they work on actual client projects that make a difference.</p>',
                'published_at' => now()->subDays(2),
                'tags' => ['News', 'Projects'],
            ],
            [
                'title' => 'Building Bridges Between Design and Technology',
                'subheader' => 'Teaching students to think holistically about the creative process',
                'author' => 'Michael Chen',
                'content' => '<p>In today\'s digital landscape, the line between design and technology has never been more blurred. At i3, we embrace this convergence, teaching students to think holistically about the creative process.</p><h2>The i3 Approach</h2><p>Our curriculum emphasizes collaborative learning, where developers and designers work side-by-side from concept to completion. This approach mirrors real-world production environments and prepares students for careers in creative technology.</p><p>The results speak for themselves. Our alumni are working at some of the most innovative companies in the industry, bringing with them the interdisciplinary mindset we cultivate.</p>',
                'published_at' => now()->subDays(5),
                'tags' => ['News', 'People'],
            ],
            [
                'title' => 'Student Spotlight: Recent Projects and Achievements',
                'subheader' => 'Showcasing the breadth of talent and innovation from our students',
                'author' => 'Sarah Williams',
                'content' => '<p>Our students continue to amaze us with their creativity and technical skills. This semester has seen some truly innovative projects that showcase the breadth of talent at i3.</p><h2>Featured Projects</h2><p>From interactive installations to web applications, our students are tackling complex problems with elegant solutions. Many of these projects have garnered attention both within the university and in the broader design community.</p><h3>Awards and Recognition</h3><p>Several of our student projects have been featured in design competitions and exhibitions, validating the quality of work happening here at i3.</p>',
                'published_at' => now()->subDays(8),
                'tags' => ['People', 'Projects'],
            ],
            [
                'title' => 'Exploring the Intersection of Art and Science',
                'subheader' => 'Where artistic vision meets scientific precision',
                'author' => 'Dr. Robert Martinez',
                'content' => '<p>Creative technology sits at a unique crossroads—where artistic vision meets scientific precision. At i3, we celebrate this intersection and train students to navigate it with confidence.</p><p>Our faculty brings diverse backgrounds from fine arts, computer science, engineering, and design. This interdisciplinary approach creates a rich learning environment where students can explore unexpected connections.</p><h2>Research and Innovation</h2><p>Beyond teaching, i3 faculty are actively engaged in research that pushes the boundaries of creative technology. Our labs are buzzing with experimentation and innovation.</p>',
                'published_at' => now()->subDays(12),
                'tags' => ['News', 'People'],
            ],
            [
                'title' => 'Industry Partnerships: Connecting Students with Real Projects',
                'subheader' => 'Providing real-world experience through client collaborations',
                'author' => 'Emily Rodriguez',
                'content' => '<p>One of the hallmarks of an i3 education is the opportunity for students to work on real client projects. Our industry partnerships provide invaluable experience while also delivering results for our partners.</p><h2>How It Works</h2><p>Throughout the semester, students work in teams on projects for external clients. These aren\'t mock projects—they\'re real deliverables with actual stakes. This experiential learning model ensures students graduate with portfolio pieces that demonstrate professional-level work.</p><p>Recent clients have included local nonprofits, startups, and established companies looking for innovative digital solutions.</p>',
                'published_at' => now()->subDays(15),
                'tags' => ['Projects', 'News'],
            ],
            [
                'title' => 'Virtual Reality and Immersive Experiences at i3',
                'subheader' => 'Exploring new possibilities for storytelling and user experience',
                'author' => 'James Thompson',
                'content' => '<p>Virtual and augmented reality technologies are opening up entirely new possibilities for storytelling and user experience. At i3, we\'re at the forefront of exploring these mediums.</p><h2>Our VR Lab</h2><p>Equipped with state-of-the-art VR hardware, our students experiment with immersive design, 3D modeling, and interactive narratives. These skills are increasingly valuable as VR and AR become more mainstream.</p><p>The applications are endless—from educational experiences to architectural visualization to therapeutic interventions. Our students are exploring all of these possibilities and more.</p>',
                'published_at' => now()->subDays(18),
                'tags' => ['News'],
            ],
            [
                'title' => 'Why Choose i3? A Guide for Prospective Students',
                'subheader' => 'Discover what makes i3 special',
                'author' => 'Lisa Anderson',
                'content' => '<p>If you\'re considering pursuing creative technology or digital design, you might be wondering what makes i3 special. Here are some of the key reasons why students choose us.</p><h2>Hands-On Learning</h2><p>We believe in learning by doing. Theory is important, but nothing beats rolling up your sleeves and building something real. From day one, you\'ll be working on projects that matter.</p><h2>World-Class Faculty</h2><p>Our instructors aren\'t just teachers—they\'re practitioners with active careers in their fields. You\'ll learn from people who are pushing boundaries in design, technology, and research.</p><h2>Collaborative Community</h2><p>The i3 community is tight-knit and supportive. You\'ll form lasting connections with peers who share your passion for creative technology.</p>',
                'published_at' => now()->subDays(22),
                'tags' => ['People', 'News'],
            ],
            [
                'title' => 'Data Visualization as Storytelling',
                'subheader' => 'Teaching students to illuminate insights through compelling data narratives',
                'author' => 'David Kim',
                'content' => '<p>In an age of information overload, the ability to communicate data clearly and compellingly is a superpower. At i3, we teach students to think of data visualization as a form of storytelling.</p><h2>Beyond Charts and Graphs</h2><p>Good data visualization goes beyond pretty charts. It illuminates insights, reveals patterns, and tells stories that inspire action. Our students learn to combine data literacy with design sensibility to create visualizations that really work.</p><p>Recent projects have tackled topics from climate science to social justice, demonstrating how powerful data visualization can be when done thoughtfully.</p>',
                'published_at' => now()->subDays(25),
                'tags' => ['News', 'Projects'],
            ],
            [
                'title' => 'The Tools of Modern Design: Keeping Up with Technology',
                'subheader' => 'Teaching timeless principles while staying current with industry standards',
                'author' => 'Maria Garcia',
                'content' => '<p>The design and development landscape changes rapidly. New tools emerge constantly, and existing ones evolve. At i3, we keep students current with the latest technology while teaching timeless principles.</p><h2>Our Software Stack</h2><p>Students work with industry-standard tools like Figma, Adobe Creative Suite, VS Code, and various frameworks. We ensure you graduate with skills that employers are actually looking for.</p><p>But we also emphasize that tools change—it\'s the fundamental concepts of good design and clean code that will serve you throughout your career.</p>',
                'published_at' => now()->subDays(28),
                'tags' => ['News'],
            ],
            [
                'title' => 'Celebrating Innovation: Our Latest Work Highlights',
                'subheader' => 'Reflecting on a year of pushing creative boundaries',
                'author' => 'Alex Turner',
                'content' => '<p>As we reflect on the past year, we\'re proud of the innovative work coming out of i3. From public installations to web platforms to mobile apps, our students and faculty continue to push creative boundaries.</p><h2>Notable Projects</h2><p>This year\'s projects span a remarkable range—from tools that help communities connect to experiences that bring historical data to life. Each project demonstrates the unique perspective that i3 brings to creative technology.</p><p>What\'s next? We\'re excited to see what innovations will emerge in the coming year as we continue to explore the possibilities at the intersection of art, design, and technology.</p>',
                'published_at' => now()->subDays(30),
                'tags' => ['Projects', 'News'],
            ],
        ];

        foreach ($articles as $article) {
            $slug = Str::slug($article['title']);
            
            // Ensure unique slugs
            $counter = 1;
            while (Post::where('url_friendly', $slug)->exists()) {
                $slug = Str::slug($article['title']) . '-' . $counter;
                $counter++;
            }

            Post::create([
                'title' => $article['title'],
                'subheader' => $article['subheader'] ?? null,
                'author' => $article['author'],
                'url_friendly' => $slug,
                'content' => $article['content'],
                'published' => true,
                'published_at' => $article['published_at'],
                'tags' => $article['tags'] ?? [],
                'featured_image' => 'post_imagesz/johnatahn.jpg',
            ]);
        }
    }
}
