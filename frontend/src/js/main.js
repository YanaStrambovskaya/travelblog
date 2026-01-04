import Glide from '@glidejs/glide';

document.addEventListener('DOMContentLoaded', function () {
  initGlide('.js-glide');
});

function initGlide(className) {
  if (!document.querySelectorAll(className).length) return;
  document.querySelectorAll(className).forEach(function (glideElement) {
    let option = {};
    const glideElementOptionRaw = glideElement.getAttribute('data-glide');
    if (glideElementOptionRaw) {
      try {
        option = JSON.parse(glideElementOptionRaw);
      } catch (e) {
        console.error('Invalid JSON in data-glide attribute:', e);
      }
      // console.log('glideElementOptionRaw', glideElementOptionRaw);
      console.log('option', option);
      new Glide(glideElement, option).mount();
    }
  });
}
