// const activatePage = window.location.pathname.split('/')[3];
// const activePage = window.location.pathname.split('/')[3];
const navLinks = document.querySelectorAll('.nav-link').forEach(link => {

    console.log(link.href);
    console.log(window.location.href);
if(link.href === window.location.href){
    link.setAttribute('class', 'nav-item nav-link active')
    link.setClass
}
    // if(link.href.includes(`${activePage}`)){
    //     console.log(`${activePage}`);
    // }
})
// const xd = document.getElementsByClassName('nav-item');
// for (let index = 0; index < xd.length; index++) {
//     if(xd[length].getAttribute('href').includes(`${activatePage}`)){
//         console.log(activatePage)
//         console.log(xd[length]);
//         console.log('a');
        
//     }
//     else {
//         console.log(activatePage)
//         console.log(xd[length])
//         console.log('b');
//     }
// }




