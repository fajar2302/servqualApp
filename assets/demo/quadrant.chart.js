const data = {
  datasets: [
    {
      label: 'Dataset 1',
      data: [
        { x: 4, y: 10 },
        { x: -10, y: 5 },
        { x: 5, y: -5 },
      ],
      borderColor: 'red',
      backgroundColor: 'red',
    },
  ],
};
const quadrants = {
  id: 'quadrants',
  beforeDraw(chart, args, options) {
    const {
      ctx,
      chartArea: { left, top, right, bottom },
      scales: { x, y },
    } = chart;
    const midX = x.getPixelForValue(0);
    const midY = y.getPixelForValue(0);
    ctx.save();
    ctx.fillStyle = options.topLeft;
    ctx.fillRect(left, top, midX - left, midY - top);
    ctx.fillStyle = options.topRight;
    ctx.fillRect(midX, top, right - midX, midY - top);
    ctx.fillStyle = options.bottomRight;
    ctx.fillRect(midX, midY, right - midX, bottom - midY);
    ctx.fillStyle = options.bottomLeft;
    ctx.fillRect(left, midY, midX - left, bottom - midY);
    ctx.restore();
  },
};
const config = {
  type: 'scatter',
  data: data,
  options: {
    plugins: {
      quadrants: {
        topLeft: 'white',
        topRight: 'blue',
        bottomRight: 'green',
        bottomLeft: 'yellow',
      },
    },
  },
  plugins: [quadrants],
};
const ctx = document.getElementById('myChart');
new Chart(ctx, config);
