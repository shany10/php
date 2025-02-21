const create_ = document.getElementById('create');
const delete_ = document.getElementById('delete');
const update_ = document.getElementById('update');

const createGroupe = document.getElementById('createGroupe');
const deleteGroupe = document.getElementById('deleteGroupe');
const updateGroupe = document.getElementById('updateGroupe');

create_.addEventListener('click', function() {
    createGroupe.classList.remove('hidden');
    deleteGroupe.classList.add('hidden');
    updateGroupe.classList.add('hidden');
})

delete_.addEventListener('click', function() {
    createGroupe.classList.add('hidden');
    deleteGroupe.classList.remove('hidden');
    updateGroupe.classList.add('hidden');
})

update_.addEventListener('click', function() {
    createGroupe.classList.add('hidden');
    deleteGroupe.classList.add('hidden');
    updateGroupe.classList.remove('hidden');
})


// const ul = document.getElementById('groupe_menu');

// for (let i = 0; i < ul.children.length; i++) {
//     ul.children[i].addEventListener('click', function() {
//         let current = document.getElementsByClassName('active');
//         current[0].className = current[0].className.replace(' active', '');
//         this.className += ' active';
//     });
// }