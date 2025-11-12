@extends('pages.blogs.backgrounds.blogs')

@section('og_title')
    Brewing Innovation: How Design Thinking Shaped UConn Brewing Innovation
@endsection

@section('og_description')
    Learn how Greenhouse Studios used design thinking sprints to help scale up UConn's brewing science course into a larger initiative that provides life-transformative education experiences for undergraduates.
@endsection

@section('og_image')
    {{ asset('storage/post_images/brewconn-img1-can-label.jpeg') }}
@endsection

@section('twitter_title')
    Brewing Innovation: How Design Thinking Shaped UConn Brewing Innovation
@endsection

@section('twitter_description')
    Learn how Greenhouse Studios used design thinking sprints to help scale up UConn's brewing science course into a larger initiative.
@endsection

@section('twitter_image')
    {{ asset('storage/post_images/brewconn-feat-img_1762980428_medium.webp') }}
@endsection

@section('blog-content')
    <div class="clearfix" style="padding-top: 2rem;">
        <i>This post has been adapted and revised from its original version, first published on the Greenhouse Studios blog in November 2024. </i>
    </div>
    <div class="d-lg-flex gap-4 align-items-center py-4">
        <div class="flex-shrink-0 mb-3 mb-lg-0 d-lg-flex" style="width: 260px;">
            <img src="{{ asset('storage/post_images/brewconn-img1-can-label.jpeg') }}"
                 alt="BrewConn Can Label"
                 class="img-fluid rounded shadow" 
                 style="width: 250px;">
        </div>
        <div>
            <p class="mb-4">Last month, Kinsmen Brewing Company in Southington held an event to launch BrewConn, a new, student-designed IPA. The night also saw the official launch of UConn Brewing Innovation, a new initiative that seeks to provide unique educational opportunities around the science and business of brewing, while also collaborating with and supporting Connecticut’s growing craft brew industry. One of the most exciting things about these developments is that much of the work began earlier this year with a diverse group of people gathered around a table in Greenhouse Studios (formerly located in the Homer Babbidge Library).</p>
        </div>
    </div>
    
    <div class="py-4">
        <p class="mb-0">UConn Brewing Innovation originates in a popular brewing science class taught by Jennifer Pascal, associate professor in the Department of Chemical and Biomolecular Engineering. Wanting to develop the class into something larger, Pascal teamed up with her colleague, Pete Menard, Director of Technical Services in the College of Engineering and a longtime homebrewer. Under a program overseen by UConn’s Life Transformative Education (LTE) initiative, Pascal and Menard’s project was selected to undergo a design thinking sprint led by Greenhouse Studios. The principal charge for our design sprint was to figure out how to scale up the brewing course into a larger initiative that could provide life-transformative education experiences for a much larger number of UConn undergraduates.</p>
    </div>

    <h2>Assembling a Team</h2>

    <div class="clearfix mt-4">
        <img src="{{ asset('storage/post_images/brewconn-img3-team.jpeg') }}" alt="Team Meeting" class="img-fluid rounded shadow mb-3 me-lg-4 float-lg-start" style="width: 360px;">
        <p>In addition to planning the activities that would take place during the sprint, one of our first tasks was to assemble a diverse team of collaborators. The strength of Pascal and Menard’s proposal suggested that the project could draw support not just from the College of Engineering, but also from other schools and colleges at UConn. Given the university’s <a href="https://cahnr.uconn.edu/history/#:~:text=College%20History&text=The%20College%20of%20Agriculture%2C%20Health%20and%20Natural%20Resources%20(CAHNR),original%20land%20grant%20university%20system.">long heritage as an agricultural school</a> and its particular strengths in agricultural science, it was clear to us that <a href="https://cahnr.uconn.edu/">CAHNR</a> could play an important role going forward. To that end, we were fortunate to add <a href="https://cahnr.uconn.edu/person/richard-meinert/">Rich Meinert</a> and <a href="https://psla.uconn.edu/person/nicholas-goltz/">Nick Goltz</a> to the project team.</p>
        <p>Likewise, we hoped to draw from UConn’s award-winning Dining Services department, especially as we began thinking about the possibility of having an on-campus brewery or tap room. <a href="https://dining.uconn.edu/contact-us/">Andy Iverson</a> not only brought expertise in food service management, but also happened to be a knowledgeable craft beer enthusiast. Finally, we understood that an essential piece of the puzzle would be someone with expertise in business and entrepreneurship. The first person that came to mind was <a href="https://www.business.uconn.edu/person/jennifer-mathieu/">Jennifer Mathieu</a>, Executive Director of the <a href="https://ccei.uconn.edu/">Connecticut Center for Entrepreneurship and Innovation (CCEI)</a>. (Our relationship with CCEI dates to 2019, when we participated in <a href="https://accelerate.uconn.edu/">Accelerate UConn for the <a href="https://sourceryapp.org/">Sourcery project</a>.)</p>
    </div>

    <h2 class="mt-4">Design Thinking for Scaling Up</h2>

    <div class="clearfix mt-4">
        <img src="{{ asset('storage/post_images/brewconn-img4-headlines.png') }}" alt="Headlines from the Future" class="img-fluid rounded shadow mb-3 ms-lg-4 float-lg-end" style="width: 320px;">
        <p>The sprint sessions were scheduled on five separate days over the course of two weeks. In the first half of the design sprint, we led the team through exercises that facilitated divergent thinking and open ideation about the forms the project could take. In an activity called <a href="https://miro.com/app/board/uXjVPhnuB9U=/?share_link_id=988066318601">“Headlines from the Future,”</a> the team was also tasked with imagining what success might look like five years down the road, and asked to imagine what a UConn student might say about how the project impacted their undergraduate education. In addition, the team cataloged the various networks available to them – both at UConn and beyond – as well as their resources and constraints, both individually and institutionally. We also led the team through a process of empathy mapping, where the team thinks imaginatively and broadly about the needs of specific stakeholders, including students, faculty, parents, administrators, and alumni.</p>
    </div>

    <div class="row g-4 mt-2">
        <div class="col-12 col-lg-6">
            <img src="{{ asset('storage/post_images/brewconn-img5-map.png') }}" alt="Empathy Mapping" class="img-fluid rounded shadow w-100">
        </div>
        <div class="col-12 col-lg-6">
            <img src="{{ asset('storage/post_images/brewconn-img6-canvas.png') }}" alt="Canvas" class="img-fluid rounded shadow w-100">
        </div>
    </div>
    <div class="clearfix mt-4">
    <p>During the second half of the design sprint, we had the team begin thinking more concretely and convergently about the direction they might go. After the open-ended, constraint-free ideation undertaken in the early part of the sprint, we asked the team to narrow their vision for the project and focus on the areas that seemed to have the most possibility. In order to develop a more concrete vision for the project, we asked the team to “Make it Visual” by creating a visual representation of the future project. Using images from the web, emoji, and stickers, the team visualized everything from the décor of the proposed taproom and its geographic location on campus, to possible marketing materials and artwork for the cans. </p>
    </div>

    <h2 class="mt-4">Putting it all Together</h2>
    <p>What often happens in design thinking work like this, is that the project team will develop a lot of good ideas and think creatively about what they might like to do, but at the end of the sprint the facilitators go away and the client or project team is left to pick up the pieces and figure out what to do next. To keep the project moving forward, the team’s final task was to begin drafting a comprehensive project proposal that they would come back and present a few weeks later to university administrators with a view toward gaining additional funding and support. </p>

    <img src="{{ asset('storage/post_images/brewconn-img7-sprint.png') }}" alt="Sprint Board" class="img-fluid rounded shadow w-100">
    <div class="clearfix mt-4">
        <p>With this eventuality in mind, we constructed the design process, from start to finish, so that all the work the team undertook over the five days of the sprint would inform the project proposal. In fact, each activity of the sprint sessions was designed to directly feed into the different sections of the proposal template we drew up for the team. For instance, the section of the proposal concerned with “Stakeholders” drew directly from the Day 3 empathy mapping exercise. Meanwhile, the “Work Plan and Budget” section of the proposal was informed by insights gained during the “Two Radically Different Project Visions” exercise and the catalog of “Resources and Constraints” undertaken on Day 2 and Day 3 of the sprint. 
    </div>
  
    <div class="clearfix mt-4">
        <p>
            Our team has continuously refined our design process, previously working almost exclusively on academic research projects. However, this scaling sprint gave us the chance to take what we have learned about collaboration and adapt it to a non-academic project. The success of the brewery project – now UConn Brewing Innovation – is ultimately due to the hard work and creativity of the project team members. But its success has also shown us that our expertise in collaboration and design thinking can be generalized to a much broader range of projects, something we look forward to doing more of in the future. </
        </p>
    </div>
<!-- Think for now lets keep style in the backgrounds/blogs.blade.php file so its universal -->
@endsection