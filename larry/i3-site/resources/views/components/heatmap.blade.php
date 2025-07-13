<div class="contributions-summary">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="currentColor">
        <path fill-rule="evenodd" d="M1.643 3.143L.427 1.927A.25.25 0 000 2.104V5.75c0 .138.112.25.25.25h3.646a.25.25 0 00.177-.427L2.715 4.215a6.5 6.5 0 11-1.18 4.458.75.75 0 10-1.493.154 8.001 8.001 0 101.6-5.684zM7.75 4a.75.75 0 01.75.75v2.992l2.028.812a.75.75 0 01-.557 1.392l-2.5-1A.75.75 0 017 8.25v-3.5A.75.75 0 017.75 4z"></path>
    </svg>
    <span id="contribution-count">0 contributions</span> <span id="contribution-year">in 2025</span>
</div>
<div id="calendar"></div>

<script src="https://d3js.org/d3.v7.min.js"></script>
<script src="{{ asset('js/heatmap.js') }}"></script>

<style>
    .contributions-summary {
        background-color: #f1f8ff;
        border-radius: 6px;
        padding: 8px 12px;
        display: inline-block;
        margin-bottom: 10px;
        color: #0366d6;
        position: relative;
        left: 30px;
    }

    .day {
        shape-rendering: geometricPrecision;
    }

    .month-label {
        font-size: 12px;
        fill: #767676;
    }

    .legend-label {
        font-size: 12px;
        fill: #767676;
    }
</style>
