document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll('.vinilo-item');
    const totalItems = items.length;

    let index = 0;

    /*const showItems = () => {
        items.forEach (item => {item.style.display = 'none';
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
    };*/

    const showItems = () => {
        const width = window.innerWidth;
        let itemsVisible = 4;

        if (width < 768) {
            itemsVisible = 1;
        } else if (width < 1024) {
            itemsVisible = 2;
        } else if (width < 1440) {
            itemsVisible = 3;
        }

        items.forEach (item => {
            item.style.display = 'none';
            item.style.opacity = 0;
            item.style.transition = 'opacity 0.5s ease';
        });

        for (let i = index; i < index + itemsVisible; i++) {
            if (i < totalItems) {
                items[i].style.display = 'block';
                setTimeout(() => {
                    items[i].style.opacity = 1;
                }, 10);
            }
        }

    }

    /*const moveSlide = direction => {
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
    };*/

    const moveSlide = direction => {
        const width = window.innerWidth;
        let itemsVisible = 4;

        if (width < 768) {
            itemsVisible = 1;
        } else if (width < 1024) {
            itemsVisible = 2;
        } else if (width < 1440) {
            itemsVisible = 3;
        }

        if (direction === -1) {
            index--;
            if (index < 0) {
                index = totalItems - itemsVisible;
            }
        } else if (direction === 1) {
            index++;
            if (index + itemsVisible > totalItems) {
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

    window.addEventListener('resize', showItems);

});