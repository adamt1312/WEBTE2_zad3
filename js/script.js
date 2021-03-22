btn1 = document.getElementById('btn_tb1');
btn2 = document.getElementById('btn_tb2');
tb1 = document.getElementById('tb1');
tb2 = document.getElementById('tb2');

btn1.addEventListener('click',() => {
    tb1.style.display = 'table';
    tb2.style.display = 'none';
})

btn2.addEventListener('click',() => {
    tb2.style.display = 'table';
    tb1.style.display = 'none';
})

