
// DIRI NGA PART IS ANG FUNCTIONALITY SA LATEST JOBS/TOP JOBS NGA BUTTON - no need to adjust na dis
function toggleActive(button) {
    if (button === 'latestJobs') {
      document.getElementById('latestJobsBtn').classList.add('active');
      document.getElementById('topJobsBtn').classList.remove('active');
      document.getElementById('latestJobsCarousel').style.display = 'block';
        document.getElementById('topJobsCarousel').style.display = 'none';
    } else {
      document.getElementById('topJobsBtn').classList.add('active');
      document.getElementById('latestJobsBtn').classList.remove('active');
      document.getElementById('topJobsCarousel').style.display = 'block';
        document.getElementById('latestJobsCarousel').style.display = 'none';
    }
  }
// ---------------------------------------------------------------------

// VVVVVVVVVVVVVVVV DIRI SA UBOS ang functionality sa responsive nga cards  

  document.addEventListener('DOMContentLoaded', function () {
    const screenWidth = window.innerWidth;

    if (screenWidth <= 768) {
        const latestCarouselItems = document.querySelectorAll('#latestJobsCarousel .carousel-item');
        const topCarouselItems = document.querySelectorAll('#topJobsCarousel .carousel-item');

        latestCarouselItems.forEach(item => {
            const childCards = Array.from(item.querySelectorAll('.col-md-4'));
            if (childCards.length > 1) {
                childCards.forEach((card, index) => {
                    const newItem = document.createElement('div');
                    newItem.className = `carousel-item ${index === 0 ? 'active' : ''}`;
                    newItem.appendChild(card);
                    item.parentNode.insertBefore(newItem, item.nextSibling);
                });
                item.remove(); 
            }
        });

        topCarouselItems.forEach(item => {
            const childCards = Array.from(item.querySelectorAll('.col-md-4'));
            if (childCards.length > 1) {
                childCards.forEach((card, index) => {
                    const newItem = document.createElement('div');
                    newItem.className = `carousel-item ${index === 0 ? 'active' : ''}`;
                    newItem.appendChild(card);
                    item.parentNode.insertBefore(newItem, item.nextSibling);
                });
                item.remove();
            }
        });
    }

    new bootstrap.Carousel('#latestJobsCarousel', {
        interval: 2000,
        wrap: true
    });
    new bootstrap.Carousel('#topJobsCarousel', {
        interval: 2000,
        wrap: true
    });
});

