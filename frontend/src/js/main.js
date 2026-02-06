import Swiper from 'swiper';
import 'swiper/css';
import '../scss/main.scss';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import { Pagination, Navigation } from 'swiper/modules';

document.addEventListener('DOMContentLoaded', function () {
  initSwiper('.hero-swiper');
  initSwiper('.sigle-destination-swiper');
  initMobileMenu();
  initDropDownMenu();
  initFilterDropdown('.has-dropdown');
  filterFormSubmit();
});
function initSwiper(className) {
  const swiperEl = document.querySelectorAll(className);
  if (!swiperEl.length) return;
  swiperEl.forEach((el) => {
    let option = {};
    const swiperOptionRaw = el.dataset.swiper;
    if (swiperOptionRaw) {
      try {
        option = JSON.parse(swiperOptionRaw);
        console.log(option);
        const swiper = new Swiper(className, {
          modules: [Pagination, Navigation],
          ...option,
        });
      } catch (err) {
        console.log(err);
      }
    }
  });
}

function initMobileMenu() {
  const mobileTrigger = document.getElementById('mobile-menu__trigger');
  const mobileMenu = document.querySelector('.mobile__nav');
  const bg_overflow = document.querySelector('.bg-overflow');
  if (mobileTrigger && mobileMenu) {
    mobileTrigger.addEventListener('click', function () {
      mobileMenu.classList.toggle('open');
      if (bg_overflow) {
        bg_overflow.classList.toggle('active');
      }
    });
  }
  initMobileCollapse(mobileMenu);
}
function initMobileCollapse(menu) {
  if (!menu) return;
  menu.addEventListener('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    const arrow = e.target.closest('.mobile-menu__arrow');
    if (!arrow) return; // click war not on the arrow
    arrow.closest('li').classList.toggle('open');
    arrow.classList.toggle('open');
  });
}

function initDropDownMenu() {
  const dropdownContainer = document.querySelectorAll('.filters__item');
  if (!dropdownContainer.length) return;
  dropdownContainer.forEach(function (item) {
    const toggleBtn = item.querySelector('.filters__item-toggle');
    const dropdown = item.querySelector('.filters__item-dropdown');
    if (!toggleBtn || !dropdown) return;
    toggleBtn.addEventListener('click', function () {
      item.classList.toggle('open');
    });
  });
}

function initPreFilledValues(form, submitBtn) {
  try {
    const inputs = form.querySelectorAll('.dropdown-input');
    inputs.forEach((input) => {
      displayPrefilledValues(input);
    });
    function displayPrefilledValues(input) {
      const inputValue = input.value;

      if (inputValue == '') return;

      const filtersItem = input.closest('.filters__item');
      const dropdown = filtersItem.querySelector('.filters__item-dropdown');
      const toggleBtnText = filtersItem.querySelector(
        '.filters__item-toggle-text'
      );
      const selectedOption = dropdown.querySelector(
        `a[data-term-id="${inputValue}"]`
      );

      selectedOption.classList.add('selected');
      filtersItem.classList.add('selected');
      toggleBtnText.textContent = selectedOption.textContent.trim();
      submitBtn.classList.remove('disabled');
      submitBtn.removeAttribute('disabled');
    }
  } catch (err) {
    console.log(err);
  }
}

function initFilterDropdown(selector) {
  try {
    const filtersItemArr = document.querySelectorAll(selector);
    const form = document.getElementById('tb-filter');

    if (!filtersItemArr.length || !form) return;

    const submitBtn = form.querySelector('.filters_submitBtn');
    const is_preload = form.dataset.preload || '';

    if (is_preload !== '') {
      initPreFilledValues(form, submitBtn);
    }

    filtersItemArr.forEach(function (filtersItem) {
      const dropdown = filtersItem.querySelector('.filters__item-dropdown');
      const input = filtersItem.querySelector('.dropdown-input');
      const toggleBtnText = filtersItem.querySelector(
        '.filters__item-toggle .filters__item-toggle-text'
      );

      if (!dropdown || !input || !toggleBtnText) return;

      dropdown.addEventListener('click', function (e) {
        const option = e.target.closest('a');

        if (!option) return;
        {
          e.preventDefault();
          const termId = option.getAttribute('data-term-id');
          const name = option.textContent.trim();
          input.value = termId;
          toggleBtnText.textContent = name;

          dropdown
            .querySelectorAll('a')
            .forEach((a) => a.classList.remove('selected'));
          option.classList.add('selected');

          submitBtn.classList.remove('disabled');
          submitBtn.removeAttribute('disabled');
          filtersItem.classList.remove('open');
          filtersItem.classList.add('selected');
          if (filtersItem.dataset.filter === 'country') {
            loadCities(termId);
          }
        }
      });
    });
  } catch (error) {
    console.error('Error in initFilterDropdown:', error);
  }
}

