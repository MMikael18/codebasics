let bt_all = document.querySelectorAll('[data-wall-controls]'),
    wall = document.querySelectorAll('[data-wall]'),
    target_counter = [],
    target_leght = [];

wall.forEach(element => {
    let target = element.dataset.wall;
    target_counter[target] = 0;
    target_leght[target] = element.getElementsByClassName("c-postwall-list__item").length-1;
});

bt_all.forEach(element => {
    //console.dir(element);

    let target = element.dataset.wallControls,
        bt_previous = element.getElementsByClassName("c-bt_previous")[0],
        bt_next = element.getElementsByClassName("c-bt_next")[0];

    bt_previous.onclick = () => {
        move_to( -1, target ); 
    };

    bt_next.onclick = () => { 
        move_to( 1, target );        
    };
 
});
 
function move_to (direct, target){
    let result = target_counter[target] + direct,
        max = target_leght[target];

    if( result < 0 || result > max) return; 
 
    target_counter[target] = result;  
    set_left(target); 
    //alert('bt_next ' + target_counter[target]);  
}

function set_left(target){ 
    let cart = target_counter[target],
        margin = 15,
        width = document.getElementsByClassName("c-postwall-list__item")[0].offsetWidth,        
        wall_content = document.querySelector('[data-wall='+target+']').firstElementChild;
        wall_content.style.left = ( width + margin )*cart*-1 + "px"; 
}

/*
*
*
*
*/

let doit;
function reportWindowSize() {
    wall.forEach(element => {
        element.firstElementChild.style.transition = "none";
    });
    wall.forEach(element => {
        let target = element.dataset.wall;
        set_left(target);
    });
    clearTimeout(doit);
    doit = setTimeout(() => {
        wall.forEach(element => {        
            element.firstElementChild.style.transition = "";           
        });
    }, 100);     
}
 

window.addEventListener('resize', reportWindowSize); 