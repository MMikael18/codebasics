let bt_all = document.querySelectorAll('[data-wall-controls]');

bt_all.forEach(element => {
    console.dir(element);

    let target = element.dataset.wallControls,
        bt_previous = element.getElementsByClassName("c-bt_previous")[0],
        bt_next = element.getElementsByClassName("c-bt_next")[0];
    
    console.dirxml(target);
    
    bt_previous.onclick = () => {
        alert('bt_previous ' + target); 
    };

    bt_next.onclick = () => {
        alert('bt_next ' + target);
    }; 

});

