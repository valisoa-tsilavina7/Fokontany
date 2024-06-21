
const user= document.getElementById('user');

const profil=document.getElementById('profil');
user.addEventListener('click',()=>{
    
    if(profil.style.display==="flex")
    {
        profil.style.display="none";
    }else
    {
        profil.style.display="flex";

    }

})