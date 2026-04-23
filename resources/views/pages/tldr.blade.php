@extends('layouts.app')
@section('title', 'TLDR')
@section('meta_description', 'The i3 TLDR page (Too Long, Didn\'t Read) offers a concise snapshot of our impact and portfolio.')

@section('content')
    @php
        $allClients = collect($allProjects)->pluck('client')->filter()->unique()->sort()->values();
        $teamMembers = \App\Models\TeamMember::where(function ($query) {
            $query->whereNull('tags')->orWhere('tags', 'not like', '%alumni%');
        })->get();
        $projectScrollerItems = \App\Models\WorkItem::all();
    @endphp

    <h1 class="page-h1">TLDR</h1>

    <!-- YouTube Hero -->
    <section class="tldr-hero" data-bs-theme="dark">
        <div id="tldrTeamScrollerContainer1"
            class="tldr-team-scroller-container tldr-team-scroller-container-left"
            style="visibility: hidden;"
            aria-hidden="true"
            role="presentation">
            <div class="mobile-scaledown">
                <div id="tldrTeamScroller1">
                    @foreach ($teamMembers as $member)
                        <img src="{{ $member->best_image_url }}" alt="" role="presentation">
                    @endforeach
                </div>
            </div>
        </div>

        <div id="tldrTeamScrollerContainer2"
            class="tldr-team-scroller-container tldr-team-scroller-container-right"
            style="visibility: hidden;"
            aria-hidden="true"
            role="presentation">
            <div class="mobile-scaledown">
                <div id="tldrTeamScroller2">
                    @foreach ($teamMembers->reverse() as $member)
                        <img src="{{ $member->best_image_url }}" alt="" role="presentation">
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container py-5">
            <div class="row align-items-center g-4">
                <div class="col-lg-8 mx-auto">
                    <div class="tldr-video-container" data-aos="fade-up">
                        <iframe
                            src="https://www.youtube.com/embed/p1JA3uHgruI?controls=0&modestbranding=1&rel=0&iv_load_policy=3&disablekb=1&playsinline=1"
                            title="Presentation video"
                            allow="autoplay; encrypted-media; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-xl-10">
                    <div class="mt-4" data-aos="fade-up" data-bs-theme="dark">
                        <div class="row g-4">
                            <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="0">
                                <article class="tldr-glance-card">
                                    <p class="tldr-glance-value">{{ $workforceStats['staff'] }}</p>
                                    <p class="tldr-glance-label">Staff</p>
                                </article>
                            </div>
                            <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="80">
                                <article class="tldr-glance-card">
                                    <p class="tldr-glance-value">{{ $workforceStats['students'] }}</p>
                                    <p class="tldr-glance-label">Students</p>
                                </article>
                            </div>
                            <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="160">
                                <article class="tldr-glance-card">
                                    <p class="tldr-glance-value">1M+</p>
                                    <p class="tldr-glance-label">Monthly Pageviews</p>
                                </article>
                            </div>
                            <div class="col-12 col-md-6 col-xl-3" data-aos="fade-up" data-aos-delay="240">
                                <article class="tldr-glance-card">
                                    <p class="tldr-glance-value">$2M+</p>
                                    <p class="tldr-glance-label">Grant-Supported Portfolio Impact</p>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section: Minimal Fly-in Design -->
    <section class="tldr-stats py-5 px-3 px-md-5" data-bs-theme="light">
        <div class="container py-md-5">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <h2 class="tldr-stats-heading text-center mb-2" data-aos="zoom-in">Our Footprint</h2>
                    <div class="tldr-stat-grid">
                        <div class="tldr-stat" data-aos="fade-up" data-aos-delay="0">
                            <div class="tldr-stat-value">
                                <span class="odometer" data-odometer-final="{{ $projectInventoryStats['projects'] }}">0</span>
                            </div>
                            <p class="tldr-stat-label">Projects</p>
                        </div>

                        <div class="tldr-stat" data-aos="fade-up" data-aos-delay="100">
                            <div class="tldr-stat-value">
                                <span class="odometer" data-odometer-final="{{ $projectInventoryStats['departments'] }}">0</span>
                            </div>
                            <p class="tldr-stat-label">Departments</p>
                        </div>

                        <div class="tldr-stat" data-aos="fade-up" data-aos-delay="200">
                            <div class="tldr-stat-value">
                                <span class="odometer" data-odometer-final="{{ $projectInventoryStats['grants'] }}">0</span>
                            </div>
                            <p class="tldr-stat-label">Grants</p>
                        </div>

                        <div class="tldr-stat" data-aos="fade-up" data-aos-delay="300">
                            <div class="tldr-stat-value">
                                <span class="odometer" data-odometer-final="{{ $projectInventoryStats['clients'] }}">0</span>
                            </div>
                            <p class="tldr-stat-label">Clients/PIs</p>
                        </div>

                        <div class="tldr-stat" data-aos="fade-up" data-aos-delay="400">
                            <div class="tldr-stat-value">
                                <span class="odometer" data-odometer-final="{{ $projectInventoryStats['ongoing_in_progress'] }}">0</span>
                            </div>
                            <p class="tldr-stat-label">Ongoing/In Progress</p>
                        </div>

                        <div class="tldr-stat" data-aos="fade-up" data-aos-delay="500">
                            <div class="tldr-stat-value">
                                <span class="odometer" data-odometer-final="{{ $projectInventoryStats['maintenance'] }}">0</span>
                            </div>
                            <p class="tldr-stat-label">In Maintenance</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Departments Section -->
    <section class="tldr-departments py-5 px-3 px-md-5 bg-dark text-light">
        <div id="tldrDepartmentsProjectScrollerContainer"
            class="tldr-departments-project-scroller"
            style="visibility: hidden;"
            aria-hidden="true"
            role="presentation">
            <div class="mobile-scaledown">
                <div id="tldrDepartmentsProjectScroller">
                    @foreach ($projectScrollerItems as $item)
                        <div class="project-card" data-title="{{ $item->title }}" data-thumbnail="{{ $item->best_thumbnail_url }}">
                            <img src="{{ $item->best_thumbnail_url }}" alt="" role="presentation">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="container py-md-5">
            <div class="row justify-content-center">
                <div class="col-xl-10 text-center">
                    <h2 class="mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down">
                        <span class="border-bottom border-2 pb-3 border-primary">
                            Departments Served
                            <span class="dept-count-badge">{{ count($departmentCounts) }}</span>
                        </span>
                    </h2>
                    <p class="tldr-section-copy text-light-emphasis mx-auto mb-5" data-aos="fade-up">
                        The cloud below shows where the work is concentrated. Click any department to jump into its projects.
                    </p>
                </div>
            </div>

            <div class="tldr-cloud-panel" data-aos="fade-up">
                <div class="word-cloud-container">
                @forelse($departmentCounts as $item)
                        <button type="button" class="word-cloud-item word-cloud-trigger" data-department="{{ $item['name'] }}" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 30 }}" title="Show {{ $item['name'] }} projects in table">
                            <span class="word-cloud-badge" style="--cloud-size: {{ $item['size'] }}rem;">
                            {{ $item['name'] }}
                            @if($item['count'] > 1)
                                <span class="project-count">{{ $item['count'] }}</span>
                            @endif
                        </span>
                        </button>
                @empty
                    <div class="w-100 text-center">
                        <p class="text-muted mb-0">No departments found.</p>
                    </div>
                @endforelse
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects-section" class="tldr-projects py-5 px-3 px-md-5" data-bs-theme="light">
        <div class="container py-md-5">
            <div class="row justify-content-center mb-4">
                <div class="col-xl-10 text-center">
                    <h2 class="mb-3 d-inline-block pb-3 text-uppercase" data-aos="fade-down">
                        <span class="text-dark border-bottom border-2 pb-3 border-primary">
                            All Projects
                            <span class="dept-count-badge">{{ count($allProjects) }}</span>
                        </span>
                    </h2>
                    <p class="tldr-section-copy mx-auto mb-0" data-aos="fade-up">
                        Switch between strategic categories, then narrow by status, department, or client without leaving the page.
                    </p>
                </div>
            </div>

            <div class="tldr-filter-panel" data-aos="fade-up">
                <!-- Category Filter Buttons -->
                <div class="row mb-3">
                    <div class="col-12">
                        @php
                            $researchCount = collect($allProjects)->where('is_grant', true)->count();
                            $institutionalCount = collect($allProjects)->where('is_grant', false)->count();
                        @endphp
                        <div class="category-buttons-group">
                            <button class="category-btn" data-category="">
                                All Projects
                            </button>
                            <button class="category-btn" data-category="research-enablement">
                                Research Enablement <span class="dept-count-badge">{{ $researchCount }}</span>
                            </button>
                            <button class="category-btn" data-category="institutional-efficiencies">
                                Institutional Efficiencies <span class="dept-count-badge">{{ $institutionalCount }}</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Filter Controls -->
                <div class="row g-3 mb-0">
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="status-filter" class="form-label">Filter by Status</label>
                            <select id="status-filter" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="launched">Launched</option>
                                <option value="being built">Being Built</option>
                                <option value="discovery phase">Discovery Phase</option>
                                <option value="maintenance">Maintenance</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="sunsetted">Sunsetted</option>
                                <option value="pending approval">Pending Approval</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="form-group">
                            <label for="department-filter" class="form-label">Filter by Department</label>
                            <select id="department-filter" class="form-select">
                                <option value="">All Departments</option>
                                @foreach($allDepartments as $dept)
                                    <option value="{{ $dept }}">{{ $dept }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Projects Table -->
            <div class="tldr-table-shell table-responsive" data-aos="fade-up">
                <table id="projects-table" class="table table-hover mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th style="cursor: pointer;" class="sortable" data-sort="name">Project Name ⬍</th>
                            <th style="cursor: pointer;" class="sortable" data-sort="status">Status ⬍</th>
                            <th style="cursor: pointer;" class="sortable" data-sort="department">Department ⬍</th>
                        </tr>
                    </thead>
                    <tbody id="projects-tbody">
                        @forelse($allProjects as $project)
                            <tr class="project-row" data-status="{{ $project['status'] }}" data-department="{{ $project['department'] }}" data-client="{{ $project['client'] }}" data-category="{{ $project['is_grant'] ? 'research-enablement' : 'institutional-efficiencies' }}">
                                <td class="project-name">{{ $project['name'] }}</td>
                                <td>
                                    <span class="badge status-badge status-{{ Str::slug($project['status']) }}">
                                        {{ $project['status'] ?: '—' }}
                                    </span>
                                </td>
                                <td class="text-muted">{{ $project['department'] ?: '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">No projects found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <style>
        /* Hero Styles */
        .tldr-hero {
            background:
                radial-gradient(circle at top, rgba(77, 179, 255, 0.14), rgba(77, 179, 255, 0) 38%),
                linear-gradient(180deg, #05070c 0%, #0a1219 100%);
            padding-top: clamp(2.5rem, 7vh, 5rem);
            padding-bottom: clamp(3rem, 8vh, 5.5rem);
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .tldr-team-scroller-container {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            overflow: hidden;
            opacity: 0.2;
            pointer-events: none;
            z-index: 0;
        }

        .tldr-team-scroller-container-left {
            justify-content: flex-start;
            padding-left: 15vw;
        }

        .tldr-team-scroller-container-right {
            justify-content: flex-end;
            padding-right: 15vw;
        }

        .tldr-hero .container {
            position: relative;
            z-index: 2;
        }

        .tldr-hero-copy {
            max-width: 42rem;
            margin-inline: auto;
        }

        .tldr-video-container {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            background: #000;
            border-radius: 20px;
            overflow: hidden;
            border: 5px solid #fff;
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.45);
        }

        .tldr-video-container iframe {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        .tldr-eyebrow {
            letter-spacing: 0.18em;
            font-weight: 700;
            color: #7ec7ff;
            text-shadow: 0 0 16px rgba(126, 199, 255, 0.35);
        }

        .tldr-hero .lead {
            max-width: 40rem;
            color: rgba(255, 255, 255, 0.88);
            margin-left: auto;
            margin-right: auto;
        }

        .tldr-glance-row {
            background: linear-gradient(180deg, #0a141f 0%, #0f1e2f 100%);
            position: relative;
            z-index: 2;
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 1rem;
        }

        .tldr-glance-card {
            border-radius: 14px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 1.2rem 1rem;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            transition: transform 0.25s ease, border-color 0.25s ease, background 0.25s ease;
        }

        .tldr-glance-card:hover {
            transform: translateY(-2px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(77, 179, 255, 0.45);
        }

        .tldr-glance-icon {
            font-size: 1.5rem;
            color: #7ec7ff;
            margin-bottom: 0.65rem;
        }

        .tldr-glance-value {
            margin: 0;
            font-size: clamp(2rem, 3vw, 2.4rem);
            font-weight: 800;
            line-height: 1;
            color: #ffffff;
            letter-spacing: -0.02em;
        }

        .tldr-glance-label {
            margin: 0.55rem 0 0;
            font-family: "Proxima Nova", Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            font-size: 0.72rem;
            line-height: 1.42;
            color: rgba(220, 239, 255, 0.88);
        }

        .tldr-section-copy {
            max-width: 42rem;
            font-size: 1.02rem;
            line-height: 1.75;
            color: #577189;
        }

        .text-light-emphasis {
            color: rgba(255, 255, 255, 0.74) !important;
        }

        /* Stats Section */
        .tldr-stats {
            background:
                radial-gradient(circle at 18% 15%, rgba(77, 179, 255, 0.16) 0%, rgba(77, 179, 255, 0) 40%),
                linear-gradient(180deg, #f6fbff 0%, #ecf4fb 100%);
        }

        .tldr-stats-heading {
            font-family: 'area-normal', courier, 'Courier New', monospace;
            font-size: clamp(1.9rem, 4.5vw, 3.25rem);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #0e1a2b;
        }

        .tldr-stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 1rem;
        }

        .tldr-stat {
            text-align: center;
            padding: 1.5rem 1rem;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.72);
            border: 1px solid rgba(14, 26, 43, 0.08);
            box-shadow: 0 18px 40px rgba(14, 26, 43, 0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .tldr-stat:hover {
            transform: translateY(-4px);
            box-shadow: 0 22px 44px rgba(14, 26, 43, 0.12);
        }

        .tldr-stat-value {
            font-size: clamp(2.5rem, 6vw, 4.25rem);
            font-weight: 900;
            color: #0e1a2b;
            line-height: 1;
            margin-bottom: 0.65rem;
        }

        .tldr-stat-label {
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.12em;
            font-weight: 600;
            color: #4a7ba7;
            margin: 0;
        }

        /* Departments Section */
        .tldr-departments {
            background:
                linear-gradient(180deg, #08111c 0%, #0e1a2b 100%);
            position: relative;
            overflow: hidden;
            isolation: isolate;
        }

        .tldr-departments-project-scroller {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            opacity: 0.08;
            pointer-events: none;
            z-index: 0;
        }

        .tldr-departments .container {
            position: relative;
            z-index: 2;
        }

        .dept-count-badge {
            display: inline-grid;
            place-items: center;
            background: #fff;
            color: #000;
            min-width: 1.7em;
            height: 1.7em;
            border-radius: 5px;
            margin-left: 0.6em;
            vertical-align: middle;
            font-size: 0.64em;
            font-weight: 800;
            line-height: 1;
            padding: 0 0.5em;
            font-family: "Proxima Nova", Arial, Helvetica, sans-serif;
            font-variant-numeric: tabular-nums;
        }

        .tldr-cloud-panel {
            padding: clamp(1.5rem, 3vw, 2.5rem);
            border-radius: 24px;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.03);
        }

        .word-cloud-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem 1.25rem;
            align-items: center;
            max-width: 100%;
        }

        .word-cloud-item {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            animation: word-cloud-enter 0.4s ease;
            padding: 0;
            background: transparent;
            border: 0;
            cursor: pointer;
        }

        .word-cloud-trigger:focus-visible .word-cloud-badge {
            outline: 2px solid rgba(126, 199, 255, 0.9);
            outline-offset: 4px;
        }

        @keyframes word-cloud-enter {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .word-cloud-badge {
            background: transparent;
            border: 1px solid transparent;
            border-radius: 999px;
            padding: 0.45rem 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            font-size: var(--cloud-size, 1rem);
            font-weight: 600;
            color: #fff;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            line-height: 1;
            height: fit-content;
            max-width: 100%;
        }

        .word-cloud-item:hover .word-cloud-badge {
            background: #ffffff;
            color: #0e1a2b;
            border-color: rgba(255, 255, 255, 0.8);
            transform: translateY(-2px);
        }

        .project-count {
            background: transparent;
            color: currentColor;
            min-width: 1.25em;
            height: 1.25em;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.62em;
            font-weight: 700;
            line-height: 1;
            flex-shrink: 0;
            font-family: "Proxima Nova", Arial, Helvetica, sans-serif;
            font-variant-numeric: tabular-nums;
            opacity: 0.72;
        }

        /* Projects Section */
        .tldr-projects {
            background:
                linear-gradient(180deg, #f9fbfe 0%, #eef4fa 100%);
            scroll-margin-top: 2rem;
        }

        .tldr-filter-panel {
            background: rgba(255, 255, 255, 0.84);
            border: 1px solid rgba(14, 26, 43, 0.08);
            border-radius: 24px;
            box-shadow: 0 18px 40px rgba(14, 26, 43, 0.08);
            padding: 1.25rem;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-family: "Proxima Nova", Arial, Helvetica, sans-serif;
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #4a647b;
            margin-bottom: 0.55rem;
        }

        .form-select {
            min-height: 3rem;
            border-radius: 14px;
            border-color: rgba(14, 26, 43, 0.12);
            box-shadow: none;
            color: #0e1a2b;
        }

        .form-select:focus {
            border-color: rgba(77, 179, 255, 0.7);
            box-shadow: 0 0 0 0.2rem rgba(77, 179, 255, 0.15);
        }

        .category-buttons-group {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
            align-items: center;
        }

        .category-btn {
            background: #fff;
            border: 1px solid rgba(14, 26, 43, 0.12);
            border-radius: 999px;
            padding: 0.85rem 1.25rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #33485d;
            font-family: "Proxima Nova", Arial, Helvetica, sans-serif;
            font-weight: 600;
            font-size: 0.9rem;
            line-height: 1;
            cursor: pointer;
            transition: all 0.25s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .category-btn:hover {
            border-color: rgba(77, 179, 255, 0.45);
            color: #0e1a2b;
            transform: translateY(-1px);
        }

        .category-btn.active {
            background: #0e1a2b;
            border-color: #0e1a2b;
            color: #fff;
            box-shadow: 0 10px 24px rgba(14, 26, 43, 0.16);
        }

        .category-btn.active .dept-count-badge {
            background: rgba(255, 255, 255, 0.18);
            color: #fff;
        }

        .tldr-table-shell {
            background: #fff;
            border: 1px solid rgba(14, 26, 43, 0.08);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 18px 40px rgba(14, 26, 43, 0.08);
        }

        #projects-table {
            border-collapse: collapse;
            background: #fff;
        }

        #projects-table thead {
            background: #0e1a2b;
            color: #fff;
        }

        #projects-table th {
            font-family: "Proxima Nova", Arial, Helvetica, sans-serif;
            font-weight: 700;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 1rem 1.15rem;
            border: none;
        }

        #projects-table td {
            padding: 1rem 1.15rem;
            border-bottom: 1px solid #e8eef4;
            vertical-align: middle;
        }

        .project-row {
            transition: background 0.2s ease;
        }

        .project-row:hover {
            background: #f7fbff;
        }

        .project-name {
            font-weight: 600;
            color: #0e1a2b;
        }

        .status-badge {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.42rem 0.72rem;
            border-radius: 999px;
            font-family: "Proxima Nova", Arial, Helvetica, sans-serif;
        }

        .status-launched {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-being-built {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-discovery-phase {
            background-color: #fed7aa;
            color: #92400e;
        }

        .status-maintenance {
            background-color: #f3e8ff;
            color: #6b21a8;
        }

        .status-ongoing {
            background-color: #e0e7ff;
            color: #3730a3;
        }

        .status-sunsetted {
            background-color: #e5e7eb;
            color: #374151;
        }

        .status-pending-approval {
            background-color: #fef3c7;
            color: #92400e;
        }

        /* Responsive */
        @media (max-width: 991px) {
            .tldr-filter-panel {
                padding: 1rem;
            }
        }

        @media (max-width: 991px) {
            .tldr-stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .tldr-stat-grid {
                grid-template-columns: 1fr;
            }

            .tldr-cloud-panel {
                padding: 1rem;
            }

            .word-cloud-container {
                justify-content: flex-start;
                gap: 0.55rem;
            }

            .word-cloud-badge {
                font-size: min(var(--cloud-size, 1rem), 1rem);
                padding: 0.4rem 0.7rem;
                white-space: normal;
                line-height: 1.2;
                text-align: left;
            }

            .word-cloud-item {
                max-width: 100%;
            }

            .category-buttons-group {
                gap: 0.55rem;
            }

            .category-btn {
                width: 100%;
            }

            #projects-table {
                font-size: 0.85rem;
            }

            #projects-table td,
            #projects-table th {
                padding: 0.8rem 0.65rem;
            }
        }

        @media (max-width: 575px) {
            .tldr-glance-card {
                min-height: 125px;
            }
        }
    </style>

    @vite('resources/js/odometerAnimation.js')
    @vite('resources/js/photoScroller.js')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
            const teamScrollerContainer1 = document.getElementById('tldrTeamScrollerContainer1');
            const teamScrollerContainer2 = document.getElementById('tldrTeamScrollerContainer2');
            const teamScroller1Element = document.getElementById('tldrTeamScroller1');
            const teamScroller2Element = document.getElementById('tldrTeamScroller2');
            const departmentsProjectScrollerContainer = document.getElementById('tldrDepartmentsProjectScrollerContainer');
            const departmentsProjectScroller = document.getElementById('tldrDepartmentsProjectScroller');

            if (teamScrollerContainer1 && teamScrollerContainer2 && teamScroller1Element && teamScroller2Element && window.createPhotoScroller) {
                if (!prefersReducedMotion) {
                    window.createPhotoScroller({
                        selector: '#tldrTeamScroller1',
                        rows: 1,
                        aspectRatio: 1.5 / 1,
                        speed: 50,
                        gap: 70,
                        rowGap: 100,
                        maxImageWidth: 200,
                        direction: 85,
                        imageClass: 'photo-scroller-image',
                        wrapperClass: 'photo-box-effect'
                    });
                    teamScrollerContainer1.style.visibility = '';

                    window.createPhotoScroller({
                        selector: '#tldrTeamScroller2',
                        rows: 1,
                        aspectRatio: 1.5 / 1,
                        speed: 50,
                        gap: 70,
                        maxImageWidth: 200,
                        direction: -85,
                        imageClass: 'photo-scroller-image',
                        wrapperClass: 'photo-box-effect'
                    });
                    teamScrollerContainer2.style.visibility = '';
                } else {
                    teamScrollerContainer1.style.display = 'none';
                    teamScrollerContainer2.style.display = 'none';
                }
            }

            if (departmentsProjectScrollerContainer && departmentsProjectScroller && window.createPhotoScroller) {
                if (!prefersReducedMotion) {
                    window.createPhotoScroller({
                        selector: '#tldrDepartmentsProjectScroller',
                        rows: 2,
                        aspectRatio: 16 / 9,
                        speed: 20,
                        maxImageWidth: 400,
                        gap: 70,
                        rowGap: 100,
                        direction: -10,
                        imageClass: 'photo-scroller-image',
                        wrapperClass: 'photo-box-effect'
                    });
                    departmentsProjectScrollerContainer.style.visibility = '';
                } else {
                    departmentsProjectScrollerContainer.style.display = 'none';
                }
            }

            const categoryBtns = document.querySelectorAll('.category-btn');
            const wordCloudTriggers = document.querySelectorAll('.word-cloud-trigger');
            const projectsSection = document.getElementById('projects-section');
            const statusFilter = document.getElementById('status-filter');
            const deptFilter = document.getElementById('department-filter');
            const clientFilter = document.getElementById('client-filter');
            const tbody = document.getElementById('projects-tbody');
            const rows = document.querySelectorAll('.project-row');
            const sortables = document.querySelectorAll('.sortable');
            let selectedCategory = '';
            let forcedDepartment = '';

            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    categoryBtns.forEach(button => button.classList.remove('active'));
                    this.classList.add('active');
                    selectedCategory = this.dataset.category;
                    applyFilters();
                });
            });

            if (categoryBtns[0]) {
                categoryBtns[0].classList.add('active');
            }

            wordCloudTriggers.forEach(trigger => {
                trigger.addEventListener('click', function() {
                    const clickedDepartment = (this.dataset.department || '').trim();

                    selectedCategory = '';
                    categoryBtns.forEach(btn => btn.classList.remove('active'));

                    if (categoryBtns[0]) {
                        categoryBtns[0].classList.add('active');
                    }

                    statusFilter.value = '';

                    // Match option values case-insensitively in case source strings differ slightly.
                    const matchingOption = Array.from(deptFilter.options).find(option => {
                        return option.value.trim().toLowerCase() === clickedDepartment.toLowerCase();
                    });

                    if (matchingOption) {
                        deptFilter.value = matchingOption.value;
                        forcedDepartment = '';
                    } else {
                        deptFilter.value = '';
                        forcedDepartment = clickedDepartment;
                    }

                    if (clientFilter) {
                        clientFilter.value = '';
                    }

                    applyFilters();

                    if (projectsSection) {
                        projectsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });

            function applyFilters() {
                const selectedStatus = statusFilter.value.toLowerCase();
                const selectedDept = (deptFilter.value || forcedDepartment || '').trim();
                //const selectedClient = clientFilter.value;

                rows.forEach(row => {
                    const rowCategory = row.dataset.category;
                    const rowStatus = row.dataset.status.toLowerCase();
                    const rowDept = (row.dataset.department || '').trim();
                    const rowClient = row.dataset.client;

                    const categoryMatch = !selectedCategory || rowCategory === selectedCategory;
                    const statusMatch = !selectedStatus || rowStatus === selectedStatus;
                    const deptMatch = !selectedDept || rowDept.toLowerCase() === selectedDept.toLowerCase();
                    //const clientMatch = !selectedClient || rowClient === selectedClient;

                    row.style.display = categoryMatch && statusMatch && deptMatch ? '' : 'none';
                });
            }

            statusFilter.addEventListener('change', applyFilters);
            deptFilter.addEventListener('change', function() {
                forcedDepartment = '';
                applyFilters();
            });
            //clientFilter.addEventListener('change', applyFilters);

            // Sort functionality
            sortables.forEach(header => {
                header.addEventListener('click', function() {
                    const sortKey = this.dataset.sort;
                    const isAsc = this.classList.contains('asc');
                    
                    // Remove active state from all headers
                    sortables.forEach(h => h.classList.remove('asc', 'desc'));
                    
                    // Set new state
                    this.classList.toggle('desc', isAsc);
                    this.classList.toggle('asc', !isAsc);

                    // Sort rows
                    const sortedRows = Array.from(rows).sort((a, b) => {
                        let aVal = '';
                        let bVal = '';

                        if (sortKey === 'name') {
                            aVal = a.querySelector('.project-name').textContent.toLowerCase();
                            bVal = b.querySelector('.project-name').textContent.toLowerCase();
                        } else if (sortKey === 'status') {
                            aVal = a.dataset.status.toLowerCase();
                            bVal = b.dataset.status.toLowerCase();
                        } else if (sortKey === 'department') {
                            aVal = a.dataset.department.toLowerCase();
                            bVal = b.dataset.department.toLowerCase();
                        }

                        return isAsc ? aVal.localeCompare(bVal) : bVal.localeCompare(aVal);
                    });

                    // Clear and repopulate tbody
                    tbody.innerHTML = '';
                    sortedRows.forEach(row => tbody.appendChild(row));
                });
            });
        });
    </script>
@endsection
