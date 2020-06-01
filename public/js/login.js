window.addEventListener('load',acciones);

function acciones(){
    document.addEventListener("keypress",
                          (e)=> {
        let result = isCapslock(e);
        let inff = document.getElementsByClassName('info');
        for(let i=0;i<inff.length;i++){
            if(result){
                inff[i].style.display = "block";
            }else{
                inff[i].style.display = "none";
            }
        }
        
    });
    

    function isCapslock(e){
        const IS_MAC = /Mac/.test(navigator.platform);

        const charCode      = e.charCode;
        const shiftKey      = e.shiftKey;
        
        if (charCode >= 97 && charCode <= 122){
            capsLock = shiftKey;
        } else if (charCode >= 65 && charCode <= 90 && !(shiftKey && IS_MAC)){
            capsLock = !shiftKey;
        }

        return capsLock;

    }
}

