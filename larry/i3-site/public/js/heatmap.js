const cellSize = 14;
const cellMargin = 6;
const weekCount = 52; 
const monthGap = 15;

const colors = ["#ebedf0", "#9ecae1", "#6baed6", "#4292c6", "#08519c"];

const CONFIG = {
    organization: 'uconndxlab',
    year: 2025,
};

let today, startDate, endDate;

if (CONFIG.year === new Date().getFullYear()) {
    today = new Date();
    startDate = new Date(today.getFullYear(), 0, 1); // January 1 of the current year
    endDate = new Date(today.getFullYear(), 11, 31); // December 31 of the current year
} else {
    startDate = new Date(CONFIG.year, 0, 1); // January 1 of the selected year
    endDate = new Date(CONFIG.year, 11, 31); // December 31 of the selected year
    today = endDate; // Set today to the last day of the selected year
}

document.getElementById('contribution-year').textContent = " in " + CONFIG.year;

// Setup dimensions for the visualization
const width = weekCount * (cellSize + cellMargin) + 30;
const height = 7 * (cellSize + cellMargin) + 30;

// Create the SVG element
const svg = d3.select("#calendar")
    .append("svg")
    .attr("width", '100%')
    // .attr("height", height + 50) // Add extra space for legend
    .attr("viewBox", `0 0 ${width} ${height + 50}`)
    .attr("fill", "none");

// Create tooltip
const tooltip = d3.select("body").append("div")
    .attr("class", "tooltip")
    .style("position", "absolute")
    .style("background", "rgba(0,0,0,0.8)")
    .style("color", "white")
    .style("padding", "5px 10px")
    .style("border-radius", "3px")
    .style("font-size", "12px")
    .style("pointer-events", "none")
    .style("opacity", 0);

// Set up color scale
const colorScale = d3.scaleThreshold()
    .domain([1, 3, 6, 10])
    .range(colors);

// Generate dates for the entire year
function generateDates() {
    const dates = [];
    for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
        const dateStr = d.toISOString().split('T')[0];
        dates.push({
            date: new Date(d),
            count: 0
        });
    }
    return dates;
}

// Create initial empty heatmap
function createEmptyHeatmap() {
    console.log("Creating empty heatmap skeleton");
    const dates = generateDates();
    
    // Draw day cells
    svg.selectAll(".day")
        .data(dates)
        .enter()
        .append("circle") // Change from <rect> to <circle>
        .attr("class", "day")
        .attr("r", cellSize / 2) // Set radius to half the cell size
        .attr("cx", d => {
            const weekNum = d3.timeWeek.count(d3.timeYear(d.date), d.date);
            return weekNum * (cellSize + cellMargin) + 30 + cellSize / 2; // Adjust for circle center
        })
        .attr("cy", d => {
            const dayOfWeek = d.date.getDay();
            return dayOfWeek * (cellSize + cellMargin) + 20 + cellSize / 2; // Adjust for circle center
        })
        .attr("fill", colors[0]) // Use lightest color for empty cells
        .on("mouseover", function(event, d) {
            const dateStr = d.date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });
            
            const countText = "0 contributions";
            
            tooltip.html(`${dateStr}: ${countText}`)
                .style("left", (event.pageX + 10) + "px")
                .style("top", (event.pageY - 30) + "px")
                .style("opacity", 1);
        })
        .on("mouseout", function() {
            tooltip.style("opacity", 0);
        });
    
    // Draw month labels    
    const months = d3.timeMonths(startDate, today);
    svg.selectAll(".month-label")
        .data(months)
        .enter()
        .append("text")
        .attr("class", "month-label")
        .attr("x", (d, i) => {
            const firstDayOfMonth = new Date(d);
            const daysSinceStart = Math.floor((firstDayOfMonth - startDate) / (24 * 60 * 60 * 1000));
            const weekNum = Math.floor(daysSinceStart / 7);
            return weekNum * (cellSize + cellMargin) + 30;
        })
        .attr("y", 10)
        .text(d => d.toLocaleDateString('en-US', { month: 'short' }));
    
    // Draw legend
    drawLegend();
}

// draw day of week labels
const daysOfWeek = ['Su', 'M', 'T', 'W', 'Th', 'F', 'Sa'];
svg.selectAll(".day-label")
    .data(daysOfWeek)
    .enter()
    .append("text")
    .attr("class", "day-label")
    .attr("x", 0)
    .attr("y", (d, i) => i * (cellSize + cellMargin) + 20 + cellSize / 2 + 4) // +4 for vertical centering
    .text(d => d)
    .attr("font-size", "10px")
    .attr("fill", "#666");

