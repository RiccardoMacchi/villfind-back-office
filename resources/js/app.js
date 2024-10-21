import './bootstrap';
import '~resources/scss/app.scss';
import '~icons/bootstrap-icons.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

let savedPaginationInfos = JSON.parse(localStorage.getItem('paginationInfos'));

if (savedPaginationInfos && !window.location.pathname.includes(savedPaginationInfos.currentPath)) {
    localStorage.removeItem('paginationInfos');
}

savedPaginationInfos = JSON.parse(localStorage.getItem('paginationInfos'));

if (savedPaginationInfos && window.location.pathname === savedPaginationInfos.currentPath && !window.location.search) {
    window.location.search = `?page=${savedPaginationInfos.currentPage}`;
}

window.onload = () => {
    const paginationLinks = document.querySelectorAll('a.page-link');

    paginationLinks.forEach(link => {
        link.addEventListener('click', function (clickEvent) {
            const targetUrl = new URL(link.getAttribute('href'));
            const targetPage = targetUrl.searchParams.get('page');

            if (targetPage) {
                const paginationInfos = {};
                paginationInfos.currentPage = targetPage;
                paginationInfos.currentPath = window.location.pathname;

                console.log(paginationInfos.currentPage);

                localStorage.setItem('paginationInfos', JSON.stringify(paginationInfos));
            }
        });

    });
};

window.checkboxListSelector = checkboxListSelector;

function checkboxListSelector(listButtonId) {
    const dropdownButton = document.getElementById(listButtonId);
    const dropdownMenu = document.querySelectorAll(`#${listButtonId}+.dropdown-menu input`);

    let selectedItems = [];

    for (const checkbox of dropdownMenu) {
        updateSelectedCheckbox(checkbox);
        checkbox.addEventListener('change', handleCheckbox);
    }

    function handleCheckbox(event) {
        const checkbox = event.target;
        updateSelectedCheckbox(checkbox);
    }

    function updateSelectedCheckbox(checkbox) {
        const newItem = {
            name: checkbox.dataset.name,
            value: checkbox.value,
        };

        if (checkbox.checked) {
            selectedItems.push(newItem);
        } else {
            selectedItems = selectedItems.filter((item) => item.value !== newItem.value);
        }

        const selectedItemsNames = selectedItems.map(item => item.name);

        dropdownButton.innerText = selectedItemsNames.length > 0 ? selectedItemsNames.join(
            ' \u{02219} ') : 'None';
    }
}