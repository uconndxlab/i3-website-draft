@props(['services' => null, 'class' => ''])

@php
$defaultServices = [
    ['label' => 'Web Design', 'icon' => 'laptop', 'class' => 'web-design-color'],
    ['label' => 'UX Design', 'icon' => 'pencil', 'class' => 'ux-design-color'],
    ['label' => 'App Development', 'icon' => 'phone', 'class' => 'app-development-color'],
    ['label' => 'Design Thinking', 'icon' => 'lightbulb', 'class' => 'tech-support-color'],
    ['label' => 'Digital Consulting', 'icon' => 'chat-dots', 'class' => 'digital-consulting-color'],
    ['label' => 'Custom Tech Solutions', 'icon' => 'tools', 'class' => 'custom-tech-solutions-color']
];

$servicesToRender = $services ?? $defaultServices;
@endphp

<ul class="service-badges-list list-unstyled row {{ $class }}">
    @foreach ($servicesToRender as $badge)
        <li class="col-md-6 mb-3">
            <div class="service-badge text-light px-3 py-2 rounded-pill shadow-sm {{ $badge['class'] }}"
                data-aos="fade" data-aos-duration="1200" data-aos-delay="{{ rand(100, 500) }}"
                data-aos-easing="ease-out-back" data-aos-once="true">
                <i class="bi bi-{{ $badge['icon'] }} me-2" aria-hidden="true"></i> {{ $badge['label'] }}
            </div>
        </li>
    @endforeach
</ul>
