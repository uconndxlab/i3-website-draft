  <!--banner-->
  <div id="uc-header">
    <div id="uconn-banner" class="alternative">
        <div id="uconn-header-container" class="white">
            <div class="row-container container">
                <div class="row-fluid">
                    <div id="home-link-container">
                        <a id="home-link" href="https://uconn.edu/">
                            <span id="wordmark" aria-hidden="false">UConn</span>
                        </a>
                        <a id="home-link" href="https://uconn.edu/">
                            <span class="no-css">University of Connecticut school of</span>
                            <span id="university-of-connecticut">University of Connecticut</span>
                        </a>
                    </div>

                    <div id="button-container">
                        <div class="icon-container" id="icon-container-search">
                            <a id="uconn-search" class="btn" href="https://uconn.edu/search">
                                <span class="no-css">Search University of Connecticut</span>

                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20"
                                    viewBox="0 0 32 32" aria-hidden="true" class="banner-icon">
                                    <title>Search UConn</title>
                                    <path
                                        d="M28.072 24.749l-6.046-6.046c0.912-1.499 1.437-3.256 1.437-5.139 0-5.466-4.738-10.203-10.205-10.203-5.466 0-9.898 4.432-9.898 9.898 0 5.467 4.736 10.205 10.203 10.205 1.818 0 3.52-0.493 4.984-1.349l6.078 6.080c0.597 0.595 1.56 0.595 2.154 0l1.509-1.507c0.594-0.595 0.378-1.344-0.216-1.938zM6.406 13.258c0-3.784 3.067-6.853 6.851-6.853 3.786 0 7.158 3.373 7.158 7.158s-3.067 6.853-6.853 6.853-7.157-3.373-7.157-7.158z">
                                    </path>
                                </svg>
                            </a>
                            <div id="uconn-search-tooltip" style="z-index: 99999 !important"></div>
                        </div>

                        <div class="icon-container" id="icon-container-az">
                            <a class="btn" id="uconn-az" href="https://uconn.edu/az"
                                aria-haspopup="true" aria-controls="a-z-popup" aria-expanded="false">
                                <span class="no-css">A to Z Index</span>

                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg" width="20"
                                    viewBox="0 0 32 32" aria-hidden="true" class="banner-icon">
                                    <title>UConn A to Z Index</title>
                                    <path
                                        d="M5.345 8.989h3.304l4.944 13.974h-3.167l-0.923-2.873h-5.147l-0.946 2.873h-3.055l4.989-13.974zM5.152 17.682h3.579l-1.764-5.499-1.815 5.499zM13.966 14.696h5.288v2.56h-5.288v-2.56zM20.848 20.496l7.147-9.032h-6.967v-2.474h10.597v2.341l-7.244 9.165h7.262v2.466h-10.798v-2.466h0.004z">
                                    </path>
                                </svg>
                            </a>
                            <div id="uconn-az-tooltip" style="z-index: 99999 !important"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  <header class="position-sticky top-0 z-3 py-3">
    <nav class="navbar navbar-expand-lg" style="padding:0px;">
      <div class="container">
        <div>
            <h1 class="header-level-one">
                <a href="/" class="link-offset-1">
                    Internal Insights & Innovation
                </a>
            </h1>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#i3navbarContent"
          aria-controls="i3navbarContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse flex-grow-0" id="i3navbarContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('team') }}">People</a>

            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('projects.index')}}">Projects</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('story')}}">Story</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('connect')}}">Connect with Us</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>