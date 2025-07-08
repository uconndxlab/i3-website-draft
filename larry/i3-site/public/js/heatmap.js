const cellSize = 11;
const cellMargin = 4;
const weekCount = 52; 
const monthGap = 15;

const colors = ["#ebedf0", "#9ecae1", "#6baed6", "#4292c6", "#08519c"];

const CONFIG = {
    organization: 'uconndxlab',
    year: 2025,
};

let today, startDate;

if (CONFIG.year == new Date().getFullYear()) {
    today = new Date();
    startDate = new Date(today.getFullYear(), 0, 1);
} else {
    startDate = new Date(CONFIG.year, 0, 1); 
    today = new Date(CONFIG.year, 11, 31);
}

document.getElementById('contribution-year').textContent = " in " + CONFIG.year;

// Setup dimensions for the visualization
const width = weekCount * (cellSize + cellMargin) + 30;
const height = 7 * (cellSize + cellMargin) + 30;

// Create the SVG element
const svg = d3.select("#calendar")
    .append("svg")
    .attr("width", width)
    .attr("height", height + 50) // Add extra space for legend
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
    const endDate = new Date(CONFIG.year, 11, 31); 
    for (let d = new Date(startDate); d <= endDate; d.setDate(d.getDate() + 1)) {
        const dateStr = d.toISOString().split('T')[0];
        dates.push({
            date: new Date(d),
            count: 0 // Initialize with zero contributions
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
        .append("rect")
        .attr("class", "day")
        .attr("width", cellSize)
        .attr("height", cellSize)
        .attr("rx", 2)
        .attr("ry", 2)
        .attr("x", (d, i) => {
            const weekNum = Math.floor(i / 7);
            return weekNum * (cellSize + cellMargin) + 30;
        })
        .attr("y", (d, i) => {
            const dayOfWeek = d.date.getDay();
            return dayOfWeek * (cellSize + cellMargin) + 20;
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

// Draw the legend
function drawLegend() {
    const legendX = width - 120; 
    const legendY = height + 20; 
    
    svg.append("text")
        .attr("class", "legend-label")
        .attr("x", legendX - 35)
        .attr("y", legendY + 3)
        .text("Less");
        
    svg.append("text")
        .attr("class", "legend-label")
        .attr("x", legendX + 75)
        .attr("y", legendY + 3)
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
        
        // Update total contributions count
        document.getElementById('contribution-count').textContent = 
            data.totalContributions.toLocaleString() + " contributions";
        document.getElementById('contribution-year').textContent = " in " + CONFIG.year;
        
        // Convert the data format
        const contributionsData = {};
        for (const [date, count] of Object.entries(data.contributionsByDay)) {
            contributionsData[date] = count;
        }
        
        return contributionsData;
    } catch (error) {
        console.error('Error loading contribution data:', error);
        // Return empty data object, not random data
        return {};
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
    
    const dates = generateDates();
    // Update counts with actual data
    dates.forEach(d => {
        const dateStr = d.date.toISOString().split('T')[0];
        d.count = contributionsData[dateStr] || 0;
    });
    
    // Update cell colors
    svg.selectAll(".day")
        .data(dates)
        .attr("fill", d => colorScale(d.count))
        .on("mouseover", function(event, d) {
            const dateStr = d.date.toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric', 
                year: 'numeric'
            });
            
            const countText = d.count === 1 ? "1 contribution" : `${d.count} contributions`;
            
            tooltip.html(`${dateStr}: ${countText}`)
                .style("left", (event.pageX + 10) + "px")
                .style("top", (event.pageY - 30) + "px")
                .style("opacity", 1);
        });
}

// Initialize the heatmap
async function initializeHeatmap() {
    console.log("Initializing GitHub contribution heatmap");
    
    // First create an empty heatmap skeleton
    createEmptyHeatmap();
    
    try {
        // Then try to load real data
        const contributionsData = await loadContributionData();
        
        // Check if we got actual data
        const hasData = Object.keys(contributionsData).length > 0;
        
        if (hasData) {
            // Update the visualization with real data
            updateHeatmapWithData(contributionsData);
        } else {
            console.log("No contribution data available, showing empty heatmap");
            // const randomData = generateRandomContributionData();
            // updateHeatmapWithData(randomData);
        }
    } catch (error) {
        console.error("Failed to initialize heatmap:", error);
        console.log("Skipping data as fallback");
        // const randomData = generateRandomContributionData();
        // updateHeatmapWithData(randomData);
    }
}

// Call the function to start
initializeHeatmap();