async function loadCities(countryId) {
  if (!countryId) return;
  const cityFilterItem = document.getElementById('js-filter-city');

  if (!cityFilterItem) return;

  const cityToggleBtn = cityFilterItem.querySelector('.filters__item-toggle');
  const cityToggleBtnText = cityFilterItem.querySelector(
    '.filters__item-toggle-text'
  );
  const cityDropdown = cityFilterItem.querySelector('.filters__item-dropdown');
  const input = cityFilterItem.querySelector('.dropdown-input');

  if (!cityToggleBtn || !cityDropdown || !input) return;
  if (!cityToggleBtnText) return;

  // Reset city UI
  cityToggleBtn.disabled = true;
  cityToggleBtn.setAttribute('disabled', 'disabled');
  input.value = '';
  cityDropdown.innerHTML = '';
  cityToggleBtnText.textContent = 'City';

  const formdata = new FormData();
  formdata.append('action', 'get_cities_by_country');
  formdata.append('nonce', TravelblogFilters['nonce']);
  formdata.append('countryId', countryId);

  const res = await fetch(TravelblogFilters['ajaxUrl'], {
    method: 'POST',
    credentials: 'same-origin',
    body: formdata,
  });

  const json = await res.json();
  if (!json || !json.success) return;
  const cities = json.data.cities || [];
  console.log(cities);

  if (!cities.length) {
    return;
  }

  cityDropdown.innerHTML = cities
    .map(
      (el) =>
        `<li class="filters__item-dropdown-item">
      <a href="#" data-term-id="${el.id}">${el.name}</a>
    </li>`
    )
    .join('');
  cityToggleBtn.disabled = false;
  cityToggleBtn.removeAttribute('disabled');

  cityDropdown.addEventListener('click', function (e) {
    const option = e.target.closest('a');

    if (!option) return;
    {
      e.preventDefault();
      const termId = option.getAttribute('data-term-id');
      const name = option.textContent.trim();
      input.value = termId;
      cityToggleBtn.querySelector('.filters__item-toggle-text').textContent =
        name;

      cityDropdown
        .querySelectorAll('a')
        .forEach((a) => a.classList.remove('selected'));
      option.classList.add('selected');

      // submitBtn.classList.remove('disabled');
      // submitBtn.removeAttribute('disabled');
      cityFilterItem.classList.remove('open');
      cityFilterItem.classList.add('selected');
    }
  });

  // initFilterDropdown('#js-filter-city');
}

function filterFormSubmit() {
  const filterForm = document.getElementById('tb-filter');
  if (!filterForm) return;
  const action = filterForm.getAttribute('action');
  if (action) return;
  // If form has no action URL - it means that form should be handled via AJAX
  filterForm.addEventListener('submit', function (e) {
    e.preventDefault();
    fetchResults(this);
  });
}

async function fetchResults(context, paged = 1) {
  try {
    const formdata = new FormData(context);
    formdata.append('action', 'send_filter_form');
    formdata.append('nonce', TravelblogFilters['nonce']);
    formdata.append('paged', paged);

    // const data = Object.fromEntries(formdata.entries());
    const res = await fetch(TravelblogFilters['ajaxUrl'], {
      method: 'POST',
      credentials: 'same-origin',
      body: formdata,
    });

    const json = await res.json();
    if (!json || !json.success) return;
    const resultsEl = document.querySelector('.result');
    const paginationEl = document.querySelector('.pagination');
    // resultsEl.classList.remove('loading');
    resultsEl.innerHTML = json.data.html;
    paginationEl.innerHTML = json.data.pagination_html;
    // initFilterFormPagination('.ajax-pagination');
  } catch (error) {
    console.error('Error parsing JSON response:', error);
  } finally {
    initFilterFormPagination('.ajax-pagination');
  }
}
function initFilterFormPagination(selector) {
  const paginationEl = document.querySelector(selector);
  if (!paginationEl) return;
  paginationEl.addEventListener('click', function (e) {
    const target = e.target.closest('a');
    if (!target) return;
    e.preventDefault();
    const paged = target.getAttribute('data-paged');
    const filterForm = document.getElementById('tb-filter');
    fetchResults(filterForm, paged);
  });
}
