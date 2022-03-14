document.querySelector('button').addEventListener('click', function() {
    this.classList.toggle('open');
    document.querySelector('nav').classList.toggle('open');
})