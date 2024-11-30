document.addEventListener("DOMContentLoaded", () => {
    //const carousel = document.querySelector('.carousel');
    const items = document.querySelectorAll('.vinilo-item');
    const totalItems = items.length;

    let index = 0;

    /*const itemWidth = items[0].offsetWidth + parseInt(window.getComputedStyle(items[0]).marginRight);   
    const carouselWidth = itemWidth * totalItems;*/

    const showItems = () => {
        items.forEach (item => { item.style.display = 'none';
                                 item.style.opacity = 0;
                                 item.style.transition = 'opacity 0.5s ease';
        });

        for (let i = index; i < index + 4; i++) {
            if (i < totalItems) {
                items[i].style.display = 'block';
                setTimeout(() => {
                    items[i].style.opacity = 1;
                }, 10)
            } 
        }
    };

    const moveSlide = direction => {
        if (direction === -1) {
            index--;
            if (index < 0) {
                index = totalItems - 4;
            }
        } else  if (direction === 1) {
            index++;
            if (index + 4 > totalItems) {
                index = 0;
            }
        }
        showItems();
    };

    showItems();

    const prevBtn = document.querySelector('.carousel-btn.prev');
    const nextBtn = document.querySelector('.carousel-btn.next');

    prevBtn.addEventListener('click', () => moveSlide(-1));
    nextBtn.addEventListener('click', () => moveSlide(1));

});