// Draw the legend
function drawLegend() {
    const legendX = width - 250; 
    const legendY = height + 20; 
    
    svg.append("text")
        .attr("class", "legend-label")
        .attr("x", legendX - 35)
        .attr("y", legendY + 4)
        .text("Less");
        
    svg.append("text")
        .attr("class", "legend-label")
        .attr("x", legendX + 100)
        .attr("y", legendY + 4)
        .text("More");
        
    svg.selectAll(".legend-item")
        .data(colors)
        .enter()
        .append("rect")
        .attr("class", "legend-item")
        .attr("width", cellSize)
        .attr("height", cellSize)
        .attr("rx", 2)
        .attr("ry", 2)
        .attr("x", (d, i) => legendX + i * (cellSize + cellMargin))
        .attr("y", legendY - 7)
        .attr("fill", d => d);
}

// Load contribution data
async function loadContributionData() {
    try {
        const dataFile = `data/github-contributions-${CONFIG.organization}-${CONFIG.year}.json`;
        console.log(`Attempting to load data from: ${dataFile}`);
        
        const response = await fetch(dataFile);
        if (!response.ok) {
            console.warn(`Failed to load data: ${response.status} ${response.statusText}`);
            throw new Error(`Failed to load data: ${response.status} ${response.statusText}`);
        }
        
        const data = await response.json();
        console.log(`Successfully loaded contribution data for ${CONFIG.organization} (${CONFIG.year})`);
        
        return data.contributionsByDay;
    } catch (error) {
        console.error('Error loading contribution data:', error);
        return {}; // Return empty data object
    }
}

// Generate fallback random data - only used if explicitly called
function generateRandomContributionData() {
    console.log("Generating random fallback data");
    const randomData = {};
    for (let d = new Date(startDate); d <= today; d.setDate(d.getDate() + 1)) {
        const dateStr = d.toISOString().split('T')[0];
        const rand = Math.random();
        if (rand < 0.3) randomData[dateStr] = 0;
        else if (rand < 0.6) randomData[dateStr] = Math.floor(Math.random() * 3) + 1;
        else if (rand < 0.85) randomData[dateStr] = Math.floor(Math.random() * 5) + 3;
        else randomData[dateStr] = Math.floor(Math.random() * 10) + 8;
    }
    return randomData;
}

// Update the visualization with real data
function updateHeatmapWithData(contributionsData) {
    console.log("Updating heatmap with contribution data");

    document.querySelector('#contribution-count').innerHTML = Object.values(contributionsData).reduce((sum, count) => sum + count, 0) + " GitHub commits";

    // Update existing cells instead of rebinding data
    svg.selectAll(".day")
        .attr("fill", function(d) {
            const dateStr = d.date.toISOString().split('T')[0];
            const count = contributionsData[dateStr] || 0;
            return colorScale(count);
        })
        .on("mouseover", function(event, d) {
            const dateStr = d.date.toLocaleDateString('en-US', {
                weekday: 'short',
                month: 'short', 
                day: 'numeric',
                year: 'numeric'
            });
            
            const dateKey = d.date.toISOString().split('T')[0];
            const count = contributionsData[dateKey] || 0;
            const countText = count === 1 ? "1 contribution" : `${count} contributions`;
            
            tooltip.html(`${dateStr}: ${countText}`)
                .style("left", (event.pageX + 10) + "px")
                .style("top", (event.pageY - 30) + "px")
                .style("opacity", 1);
        })
        .on("mouseout", function() {
            tooltip.style("opacity", 0);
        });
}

// Initialize the heatmap
async function initializeHeatmap() {
    console.log("Initializing GitHub contribution heatmap");
    
    // First create an empty heatmap skeleton
    createEmptyHeatmap();
    
    try {
        // Load real data
        const contributionsData = await loadContributionData();
        
        if (Object.keys(contributionsData).length > 0) {
            // Update the visualization with real data
            updateHeatmapWithData(contributionsData);
        } else {
            console.log("No contribution data available, showing empty heatmap");
        }
    } catch (error) {
        console.error("Failed to initialize heatmap:", error);
    }
}

// Call the function to start
initializeHeatmap();
